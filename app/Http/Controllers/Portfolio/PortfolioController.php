<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\StorePortfolioRequest;
use App\Models\Portfolio\Portfolio;
use Exception;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(StorePortfolioRequest $request, Portfolio $portfolio)
    {
        $formData = $request->validated();
        try {
            Portfolio::where('id', $portfolio->id)->update($formData);
            return to_route('portfolios.show', $portfolio)->with('message', __("generic.portfolio") . ' (' . $portfolio->name . ') '. __("generic.successUpdate"));
        } catch (Exception $e) {
            return to_route('portfolios.show', $portfolio)->with('error', __("generic.error") . ' (' . $e->getCode() . ') ' .__("generic.portfolio"). ' (' . $portfolio->name . ') '. __("generic.errorUpdate"));

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portfolio $portfolio)
    {
        try {
            $portfolio->delete();
            return to_route('portfolios')->with('message', __('generic.portfolio') . ' (' . $portfolio->name . ') ' . __('generic.successDelete'));
        } catch (Exception $e) {
            return to_route('portfolios')->with('error', __('generic.error') . ' (' . $e->getCode() . ') ' . __('generic.portfolio') . ' (' . $portfolio->name . ') ' . __('generic.errorDelete'));
        }
    }
}
