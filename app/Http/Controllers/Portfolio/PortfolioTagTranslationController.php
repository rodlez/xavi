<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\StorePFTagRequest;
use App\Models\Portfolio\PortfolioTagTranslation;
use Exception;
use Illuminate\Http\Request;

class PortfolioTagTranslationController extends Controller
{
     /**
     * Update the specified resource in storage.
     */
    public function update(StorePFTagRequest $request, PortfolioTagTranslation $translation)
    {
        $validated = $request->validated();
        $validated['lang_id'] = $translation->language->id;

        try {
            PortfolioTagTranslation::where('id', $translation->id)->update($validated);
            return to_route('pf_tags.show', $translation->tag)->with('message', __('generic.translation') . ' (' . $translation->language->name . ') ' . __('generic.successUpdate'));
        } catch (Exception $e) {
            return to_route('pf_tags.show', $translation->tag)->with('error', __('generic.error') . ' (' . $e->getCode() . ') ' . __('generic.translation') . ' (' . $translation->language->name . ') ' . __('generic.errorUpdate'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PortfolioTagTranslation $translation)
    {
        try {
            $translation->delete();
            return to_route('pf_tags.show', $translation->tag)->with('message', __('generic.translation') . ' (' . $translation->language->name . ') ' . __('generic.successDelete'));
        } catch (Exception $e) {
            return to_route('pf_tags.show', $translation->tag)->with('error', __('generic.error') . ' (' . $e->getCode() . ') ' . __('generic.translation') . ' (' . $translation->language->name . ') ' . __('generic.errorDelete'));
        }
    }
}
