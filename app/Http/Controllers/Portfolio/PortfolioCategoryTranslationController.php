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
        $validated['lang_id'] = $translation->language->id;

        try {
            PortfolioCategoryTranslation::where('id', $translation->id)->update($validated);
            return to_route('pf_categories.show', $translation->category)->with('message', __('generic.translation') . ' (' . $translation->language->name . ') ' . __('generic.successUpdate'));
        } catch (Exception $e) {
            return to_route('pf_categories.show', $translation->category)->with('error', __('generic.error') . ' (' . $e->getCode() . ') ' . __('generic.translation') . ' (' . $translation->language->name . ') ' . __('generic.errorUpdate'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PortfolioCategoryTranslation $translation)
    {
        try {
            $translation->delete();
            return to_route('pf_categories.show', $translation->category)->with('message', __('generic.translation') . ' (' . $translation->language->name . ') ' . __('generic.successDelete'));
        } catch (Exception $e) {
            return to_route('pf_categories.show', $translation->category)->with('error', __('generic.error') . ' (' . $e->getCode() . ') ' . __('generic.translation') . ' (' . $translation->language->name . ') ' . __('generic.errorDelete'));
        }
    }
}
