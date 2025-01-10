<?php

namespace App\Http\Controllers\Section;

use App\Http\Controllers\Controller;
use App\Models\Languages;
use App\Models\Portfolio\Portfolio as PortfolioModel;
use App\Models\Portfolio\PortfolioCategory;
use App\Models\Portfolio\PortfolioCategoryTranslation;
use App\Models\Portfolio\PortfolioTagTranslation;
use App\Models\Portfolio\PortfolioTranslation;
use App\Models\Portfolio\PortfolioType;
use App\Models\Portfolio\PortfolioTypeTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Portfolio extends Controller
{



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $language = App::currentLocale();
        // Need All the Portfolios for the language AND with published status == 1
        $languageId = Languages::where('code', $language)->pluck('id')->first();        
       
        
        // One Approach -> Passing the translations directly
        //$publishedPortfolios = PortfolioModel::where('published', 1)->pluck('id');
        //$portfolios = PortfolioTranslation::where('lang_id', $languageId)->whereIn('portfolio_id', $publishedPortfolios)->orderby('id', 'ASC')->get();        
        //$types = PortfolioTypeTranslation::where('lang_id', $languageId)->get();

        // Second Approach, passing the parent and use the relations to get the translations
        // This way the position(order in the gallery) of the portfolios can be determined by the parent not by the children translations
        $types = PortfolioType::orderby('position', 'ASC')->get();
        //dd($tipos[0]->translations);

        $portfolios = PortfolioModel::where('published', 1)->orderby('position', 'ASC')->get();
        //dd($porfs);

        return view('section.portfolio.portfolio', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-slate-600',
            'textMenuHeader' => 'hover:text-slate-400',
            'bgMenuColor' => 'bg-slate-800',
            'menuTextColor' => 'text-slate-800',
            'focusColor' => 'focus:ring-slate-500 focus:border-slate-500',
            // Test Colors
            'typeMenuColor' => 'bg-orange-400',
            // Layout
            'title' => 'Portfolio',
            // Data
            'portfolios' => $portfolios,
            'types' => $types,            
            'languageId' => $languageId,
            
        ])->layout('layouts.xavi');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $language = App::currentLocale();

        $languageId = Languages::where('code', $language)->pluck('id');

        // get() returns a collection, first() returns a single instance
        $portfolioTranslation = PortfolioTranslation::where('portfolio_id', $id)->where('lang_id', $languageId)->first();

        $portfolio = PortfolioModel::where('id', $id)->first();

        
        return view('section.portfolio.portfolio-show', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-slate-600',
            'textMenuHeader' => 'hover:text-slate-400',
            'bgMenuColor' => 'bg-slate-800',
            'menuTextColor' => 'text-slate-800',
            'focusColor' => 'focus:ring-slate-500 focus:border-slate-500',
            // Layout
            'title' => 'Portfolio',
            // Data
            'portfolio' => $portfolioTranslation,
            'files' => $portfolio->files,
            'language' => $language,
        ])->layout('layouts.xavi');
    }

    /**
     * Display the specified resource.
     */
    public function types(string $id)
    {
        $language = App::currentLocale();

        $languageId = Languages::where('code', $language)->pluck('id');        

        //$typeIdTranslation = PortfolioTypeTranslation::where('pf_type_id', $id)->where('lang_id', $languageId)->pluck('id');

        $typeTranslation = PortfolioTypeTranslation::where('pf_type_id', $id)->where('lang_id', $languageId)->first();

        // get() returns a collection, first() returns a single instance
        
       
        //$portfolios = PortfolioTranslation::where('pf_type_trans_id', $typeIdTranslation)->where('lang_id', $languageId)->get();
        $portfolios = PortfolioTranslation::where('pf_type_trans_id', $typeTranslation->id)->where('lang_id', $languageId)->get();

        //$portfolio = PortfolioModel::where('id', $id)->first();

        
        return view('section.portfolio.portfolio-types', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-slate-600',
            'textMenuHeader' => 'hover:text-slate-400',
            'bgMenuColor' => 'bg-slate-800',
            'menuTextColor' => 'text-slate-800',
            'focusColor' => 'focus:ring-slate-500 focus:border-slate-500',
            // Layout
            'title' => 'Portfolio',
            // Data
            'portfolios' => $portfolios,
            //'files' => $portfolio->files,
            'language' => $language,
            'type' => $typeTranslation,
        ])->layout('layouts.xavi');
    }

    /**
     * Display the specified resource.
     */
    public function categories(string $id)
    {
        $language = App::currentLocale();

        $languageId = Languages::where('code', $language)->pluck('id');        

        //$typeIdTranslation = PortfolioTypeTranslation::where('pf_type_id', $id)->where('lang_id', $languageId)->pluck('id');

        $categoryTranslation = PortfolioCategoryTranslation::where('pf_cat_id', $id)->where('lang_id', $languageId)->first();

        // get() returns a collection, first() returns a single instance
        
       
        //$portfolios = PortfolioTranslation::where('pf_type_trans_id', $typeIdTranslation)->where('lang_id', $languageId)->get();
        $portfolios = PortfolioTranslation::where('pf_cat_trans_id', $categoryTranslation->id)->where('lang_id', $languageId)->get();

        //$portfolio = PortfolioModel::where('id', $id)->first();

        
        return view('section.portfolio.portfolio-categories', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-slate-600',
            'textMenuHeader' => 'hover:text-slate-400',
            'bgMenuColor' => 'bg-slate-800',
            'menuTextColor' => 'text-slate-800',
            'focusColor' => 'focus:ring-slate-500 focus:border-slate-500',
            // Layout
            'title' => 'Portfolio',
            // Data
            'portfolios' => $portfolios,
            //'files' => $portfolio->files,
            'language' => $language,
            'category' => $categoryTranslation,
        ])->layout('layouts.xavi');
    }

    /**
     * Display the specified resource.
     */
    public function tags(string $id)
    {
        $language = App::currentLocale();

        $languageId = Languages::where('code', $language)->pluck('id');        

        //$typeIdTranslation = PortfolioTypeTranslation::where('pf_type_id', $id)->where('lang_id', $languageId)->pluck('id');

        $tagTranslation = PortfolioTagTranslation::where('pf_tag_id', $id)->where('lang_id', $languageId)->first();

        // get() returns a collection, first() returns a single instance
        //dd('tagTranslation', $tagTranslation->translations);

        //$portfolios =  PortfolioTranslation::whereRelation('tags', $tagTranslation)->where('lang_id', $languageId)->get();
       
        //dd('portfolios', $portfolios);

        //$portfolios = PortfolioTranslation::where('pf_type_trans_id', $typeIdTranslation)->where('lang_id', $languageId)->get();
        //$portfolios = PortfolioTranslation::where('pf_cat_trans_id', $tagTranslation->id)->where('lang_id', $languageId)->get();

        //$portfolio = PortfolioModel::where('id', $id)->first();

        
        return view('section.portfolio.portfolio-tags', [
            // Styles
            'underlineMenuHeader' => 'border-b-2 border-b-slate-600',
            'textMenuHeader' => 'hover:text-slate-400',
            'bgMenuColor' => 'bg-slate-800',
            'menuTextColor' => 'text-slate-800',
            'focusColor' => 'focus:ring-slate-500 focus:border-slate-500',
            // Layout
            'title' => 'Portfolio',
            // Data
            'portfolios' => $tagTranslation->translations,
            //'files' => $portfolio->files,
            'language' => $language,
            'tag' => $tagTranslation,
        ])->layout('layouts.xavi');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
