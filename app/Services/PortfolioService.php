<?php

namespace App\Services;

// Models

use App\Models\Portfolio\Portfolio;

// Files
use Illuminate\Support\Facades\Storage;

// Collection
use Illuminate\Database\Eloquent\Collection;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class PortfolioService
{
    public function __construct(private FileService $fileService)
    {
    }

     /**
     * Given a portfolio delete it from the Database and delete all the associated files if any from the Database and Disk
     * 
     * Return a message string to use in the redirection in the Controller.
     *
     * @param  Portfolio $portfolio
     * @return string
     */
    public function deletePortfolio(Portfolio $portfolio)
    {
        try {
            $files = $portfolio->files;
            $result = $portfolio->delete();

            // If the portfolio is deleted, check if there is associated files and delete them.
            if ($result) {
                if ($files->isNotEmpty()) {
                    $this->fileService->deleteFiles($files);
                }
                
                return to_route('portfolios')->with('message', __('generic.portfolio') . ' (' . $portfolio->name . ') ' . __('generic.successDelete'));                
            } 
        } catch (Exception $e) {            
            return to_route('portfolios')->with('error', __('generic.error') . ' (' . $e->getCode() . ') ' . __('generic.portfolio') . ' (' . $portfolio->name . ') ' . __('generic.errorDelete'));
        } 
        
    }

     /**
     * Given an array with portfolio ids, delete them from the Database and also delete all the associated files if any from the Database and Disk
     * 
     * Return a message string to use in the redirection in the Controller.
     *
     * @param  array $portfolioIds
     * @return string
     */
    public function bulkDeletePortfolios(array $portfolioIds)
    {
        try {
        
            foreach ($portfolioIds as $portfolioId) {
                $portfolio = Portfolio::find($portfolioId);
                
                $files = $portfolio->files;
                $result = $portfolio->delete();

                if ($result) {
                    if ($files->isNotEmpty()) {
                        $this->fileService->deleteFiles($files);
                    }                
                }
            } 
            return to_route('portfolios')->with('message', __('generic.bulkDelete'));    
        }
        catch (Exception $e) {            
            return to_route('portfolios')->with('error', __('generic.error') . ' (' . $e->getCode() . ') ' . __('generic.portfolios') . ' ' . __('generic.errorDelete'));
        }         
       
    }

}


