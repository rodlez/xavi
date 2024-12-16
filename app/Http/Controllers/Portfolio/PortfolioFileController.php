<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use App\Models\Portfolio\Portfolio;
use App\Models\Portfolio\PortfolioFile;
use App\Services\FileService;
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
        $this->fileService->deleteOneFile($file);
        
        return back()->with('message', 'File ' . $file->original_filename . ' from Sport: ' . $portfolio->title . ' deleted.');
    }
}
