<?php

namespace App\Services;

// Files
use App\Models\Portfolio\PortfolioFile;
use Exception;
use Illuminate\Support\Facades\Storage;
// Collection
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Intervention\Image\Image as ImageImage;
// Intervention Image processing library.
use Intervention\Image\Laravel\Facades\Image;

class FileService
{
    /**
     * Upload a file and return an array with the info to make the insertion in the DB table
     */

    public function uploadFile(mixed $file, int $elementId, string $columnId, string $disk, string $storagePath): array
    {
        // Storage in filesystem file config, specify the storagePath
        try {
            // Upload File
            $path = Storage::disk($disk)->putFile($storagePath, $file);
        } catch (Exception $e) {
            // TODO: save errors in log
            return $e->getCode();
        }

        // If the file is successfully uploaded, then prepare the information to store in the DB

        // Info common to ALL Files, images and documents, not necessary to store title or description, can be inserted later
        $original_filename = $file->getClientOriginalName();
        $media_type = $file->getMimeType();
        $media_type == 'application/pdf' ? ($type = 'document') : ($type = 'image');
        $size = $file->getSize();
        $storage_filename = basename($path);

        // If there is an image, store additional information, ONLY for images
        $imageInfo = null;
        $position = 0;
        if ($type == 'image') {
            $imageInfo = $this->imageInfo($disk, $path);

            $this->createThumbnail($disk, $path);

            // To get the position, get the total images in the Portfolio and add 1 (because array start at 0) !!! maybe left as is and start at 0...
            /* $position = PortfolioFile::where([['portfolio_id', $elementId], ['type', 'image']])
                ->get()
                ->count(); */

            $position = PortfolioFile::where([['portfolio_id', $elementId], ['type', 'image']])
                ->get()
                ->count();
            //dd($position);

            //$position == null ? $position = '0' : '';

            // TODO: Create the thumbnails, and images for web. WEBP for big, medium and small screens
        } else {
            $position = null;
        }

        return [
            $columnId => $elementId,
            'original_filename' => $original_filename,
            'storage_filename' => $storage_filename,
            'path' => $path,
            'media_type' => $media_type,
            'size' => $size,
            'type' => $type,
            // Info only for Images
            'width' => $imageInfo ? $imageInfo['width'] : null,
            'height' => $imageInfo ? $imageInfo['height'] : null,
            'orientation' => $imageInfo ? $imageInfo['orientation'] : null,
            'resolution' => $imageInfo ? $imageInfo['resolution'] : null,
            //'position' => $position ? $position + 1 : null,
            'position' => $position,
        ];
    }

    /**
     * Download a file, disposition inline(browser) or attachment(download)
     */

    public function downloadFile(mixed $file, string $disposition)
    {
        // No need to specify the disposition to download the file.
        $dispositionHeader = [
            'Content-Disposition' => $disposition,
        ];

        if (Storage::disk('public')->exists($file->path)) {
            //return Storage::disk('public')->download($file->path, $file->original_filename, $dispositionHeader);
            return Storage::disk('public')->download($file->path, $file->original_filename);
        } else {
            return back()->with('message', 'Error: File ' . $file->original_filename . ' can not be downloaded.');
        }
    }

    /**
     * Delete the directory with the id of the portfolio and all the files inside.
     */
    public function deletePortfolioDirectory(Collection $files)
    {
        foreach ($files as $file) {
            $this->deleteOneFile($file);
        }
    }

    /**
     * Inset new Note and insert the tags in the intermediate table note_tag
     */
    public function deleteFiles(Collection $files)
    {
        foreach ($files as $file) {
            $this->deleteOneFile($file);
        }
    }

    /**
     * Inset new Note and insert the tags in the intermediate table note_tag
     */
    public function deleteOneFile(mixed $file)
    {
        if (Storage::disk('public')->exists($file->path)) {
            /*  echo $file->path;
             dd('borradito'); */
            Storage::disk('public')->delete($file->path);
            $file->delete();
        }
    }

    public function deleteThumbnailImg(PortfolioFile $image)
    {
        $path = $this->getThumbnailPath($image);
        
        if (Storage::disk('public')->exists($path)) 
        {           
            Storage::disk('public')->delete($path);
        }        
    }

