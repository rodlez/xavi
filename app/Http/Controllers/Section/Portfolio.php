<?php

namespace App\Http\Controllers\Section;

use App\Http\Controllers\Controller;
use App\Models\Languages;
use App\Models\Portfolio\Portfolio as PortfolioModel;
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

        $languageId = Languages::where('code', $language)->pluck('id');

        //$portfolios = PortfolioModel::all();
        //$types = PortfolioType::all();

        $portfolios = PortfolioTranslation::where('lang_id', $languageId)->get();
        //dd($portfolios);
        $types = PortfolioTypeTranslation::where('lang_id', $languageId)->get();

        return view('section.portfolio.portfolio', [
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
            'types' => $types,
            'language' => $language,
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

        $portfolio = PortfolioTranslation::where('id', $id)->get();

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
            'portfolio' => $portfolio,
            'language' => $language,
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
