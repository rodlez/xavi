<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\StorePFTypeRequest;
use App\Models\Portfolio\PortfolioTypeTranslation;
use Exception;
use Illuminate\Http\Request;

class PortfolioTypeTranslationController extends Controller
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
    public function update(StorePFTypeRequest $request, PortfolioTypeTranslation $translation)
    {
        $validated = $request->validated();
        $validated['lang_id'] = $translation->language->id;

        try {
            PortfolioTypeTranslation::where('id', $translation->id)->update($validated);
            return to_route('pf_types.show', $translation->type)->with('message', '(' . $translation->language->name . ') Translation successfully updated');
        } catch (Exception $e) {
            return to_route('pf_types.show', $translation->type)->with('error', 'Error(' . $e->getCode() . '): (' . $translation->language->name . ') Translation can not be updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PortfolioTypeTranslation $translation)
    {
        try {
            $translation->delete();
            return to_route('pf_types.show', $translation->type)->with('message', '(' . $translation->language->name . ') Translation successfully deleted');
        } catch (Exception $e) {
            return to_route('pf_types.show', $translation->type)->with('error', 'Error(' . $e->getCode() . '): (' . $translation->language->name . ') Translation can not be deleted');
        }
    }
}
