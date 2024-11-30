<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\StorePFCategoryTranslationRequest;
use App\Models\Portfolio\PortfolioCategoryTranslation;
use Exception;
use Illuminate\Http\Request;

class PortfolioCategoryTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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
    public function update(StorePFCategoryTranslationRequest $request, PortfolioCategoryTranslation $translation)
    {
        $validated = $request->validated();
        $validated['lang_id'] = $request->language_id;

        try {
            PortfolioCategoryTranslation::where('id', $translation->id)->update($validated);
            /* return to_route('pf_categories.show', $language)->with('message', 'Language successfully updated'); */
             return to_route('pf_categories_trans');
        } catch (Exception $e) {
            /* return to_route('pf_categories.show', $language)->with('message', 'Error(' . $e->getCode() . ') Language can not be updated.'); */
            return to_route('pf_categories_trans');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PortfolioCategoryTranslation $translation)
    {
        try {
            $translation->delete();
            return to_route('pf_categories_trans');
            /* return to_route('wk_types.index')->with('message', 'Type (' . $type->name . ') deleted.'); */
        } catch (Exception $e) {
            /* return to_route('wk_types.index')->with('message', 'Error (' . $e->getCode() . ') Type: ' . $type->name . ' can not be deleted.'); */
            return to_route('pf_categories_trans');
        }
    }
}
