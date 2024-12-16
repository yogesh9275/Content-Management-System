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

     // The show method as required by the resource route
     public function show($id)
     {
         $homePage = HomePage::findOrFail($id); // You can fetch a specific HomePage here
         return view('home.show', compact('homePage'));  // Define view accordingly
     }

    /**
     * Display a listing of the resource.
     */
    public function about()
{
    // Retrieve HomePage records where the element starts with 'About-'
    $homePages = HomePage::where('element', 'LIKE', 'About-%')->get();

    // Return the view with the filtered homePages variable
    return view('home.about', compact('homePages'));
}


    /**
     * Display a listing of the resource.
     */
    public function slider()
    {
        $homePages = HomePage::all();
        return view('home.index', compact('homePages'));
    }

    /**
     * Display a listing of the resource.
     */
    public function vision()
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

        // Validate the incoming request based on the selected element
        $this->validateRequest($request);

        // Handle the file upload based on the selected element type
        $filePath = null;

        // Check and handle file upload for Image (only if element type is Image)
        if ($request->hasFile('data-image') && $request->input('element') === 'Image') {
            Log::info('Image file uploaded.');
            $filePath = $this->handleFileUpload($request, 'data-image');
        }

        // Log the element type and associated data
        $elementType = $request->input('element');
        $data = $filePath ?? $request->input('data-' . strtolower(str_replace(' ', '-', $elementType)));

        Log::info('Element type: ' . $elementType);
        Log::info('Data (text or file path): ' . $data);

        // Create a new HomePage record with the element and its corresponding data
        HomePage::create([
            'element' => $elementType,
            'data' => $data,
        ]);

        Log::info('HomePage element created successfully.');

        // Redirect to the Home page with a success message
        Log::info('Redirecting to /home with success message.');
        return redirect('/homepage')->with('success', 'HomePage element added successfully!');
    }

    protected function validateRequest(Request $request)
    {
        // Initialize an empty validation rules array
        $rules = [];

        // Use switch-case to apply rules conditionally based on the input
        switch (true) {
            case $request->has('title'):
                // Validate title if it's part of the request
                $rules['title'] = 'required|string|max:255';
                break;

            case $request->has('description'):
                // Validate description if it's part of the request
                $rules['description'] = 'required|string';
                break;

            case $request->has('image_path'):
                // Validate image_path if a file is uploaded
                $rules['image_path'] = 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:10240';
                break;
        }

        try {
            // Apply validation with the dynamically created rules
            $validatedData = $request->validate($rules);

            // Log the validated data
            Log::info('Request data validated successfully', $validatedData);

            return $validatedData; // Return the validated data
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log the validation errors if they exist
            Log::error('Validation failed:', $e->errors());

            // Re-throw the exception for proper handling by the framework
            throw $e;
        }
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

        // Validate the incoming request based on the selected element
        $this->validateRequest($request);

        // Find the existing HomePage record to be updated
        $homePage = HomePage::findOrFail($id);

        // Initialize variable to store file path for image, if present
        $filePath = null;

        // Check and handle file upload for Image (only if element type is Image)
        if ($request->hasFile('data-image') && $request->input('element') === 'Image') {
            Log::info('Image file uploaded.');
            $filePath = $this->handleFileUpload($request, 'data-image');
        }

        // Log the element type and associated data
        $elementType = $request->input('element');
        $data = $filePath ?? $request->input('data-' . strtolower(str_replace(' ', '-', $elementType)));

        Log::info('Element type: ' . $elementType);
        Log::info('Data (text or file path): ' . $data);

        // Update the HomePage record
        $homePage->update([
            'element' => $elementType,
            'data' => $data,
        ]);

        Log::info('HomePage element updated successfully.');

        // Redirect to the Home page with a success message
        Log::info('Redirecting to /homepage with success message.');
        return redirect('/homepage')->with('success', 'HomePage element updated successfully!');
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
