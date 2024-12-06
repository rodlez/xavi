<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\StorePFTagRequest;
use App\Models\Portfolio\PortfolioTag;
use Exception;
use Illuminate\Http\Request;

class PortfolioTagController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(StorePFTagRequest $request, PortfolioTag $tag)
    {
        $formData = $request->validated();
        try {
            PortfolioTag::where('id', $tag->id)->update($formData);
            return to_route('pf_tags.show', $tag)->with('message', __("generic.tag") . ' (' . $tag->name . ') '. __("generic.successUpdate"));
        } catch (Exception $e) {
            return to_route('pf_tags.show', $tag)->with('error', __("generic.error") . ' (' . $e->getCode() . ') ' .__("generic.tag"). ' (' . $tag->name . ') '. __("generic.errorUpdate"));

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PortfolioTag $tag)
    {
        try {
            $tag->delete();
            return to_route('pf_tags')->with('message', __('generic.tag') . ' (' . $tag->name . ') ' . __('generic.successDelete'));
        } catch (Exception $e) {
            return to_route('pf_tags')->with('error', __('generic.error') . ' (' . $e->getCode() . ') ' . __('generic.tag') . ' (' . $tag->name . ') ' . __('generic.errorDelete'));
        }
    }
}
