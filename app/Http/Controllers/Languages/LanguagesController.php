<?php

namespace App\Http\Controllers\Languages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Languages\StoreLanguagesRequest;
use App\Models\Languages;
use Exception;
use Illuminate\Http\Request;

class LanguagesController extends Controller
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
    public function update(StoreLanguagesRequest $request, Languages $language)
    {
        $formData = $request->validated();
        try {
            Languages::where('id', $language->id)->update($formData);
            return to_route('languages.show', $language)->with('message', __('generic.language') . ' (' . $language->name . ') ' . __('generic.successUpdate'));
        } catch (Exception $e) {
            return to_route('languages.show', $language)->with('error', __('generic.error') . ' (' . $e->getCode() . ') ' . __('generic.language') . ' (' . $language->name . ') ' . __('generic.errorUpdate'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Languages $language)
    {
        try {
            $language->delete();
            return to_route('languages')->with('message', __('generic.language') . ' (' . $language->name . ') ' . __('generic.successDelete'));
        } catch (Exception $e) {
            return to_route('languages')->with('error', __('generic.error') . ' (' . $e->getCode() . ') ' . __('generic.language') . ' (' . $language->name . ') ' . __('generic.errorDelete'));
        }
    }
}
