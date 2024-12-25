<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\StorePortfolioFileRequest;
use App\Models\Portfolio\Portfolio;
use App\Models\Portfolio\PortfolioFile;
use App\Services\FileService;
use Exception;
use Illuminate\Http\Request;

class PortfolioFileController extends Controller
{
    public function __construct(private FileService $fileService)
    {
    }

    public function download(Portfolio $portfolio, PortfolioFile $file)
    {
        return $this->fileService->downloadFile($file, 'attachment');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portfolio $portfolio, PortfolioFile $file)
    {
        // ONLY FOR IMAGES 
        // 1) Reorder the Portfolio Image gallery 
        // 2) delete the thumbnail 
        // 3) if there is any, delete the responsive images.
        if ($file->type == 'image') {
            
            if (!$this->fileService->isLastImage($file)) {
                $this->fileService->decreasePortfolioPositions($file);                
            }
            
            $this->fileService->deleteThumbnailImg($file);
            $this->fileService->deleteResponsiveImages($file);
        }
        // FOR ALL FILES        
        $this->fileService->deleteOneFile($file);

        //return back()->with('message', __("generic.file") . ' (' . $file->original_filename . ') ' . __("generic.for") . ' (' . $portfolio->name . ') ' . __("generic.successDelete"));

        return to_route('portfolios.show', $portfolio)->with('message', __('generic.file') . ' (' . $file->original_filename . ') ' . __('generic.for') . ' (' . $portfolio->name . ') ' . __('generic.successDelete'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePortfolioFileRequest $request, Portfolio $portfolio, PortfolioFile $file)
    {
        $formData = $request->validated();
        //dd($formData['title']);
        try {
            PortfolioFile::where('id', $file->id)->update(['title' => $formData['title'], 'description' => $formData['description']]);
            return to_route('portfoliosfile.show', [$portfolio, $file])->with('message', __('generic.portfolio') . ' (' . $portfolio->name . ') ' . __('generic.successUpdate'));
        } catch (Exception $e) {
            return to_route('portfoliosfile.show', [$portfolio, $file])->with('error', __('generic.error') . ' (' . $e->getCode() . ') ' . __('generic.portfolio') . ' (' . $portfolio->name . ') ' . __('generic.errorUpdate'));
        }
    }

    /**
     * Make responsive images
     */
    public function responsive(Portfolio $portfolio, PortfolioFile $file)
    {
        $disk = 'public';

        try {
            $this->fileService->createResponsiveImages($disk, $file->path);
            return to_route('portfoliosfile.show', [$portfolio, $file])->with('message', __('generic.portfolio') . ' (' . $portfolio->name . ') ' . __('generic.successResponsiveImages'));
        } catch (Exception $e) {
            return to_route('portfoliosfile.show', [$portfolio, $file])->with('error', __('generic.error') . ' (' . $e->getCode() . ') ' . __('generic.portfolio') . ' (' . $portfolio->name . ') ' . __('generic.errorResponsiveImages'));
        }
    }

    
    public function responsiveCreate(Portfolio $portfolio, PortfolioFile $image, string $screen)
    {
        $disk = 'public';

        try {
            $this->fileService->createResponsiveImage($disk, $image->path, $screen);
            return to_route('portfoliosfile.show', [$portfolio, $image])->with('message', __('generic.image') . ' (' . $screen . ') ' . __('generic.successCreate'));
        } catch (Exception $e) {
            return to_route('portfoliosfile.show', [$portfolio, $image])->with('error', __('generic.error') . ' (' . $e->getCode() . ') ' . __('generic.image') . ' (' . $screen . ') ' . __('generic.errorCreate'));
        }
    }
    
    public function responsiveDownload(Portfolio $portfolio, PortfolioFile $image, string $screen)
    {
        // TODO: Open in new Tab Window!!
        
        $path = $this->fileService->getResponsivePath($image, $screen);
        $imageName = pathinfo($image->original_filename, PATHINFO_FILENAME) . '_' . $screen . '.webp';

        return $this->fileService->downloadResponsiveImg($path, $imageName);

        //return to_route('portfoliosfile.show', [$portfolio, $image])->with('message', __('generic.image') . __('generic.download'));  
    }

    /**
     * Remove the specified screen responsive image resource from storage.
     */
    public function responsiveDelete(Portfolio $portfolio, PortfolioFile $image, string $screen)
    {        
       //dd($image);

        $path = $this->fileService->getResponsivePath($image, $screen);

        $this->fileService->deleteResponsiveImg($path);

        return to_route('portfoliosfile.show', [$portfolio, $image])->with('message', __('generic.image') . ' (' . $screen . ') ' . __('generic.successDelete'));        
    }
}
