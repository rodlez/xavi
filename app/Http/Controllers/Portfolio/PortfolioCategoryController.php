<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\StorePFCategoryRequest;
use App\Models\Portfolio\PortfolioCategory;
use Exception;
use Illuminate\Http\Request;

class PortfolioCategoryController extends Controller
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
    public function update(StorePFCategoryRequest $request, PortfolioCategory $category)
    {
        $formData = $request->validated();
        try {
            PortfolioCategory::where('id', $category->id)->update($formData);
            return to_route('pf_categories.show', $category)->with('message', 'Category ('.$category->name.') successfully updated');
        } catch (Exception $e) {
            return to_route('pf_categories.show', $category)->with('error', 'Category ('.$category->name.') can not be updated');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PortfolioCategory $category)
    {
        try {
            $category->delete();
            return to_route('pf_categories')->with('message', 'Category ('.$category->name.') successfully deleted');
        } catch (Exception $e) {
            return to_route('pf_categories')->with('error', 'Category ('.$category->name.') can not be deleted');
        }
    }
}
