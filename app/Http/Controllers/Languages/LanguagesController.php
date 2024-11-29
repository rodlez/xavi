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
            /* return to_route('languages.show', $language)->with('message', 'Language successfully updated'); */
             return to_route('languages.show', $language);
        } catch (Exception $e) {
            /* return to_route('languages.show', $language)->with('message', 'Error(' . $e->getCode() . ') Language can not be updated.'); */
            return to_route('languages.show', $language);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Languages $language)
    {
        try {
            $language->delete();
            return to_route('languages');
            /* return to_route('wk_types.index')->with('message', 'Type (' . $type->name . ') deleted.'); */
        } catch (Exception $e) {
            /* return to_route('wk_types.index')->with('message', 'Error (' . $e->getCode() . ') Type: ' . $type->name . ' can not be deleted.'); */
            return to_route('languages');
        }
    }
}
