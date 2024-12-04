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
            return to_route('pf_types.show', $type)->with('message', 'Type ('.$type->name.') successfully updated');
        } catch (Exception $e) {
            return to_route('pf_types.show', $type)->with('error', 'Type ('.$type->name.') can not be updated');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PortfolioType $type)
    {
        try {
            $type->delete();
            return to_route('pf_types')->with('message', 'Type ('.$type->name.') successfully deleted');
        } catch (Exception $e) {
            return to_route('pf_types')->with('error', 'Type ('.$type->name.') can not be deleted');
        }
    }
}
