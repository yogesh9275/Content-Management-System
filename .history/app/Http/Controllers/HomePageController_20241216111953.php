<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\HomePage;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $homePages = HomePage::all();
        return view('home.index', compact('homePages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('home.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Log the start of the request
        Log::info('Store method called. Request data:', $request->all());

        // Validate the request data
        $validated = $this->validateRequest($request);

        // Handle file upload if present
        $imagePath = null;
        if ($request->hasFile('image_path')) {
            Log::info('Image file uploaded.');
            $imagePath = $this->handleFileUpload($request, 'image_path');
        }

        // Create a new HomePage record
        HomePage::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image_path' => $imagePath,
        ]);

        Log::info('HomePage element created successfully.');

        // Redirect to the index page with a success message
        return redirect('/home')->with('success', 'HomePage element added successfully!');
    }

    protected function validateRequest(Request $request)
    {
        // Validate the request fields
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_path' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);
    }

    protected function handleFileUpload(Request $request, $fileInputName)
    {
        // Get the file from the request
        $file = $request->file($fileInputName);

        // Check if the file is valid
        if ($file && $file->isValid()) {
            // Define the destination path where the file will be stored
            $destinationPath = public_path('uploads/home');

            // Ensure the uploads directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // Generate a unique filename based on the original file name
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            // Move the file to the uploads directory
            $file->move($destinationPath, $fileName);

            // Generate the relative file path for the database
            $filePath = 'uploads/home/' . $fileName;

            Log::info('File uploaded. File path: ' . $filePath);

            return $filePath;
        }

        Log::error('No valid file uploaded.');
        return null;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $homePage = HomePage::findOrFail($id);
        return view('home.edit', compact('homePage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Log the start of the request
        Log::info('Update method called. Request data:', $request->all());

        // Validate the request data
        $validated = $this->validateRequest($request);

        // Find the existing element to be updated
        $homePage = HomePage::findOrFail($id);

        // Handle file upload if present
        $imagePath = $homePage->image_path;
        if ($request->hasFile('image_path')) {
            Log::info('Image file uploaded.');
            $imagePath = $this->handleFileUpload($request, 'image_path');
        }

        // Update the HomePage record
        $homePage->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image_path' => $imagePath,
        ]);

        Log::info('HomePage element updated successfully.');

        // Redirect to the index page with a success message
        return redirect('/home')->with('success', 'HomePage element updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $homePage = HomePage::findOrFail($id);
        $homePage->delete();

        Log::info('HomePage element deleted successfully.');

        return redirect('/home')->with('success', 'HomePage element deleted successfully!');
    }
}
