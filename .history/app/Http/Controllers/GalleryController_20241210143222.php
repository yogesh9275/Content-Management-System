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

        // Define the custom upload path
        $uploadPath = public_path('uploads/gallery');

        // Ensure the directory exists
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true); // Create the directory if it doesn't exist
        }

        // Get the uploaded file and generate a unique name
        $file = $request->file('path');
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

        // Move the file to the custom upload path
        $file->move($uploadPath, $fileName);

        // Save to the database with the correct sequence
        Gallery::create([
            'category' => $validated['category'], // Save the category first
            'path' => 'uploads/gallery/' . $fileName, // Save the relative file path
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
            // Define the custom upload path
            $uploadPath = public_path('uploads/gallery');

            // Ensure the directory exists
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true); // Create the directory if it doesn't exist
            }

            // Get the uploaded file and generate a unique name
            $file = $request->file('path');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            // Delete the old file if it exists
            if ($gallery->path && file_exists(public_path($gallery->path))) {
                unlink(public_path($gallery->path));
            }

            // Move the new file to the custom upload path
            $file->move($uploadPath, $fileName);

            // Update the path in the gallery record
            $gallery->path = 'uploads/gallery/' . $fileName;
        }

        // Update the category and save
        $gallery->category = $validated['category'];
        $gallery->save();

        return redirect()->route('galleries.index')->with('success', 'Image updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        // Optionally delete the image file from the public/uploads/gallery directory
        $filePath = public_path('uploads/gallery/' . $gallery->path);

        if (file_exists($filePath)) {
            unlink($filePath); // Delete the file
        }

        // Delete the gallery record from the database
        $gallery->delete();

        return redirect()->route('galleries.index')->with('success', 'Image deleted successfully.');
    }

    public function response()
    {
        // Get all Gallery records
        $galleries = Gallery::all();

        // Customize the response as per your needs
        return response()->json([
            'status' => 'success',
            'data' => $galleries,
            'message' => 'Gallery elements retrieved successfully',
        ]);
    }
}
