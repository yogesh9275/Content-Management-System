<?php

namespace App\Http\Controllers;

use App\Models\AboutUsElement;
use Illuminate\Http\Request;

class AboutUsElementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $elements = AboutUsElement::all();
        return view('about-us.index', compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('about-us.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'element' => 'required|string',
            'data' => 'required|string',
        ]);

        AboutUsElement::create($request->all());

        return redirect('/about-us')->with('success', 'Element added successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(AboutUsElement $aboutUsElement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AboutUsElement $aboutUsElement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AboutUsElement $aboutUsElement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutUsElement $aboutUsElement)
    {
        //
    }
}