    public function deleteResponsiveImg(string $path)
    {
        //dd($path);        
        if (Storage::disk('public')->exists($path)) 
        {           
            Storage::disk('public')->delete($path);
        }        
    }

    /**
     * Download a file, disposition inline(browser) or attachment(download)
     */

     public function downloadResponsiveImg(string $path, string $imageName)
     {         
        
        if (Storage::disk('public')->exists($path)) 
        {   
            return Storage::disk('public')->download($path, $imageName);
        } else {
            return back()->with('error', 'Error: File can not be downloaded.');
        }        
        
     }

    /**
     * Test
     */
    public function getFilesbyType(int $portfolioId, string $type): Collection
    {
        return PortfolioFile::where([
            'portfolio_id' => $portfolioId,
            'type' => $type,
        ])
            ->orderByRaw('-position DESC')
            ->get();
    }

    /**
     * Check if the file of type image is in the last position of the portfolio
     */
    public function isLastImage(PortfolioFile $file): bool
    {
        $totalImages = PortfolioFile::where([['portfolio_id', $file->portfolio_id], ['type', 'image']])
            ->get()
            ->count();

        return $file->position + 1 == $totalImages ? true : false;
    }

    /**
     * Decrease 1 postition ALL the images that have a bigger position that the current image
     */
    public function decreasePortfolioPositions(PortfolioFile $file)
    {
        $images = PortfolioFile::where([['portfolio_id', $file->portfolio_id], ['position', '>', $file->position]])->get();

        foreach ($images as $image) {
            PortfolioFile::where('id', $image->id)->update(['position' => $image->position - 1]);
        }
    }

    /* ************** Portfolio Images Position ******************/

    public function orderPortfolio(PortfolioFile $image, string $direction)
    {
        $imageId = $image->id;
        unset($image->id);
        var_dump($direction);
        //dd($images);

        if ($direction == 'down') {
            $image->position = $image->position + 1;
        }

        if ($direction == 'up') {
            $image->position = $image->position - 1;
        }
        PortfolioFile::where('id', $imageId)->update(['position' => $image->position]);
    }

    public function orderPortfolioGallery(array $images, array $image, string $direction)
    {
        // Changing the postion with the up, down arrows only affect 2 keys that interchange position values
        $imageId = $image['id'];
        unset($image['id']);
        var_dump($direction);
        //dd($images);

        if ($direction == 'down') {
            $image['position'] = $image['position'] + 1;
        }

        if ($direction == 'up') {
            $image['position'] = $image['position'] - 1;
        }

        //dd($image['position']);

        PortfolioFile::where('id', $imageId)->update(['position' => $image['position']]);
    }

    /***************************** IMAGES ************************************/

    /**
     * Given an Image get his path for the Thumbnail Image
     */
    public function getThumbnailPath (PortfolioFile $image)
    {        
        // Original Image Info
        $storagePath = pathinfo($image->path, PATHINFO_DIRNAME);
        $filename = pathinfo($image->path, PATHINFO_FILENAME);
        $extension = pathinfo($image->path, PATHINFO_EXTENSION);

        $thumbnailName = "thumb";

        return $storagePath . '/' . $filename . '_' . $thumbnailName . '.' . $extension;
    }

    /**
     * True if there is at least one, false if there is none
     */

    public function responsiveImagesExists($file)
    {
        $responsiveScreens = ['S', 'M', 'L'];
        $totalResponsiveScreens = count($responsiveScreens);

        $storagePath = pathinfo($file->path, PATHINFO_DIRNAME);
        $filename = pathinfo($file->path, PATHINFO_FILENAME);
        $extension = 'webp';

        foreach ($responsiveScreens as $screenSize) {
            $responsiveImagePath = $storagePath . '/' . $filename . '_' . $screenSize . '.' . $extension;
            //dd($responsiveImagePath);
            if (file_exists('storage/' . $responsiveImagePath)) {
                $totalResponsiveScreens = $totalResponsiveScreens - 1;
                //dd($totalResponsiveScreens);
            }
        }

        return $totalResponsiveScreens == count($responsiveScreens) ? false : true;
    }

    /**
     * Array with the information about the Responsive Images for this portfolio Image,
     * return empty array if there is none
     */

