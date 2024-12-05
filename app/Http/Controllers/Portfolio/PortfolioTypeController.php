<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\StorePFTypeRequest;
use App\Models\Portfolio\PortfolioType;
use Exception;
use Illuminate\Http\Request;

class PortfolioTypeController extends Controller
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
    public function update(StorePFTypeRequest $request, PortfolioType $type)
    {
        $formData = $request->validated();
        try {
            PortfolioType::where('id', $type->id)->update($formData);
            return to_route('pf_types.show', $type)->with('message', __("generic.type") . ' (' . $type->name . ') '. __("generic.successUpdate"));
        } catch (Exception $e) {
            return to_route('pf_types.show', $type)->with('error', __("generic.error") . ' (' . $e->getCode() . ') ' .__("generic.type"). ' (' . $type->name . ') '. __("generic.errorUpdate"));

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PortfolioType $type)
    {
        try {
            $type->delete();
            return to_route('pf_types')->with('message', __('generic.type') . ' (' . $type->name . ') ' . __('generic.successDelete'));
        } catch (Exception $e) {
            return to_route('pf_types')->with('error', __('generic.error') . ' (' . $e->getCode() . ') ' . __('generic.type') . ' (' . $type->name . ') ' . __('generic.errorDelete'));
        }
    }
}
