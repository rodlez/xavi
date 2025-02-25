<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class Playground extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        
        // USING WITH
       /*  $data = [
            'title' => 'oli',
            'description' => 'mire usted',
        ]; 

        return view('playground')->with($data); */
       

        //USING COMPACT

        $title = 'This is a Playground page';
        $description = 'Here there is different Components to test';  

        
        return view('playground', compact('title', 'description'))->layout('layouts.xavi');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
