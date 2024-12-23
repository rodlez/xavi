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
    public function __construct(private FileService $fileService) {        
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
        
        if ($file->type == 'image')
        {
            if(!$this->fileService->isLastImage($file))
            {
                $this->fileService->decreasePortfolioPositions($file);                
            }
        }

        $this->fileService->deleteOneFile($file);
        
        //return back()->with('message', __("generic.file") . ' (' . $file->original_filename . ') ' . __("generic.for") . ' (' . $portfolio->name . ') ' . __("generic.successDelete"));

        return to_route('portfolios.show', $portfolio)->with('message', __("generic.file") . ' (' . $file->original_filename . ') ' . __("generic.for") . ' (' . $portfolio->name . ') ' . __("generic.successDelete"));

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
            return to_route('portfoliosfile.show', [$portfolio, $file])->with('message', __("generic.portfolio") . ' (' . $portfolio->name . ') '. __("generic.successUpdate"));
        } catch (Exception $e) {
            return to_route('portfoliosfile.show', [$portfolio, $file])->with('error', __("generic.error") . ' (' . $e->getCode() . ') ' .__("generic.portfolio"). ' (' . $portfolio->name . ') '. __("generic.errorUpdate"));
        }
    }



    /**
     * Make responsive images
     */
    public function responsive(Portfolio $portfolio, PortfolioFile $file)
    {
       //dd($file);

       try {
       $this->fileService->createResponsiveImages('public', $file->path);
       return to_route('portfoliosfile.show', [$portfolio, $file])->with('message', __("generic.portfolio") . ' (' . $portfolio->name . ') '. __("generic.successResponsiveImages"));

       }
       catch (Exception $e) {
        return to_route('portfoliosfile.show', [$portfolio, $file])->with('error', __("generic.error") . ' (' . $e->getCode() . ') ' .__("generic.portfolio"). ' (' . $portfolio->name . ') '. __("generic.errorResponsiveImages"));
        }

        //dd($formData['title']);
        /* try {
            PortfolioFile::where('id', $file->id)->update(['title' => $formData['title'], 'description' => $formData['description']]);
            return to_route('portfoliosfile.show', [$portfolio, $file])->with('message', __("generic.portfolio") . ' (' . $portfolio->name . ') '. __("generic.successUpdate"));
        } catch (Exception $e) {
            return to_route('portfoliosfile.show', [$portfolio, $file])->with('error', __("generic.error") . ' (' . $e->getCode() . ') ' .__("generic.portfolio"). ' (' . $portfolio->name . ') '. __("generic.errorUpdate"));
        } */
    }

}