    public function getResponsiveImagesInfo($file): array
    {   
        
        $imageInfo[] = array();
        
        // 1 - If there are any responsive Image yet, no need to continue

        if (!$this->responsiveImagesExists($file)) {
            return $imageInfo;
        } 

        $responsiveScreens = ['S', 'M', 'L'];
        $totalResponsiveScreens = count($responsiveScreens);
        // Original Image Info
        $storagePath = pathinfo($file->path, PATHINFO_DIRNAME);
        $filename = pathinfo($file->path, PATHINFO_FILENAME);
        $extension = 'webp';

        foreach ($responsiveScreens as $key => $screenSize) {
            $responsiveImagePath = 'storage/' . $storagePath . '/' . $filename . '_' . $screenSize . '.' . $extension;
            $responsiveImagePathInfo = $storagePath . '/' . $filename . '_' . $screenSize . '.' . $extension;

            if (file_exists($responsiveImagePath)) {

                $imageInfo[$key] = [
                    "screen" => $screenSize,
                    "path" => $responsiveImagePath,
                    "filename" => pathinfo($responsiveImagePath, PATHINFO_FILENAME) . '.' . $extension,
                    "size" => round (filesize($responsiveImagePath) / 1024),
                    "created_at" => date('Y-m-d H:i:s',filemtime($responsiveImagePath)),
                ];            
                // get extra information, merge the current information with the generic information for an image (width, height, orientation, resolution)
                $imageInfo[$key] = array_merge($imageInfo[$key], $this->imageInfo('public', $responsiveImagePathInfo));  
            }
            else
            {
                $imageInfo[$key] = [
                    "screen" => $screenSize,
                    "path" => null,
                    "filename" => null,
                    "size" => null,
                    "created_at" => null,
                    "width" => null,
                    "height" => null,
                    "orientation" => null,
                    "resolution" => null,
                ];
            }
            $totalResponsiveScreens = $totalResponsiveScreens - 1;
        }

        return $imageInfo;
    }

    /**
     * Given an Image and Screen get his path for the responsive Image
     */
    public function getResponsivePath (PortfolioFile $image, string $screenSize)
    {
        // Original Image Info
        $storagePath = pathinfo($image->path, PATHINFO_DIRNAME);
        $filename = pathinfo($image->path, PATHINFO_FILENAME);
        $extension = 'webp';

        return $storagePath . '/' . $filename . '_' . $screenSize . '.' . $extension;
    }

    public function deleteResponsiveImages($file)
    {
        $responsiveScreens = ['S', 'M', 'L'];
        //$totalResponsiveScreens = count($responsiveScreens);

       /*  $storagePath = pathinfo($file->path, PATHINFO_DIRNAME);
        $filename = pathinfo($file->path, PATHINFO_FILENAME);
        $extension = 'webp'; */

        foreach ($responsiveScreens as $screenSize) {
            //$responsiveImagePath = $storagePath . '/' . $filename . '_' . $screenSize . '.' . $extension;
            $responsiveImagePath = $this->getResponsivePath($file, $screenSize);
            //dd($responsiveImagePath);
            $this->deleteResponsiveImg($responsiveImagePath);
        }

        //return $totalResponsiveScreens == count($responsiveScreens) ? false : true;
    }

    /* ************** Intervention Image processing library ******************/

    /**
     * Get the orientation of an Image. Given a path return true (landscape-horizontal) or false (portrait-vertical)
     */

    public function isLandscape(string $path): bool
    {
        $imageFromStorage = Storage::disk('public')->path($path);

        $image = Image::read($imageFromStorage);

        return $image->width() > $image->height() ? true : false;
    }

    public function imageInfo(string $disk, string $filePath): array
    {
        $imageInfo = [];

        $imageFromStorage = Storage::disk($disk)->path($filePath);

        // READ THE IMAGE
        $image = Image::read($imageFromStorage);

        $resolution = $image->resolution();

        $imageInfo['width'] = $image->width();
        $imageInfo['height'] = $image->height();
        if ($image->width() > $image->height()) {
            $imageInfo['orientation'] = 'landscape';
        }
        if ($image->width() < $image->height()) {
            $imageInfo['orientation'] = 'portrait';
        }
        if ($image->width() == $image->height()) {
            $imageInfo['orientation'] = 'square';
        }
        $imageInfo['resolution'] = min($resolution->x(), $resolution->y());

        return $imageInfo;
    }

