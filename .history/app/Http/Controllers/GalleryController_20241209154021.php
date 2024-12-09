<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::all();
        return view('galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'path' => 'required|image|max:2048', // Ensure it's an image and <= 2MB
        ]);

        // Store the uploaded image
        $path = $request->file('path')->store('gallery_images', 'public');

        // Save to the database
        Gallery::create([
            'category' => $validated['category'],
            'path' => $path,
        ]);

        return redirect()->route('galleries.index')->with('success', 'Image added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        return view('galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'path' => 'nullable|image|max:2048', // Image is optional during updates
        ]);

        // If a new image is uploaded, replace the old one
        if ($request->hasFile('path')) {
            $path = $request->file('path')->store('gallery_images', 'public');
            $gallery->path = $path;
        }

        $gallery->category = $validated['category'];
        $gallery->save();

        return redirect()->route('galleries.index')->with('success', 'Image updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        //
    }
}
