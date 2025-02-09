<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\StorePortfolioTranslationRequest;
use App\Models\Portfolio\PortfolioTranslation;
use App\Services\TranslationService;
use Exception;

class PortfolioTranslationController extends Controller
{
    public function __construct(private TranslationService $translationService)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePortfolioTranslationRequest $request, PortfolioTranslation $translation)
    {
        try {
            $this->translationService->updateTranslationPortfolio($translation, $request->validated());

            return to_route('portfolios.show', $translation->portfolio)->with('message', __('generic.translation') . ' (' . $translation->language->name . ') ' . __('generic.successUpdate'));
        } catch (Exception $e) {
            return to_route('portfolios.show', $translation->portfolio)->with('error', __('generic.error') . ' (' . $e . ') ' . __('generic.translation') . ' (' . $translation->language->name . ') ' . __('generic.errorUpdate'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PortfolioTranslation $translation)
    {
        try {
            $translation->delete();
            return to_route('portfolios.show', $translation->portfolio)->with('message', __('generic.translation') . ' (' . $translation->language->name . ') ' . __('generic.successDelete'));
        } catch (Exception $e) {
            return to_route('portfolios.show', $translation->portfolio)->with('error', __('generic.error') . ' (' . $e->getCode() . ') ' . __('generic.translation') . ' (' . $translation->language->name . ') ' . __('generic.errorDelete'));
        }
    }
}