    public function imageResponsiveInfo(string $disk, string $filePath) 
    {
        //$disk = 'public';
        
        $imageFromStorage = Storage::disk($disk)->path($filePath);
       
        return Image::read($imageFromStorage);        
    }

    /**
     * Create Thumbnail for the image
     */
    public function createThumbnail(string $disk, string $filePath)
    {
        $imageFromStorage = Storage::disk($disk)->path($filePath);

        // READ THE IMAGE
        $image = Image::read($imageFromStorage);

        $storagePath = pathinfo($filePath, PATHINFO_DIRNAME);
        $filename = pathinfo($filePath, PATHINFO_FILENAME);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);

        // SCALE
        // Resize the image and keep the original aspect ratio. Set the maximum
        // width and height. The image will be scaled down without
        // exceeding these dimensions.
        // New image dimensions: 120 x 80px
        $thumbnail = $image->scale(width: 200);
        // Save
        $thumbnailPath = $storagePath . '/' . $filename . '_' . 'thumb.' . $extension;
        $thumbnail->save(Storage::disk($disk)->path($thumbnailPath));
    }

    /**
     * Create Responsive images for different screens
     */
    public function createResponsiveImages(string $disk, string $filePath)
    {
        $storagePath = pathinfo($filePath, PATHINFO_DIRNAME);
        $filename = pathinfo($filePath, PATHINFO_FILENAME);

        $imageFromStorage = Storage::disk($disk)->path($filePath);

        // READ THE IMAGE
        $image = Image::read($imageFromStorage);

        // SCALE FOR DIFFERENT SCREENS
        // Resize the image and keep the original aspect ratio. Set the maximum
        // width and height. The image will be scaled down without
        // exceeding these dimensions.
        $smallImage = $image->scale(width: 320);
        $smallImagePathWebp = $storagePath . '/' . $filename . '_' . 'S.' . 'webp';
        $smallImage->toWebp()->save(Storage::disk($disk)->path($smallImagePathWebp));

        $mediumImage = $image->scale(width: 640);
        $mediumImagePathWebp = $storagePath . '/' . $filename . '_' . 'M.' . 'webp';
        $mediumImage->toWebp()->save(Storage::disk($disk)->path($mediumImagePathWebp));

        $largeImage = $image->scale(width: 1200);
        $largeImagePathWebp = $storagePath . '/' . $filename . '_' . 'L.' . 'webp';
        $largeImage->toWebp()->save(Storage::disk($disk)->path($largeImagePathWebp));
    }


    /**
     * Create Responsive images for different screens
     */
    public function createResponsiveImage(string $disk, string $filePath, string $screen)
    {
        $storagePath = pathinfo($filePath, PATHINFO_DIRNAME);
        $filename = pathinfo($filePath, PATHINFO_FILENAME);

        $imageFromStorage = Storage::disk($disk)->path($filePath);

        // READ THE IMAGE
        $image = Image::read($imageFromStorage);

        // SCALE FOR DIFFERENT SCREENS
        // Resize the image and keep the original aspect ratio. Set the maximum
        // width and height. The image will be scaled down without
        // exceeding these dimensions.
        if($screen == 'S')
        {
        $smallImage = $image->scale(width: 320);
        $smallImagePathWebp = $storagePath . '/' . $filename . '_' . 'S.' . 'webp';
        $smallImage->toWebp()->save(Storage::disk($disk)->path($smallImagePathWebp));
        }
        if($screen == 'M')
        {
        $mediumImage = $image->scale(width: 640);
        $mediumImagePathWebp = $storagePath . '/' . $filename . '_' . 'M.' . 'webp';
        $mediumImage->toWebp()->save(Storage::disk($disk)->path($mediumImagePathWebp));
        }
        if($screen == 'L')
        {
        $largeImage = $image->scale(width: 1200);
        $largeImagePathWebp = $storagePath . '/' . $filename . '_' . 'L.' . 'webp';
        $largeImage->toWebp()->save(Storage::disk($disk)->path($largeImagePathWebp));
        }
    }

    /**
     * Experiments with the Intervention Image processing library ("intervention/image-laravel": "^1.3")
     */

    public function imageLab(PortfolioFile $file)
    {
        $imageInfo = [];

        $imageFromStorage = Storage::disk('public')->path($file->path);

        // READ AN IMAGE
        $image = Image::read($imageFromStorage);
        //dd($image);
        $resolution = $image->resolution();
        //dd($resolution);

        $imageInfo['original_filename'] = $file->original_filename;
        $imageInfo['storage_filename'] = $file->storage_filename;
        $imageInfo['path'] = $file->path;
        $imageInfo['storagePath'] = pathinfo($file->path, PATHINFO_DIRNAME);
        $imageInfo['filename'] = pathinfo($file->path, PATHINFO_FILENAME);
        $imageInfo['extension'] = pathinfo($file->path, PATHINFO_EXTENSION);
        $imageInfo['disk'] = 'public';
        $imageInfo['media_type'] = $file->media_type;
        $imageInfo['width'] = $image->width();
        $imageInfo['height'] = $image->height();
        $imageInfo['resolutionx'] = $resolution->x();
        $imageInfo['resolutiony'] = $resolution->y();
        $imageInfo['orientation'] = $image->width() > $image->height() ? 'landscape' : 'portrait';

        dd($imageInfo);

        // CREATE A WATERMARK
        $watermark = Storage::disk('public')->get('web/gatito.png');
        // Save
        $watermarkedImagePath = $imageInfo['storagePath'] . '/' . $imageInfo['filename'] . '_' . 'watermarked.' . $imageInfo['extension'];

        $image
            ->place(
                element: $watermark,
                position: 'center',
                /* position: 'bottom-right',
            offset_x: 10, // 10px from the right
            offset_y: 10, // 10px from the bottom */
                opacity: 70, // 70%
            )
            ->save(Storage::disk($imageInfo['disk'])->path($watermarkedImagePath));

        dd('finito watermarked');

        // RESIZE AND SCALE

        // Resize to fixed dimensions. New image dimensions: 100 x 100px
        //$resizedImage = $image->resize(width: 100, height: 100);

        // SCALE
        // Resize the image and keep the original aspect ratio. Set the maximum
        // width and height. The image will be scaled down without
        // exceeding these dimensions.
        // New image dimensions: 120 x 80px
        $resizedImage = $image->scale(width: 120, height: 100);
        // Save
        $resizedImagePath = $imageInfo['storagePath'] . '/' . $imageInfo['filename'] . '_' . 'thumb.' . $imageInfo['extension'];
        $resizedImage->save(Storage::disk($imageInfo['disk'])->path($resizedImagePath));

        // ROTATE - Rotate the image 90 degrees clockwise
        $rotatedImage = $resizedImage->rotate(-90);
        // Save
        $rotatedImagePath = $imageInfo['storagePath'] . '/' . $imageInfo['filename'] . '_' . 'rotate.' . $imageInfo['extension'];
        $rotatedImage->save(Storage::disk($imageInfo['disk'])->path($rotatedImagePath));

        // CROP
        // Cut a 250 x 250px square from the center of the image
        $croppedImage = $image->crop(width: 250, height: 250, position: 'center');
        // Save
        $croppedImagePath = $imageInfo['storagePath'] . '/' . $imageInfo['filename'] . '_' . 'cropped.' . $imageInfo['extension'];
        $croppedImage->save(Storage::disk($imageInfo['disk'])->path($croppedImagePath));
        // Store it in the filesystem
        //$resizedImage->save(Storage::path('images/avatar-image-resized.jpg'));

        // CONVERTING IMAGES to PNG, WEB, JPEG
        $croppedImagePathPng = $imageInfo['storagePath'] . '/' . $imageInfo['filename'] . '_' . 'cropped.' . 'png';
        $croppedImagePathWebp = $imageInfo['storagePath'] . '/' . $imageInfo['filename'] . '_' . 'cropped.' . 'webp';

        $croppedImage->toPng()->save(Storage::disk($imageInfo['disk'])->path($croppedImagePathPng));
        $croppedImage->toWebp()->save(Storage::disk($imageInfo['disk'])->path($croppedImagePathWebp));

        dd('imageLab - END');
    }
}
