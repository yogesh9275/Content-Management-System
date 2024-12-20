<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\HomePage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        return view('home.show', compact('homePage')); // Define view accordingly
    }

    /**
     * Display a listing of the resource.
     */
    public function about()
    {
        // Retrieve HomePage records where the element starts with 'About-'
        $homePages = HomePage::where('element', 'LIKE', 'About-%')->get();

        // Return the view with the filtered homePages variable
        return view('home.index', compact('homePages'));
    }

    /**
     * Display a listing of the resource.
     */
    public function slider()
    {
        // Retrieve HomePage records where the element starts with 'Slider-'
        $homePages = HomePage::where('element', 'LIKE', 'slider-image-%')->get();

        // Check if the $homePages collection is empty
        if ($homePages->isEmpty()) {
            Log::info('The retrieved $homePages collection is empty.');
        } else {
            Log::info('Retrieved $homePages data:', ['homePages' => $homePages]);
        }

        // Return the view with the filtered homePages variable
        return view('home.index', compact('homePages'));
    }

    /**
     * Display a listing of the resource.
     */
    public function vision()
    {
        // Retrieve HomePage records where the element starts with 'Vision-'
        $homePages = HomePage::where('element', 'LIKE', 'Vision-%')->get();

        // Return the view with the filtered homePages variable
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
        if ($request->hasFile('data-image') && $request->input('element') === 'image') {
            Log::info('Image file uploaded.');
            $filePath = $this->handleFileUpload($request, 'data-image');
        } elseif ($request->hasFile('data-about-image') && $request->input('element') === 'about-image') {
            Log::info('About Image file uploaded.');
            $filePath = $this->handleFileUpload($request, 'data-about-image');
        } elseif ($request->hasFile('data-vision-image') && $request->input('element') === 'vision-image') {
            Log::info('Vision Image file uploaded.');
            $filePath = $this->handleFileUpload($request, 'data-vision-image');
        } elseif ($request->hasFile('data-slider-image') && $request->input('element') === 'slider-image') {
            Log::info('Slider Image file uploaded.');
            $filePath = $this->handleFileUpload($request, 'data-slider-image');
        }

        // Log the element type and associated data
        $elementType = $request->input('element');
        $data = $filePath ?? $request->input('data-' . strtolower(str_replace(' ', '-', $elementType)));

        // If element type is 'slider-image', generate a new slider-image id
        if ($elementType === 'slider-image') {
            // Get the last slider-image record based on the element type
            $lastSliderImage = HomePage::where('element', 'like', 'slider-image-%')->orderBy('id', 'desc')->first();

            // Generate the new slider-image element ID
            $nextId = $lastSliderImage ? intval(substr($lastSliderImage->element, strrpos($lastSliderImage->element, '-') + 1)) + 1 : 1;
            $newElementType = 'slider-image-' . $nextId;

            // Update the element type with the new slider-image id
            $elementType = $newElementType;

            Log::info('Updated Element type: ' . $elementType);
            Log::info('Data (text or file path): ' . $data);
        }

        // Create a new HomePage record with the element and its corresponding data
        HomePage::create([
            'element' => $elementType,
            'data' => $data,
        ]);

        Log::info('HomePage element created successfully.');

        // Redirect based on the element type to different routes
        $redirectTo = '/homepage'; // Default redirect

        if (in_array($elementType, ['title', 'description', 'image'])) {
            $redirectTo = '/homepage';
        } elseif (in_array($elementType, ['vision-title', 'vision-description', 'vision-image'])) {
            $redirectTo = '/homepage/vision';
        } elseif (in_array($elementType, ['about-title', 'about-description', 'about-image'])) {
            $redirectTo = '/homepage/about';
        } elseif ($elementType === 'slider-image') {
            $redirectTo = '/homepage/slider';
        }

        Log::info('Redirecting to ' . $redirectTo . ' with success message.');

        // Redirect to the appropriate page based on the element type
        return redirect($redirectTo)->with('success', 'HomePage element added successfully!');
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

            case $request->has('image_path') || $request->has('image_path'):
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
            $destinationPath = base_path('uploads/home');

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
        if ($request->hasFile('data-image') && $request->input('element') === 'image') {
            Log::info('Image file uploaded.');
            $filePath = $this->handleFileUpload($request, 'data-image');
        } elseif ($request->hasFile('data-about-image') && $request->input('element') === 'about-image') {
            Log::info('About Image file uploaded.');
            $filePath = $this->handleFileUpload($request, 'data-about-image');
        } elseif ($request->hasFile('data-vision-image') && $request->input('element') === 'vision-image') {
            Log::info('Vision Image file uploaded.');
            $filePath = $this->handleFileUpload($request, 'data-vision-image');
        } elseif ($request->hasFile('data-slider-image') && preg_match('/^slider-image-\d+$/', $request->input('element'))) {
            Log::info('Slider Image file uploaded.');
            $filePath = $this->handleFileUpload($request, 'data-slider-image');
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

        // Redirect based on the element type to different routes
        $redirectTo = '/homepage'; // Default redirect

        if (in_array($elementType, ['title', 'description', 'image'])) {
            $redirectTo = '/homepage';
        } elseif (in_array($elementType, ['vision-title', 'vision-description', 'vision-image'])) {
            $redirectTo = '/homepage/vision';
        } elseif (in_array($elementType, ['about-title', 'about-description', 'about-image'])) {
            $redirectTo = '/homepage/about';
        } elseif (Str::startsWith($elementType, 'slider-image-')) {
            $redirectTo = '/homepage/slider';
        }

        Log::info('Redirecting to ' . $redirectTo . ' with success message.');

        // Redirect to the appropriate page based on the element type
        return redirect($redirectTo)->with('success', 'HomePage element added successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $homePage = HomePage::findOrFail($id);

        // Get the element type before deletion to determine the redirection
        $elementType = $homePage->element;

        // Check if 'data' contains a path starting with 'uploads/'
        if (strpos($homePage->data, 'uploads/') === 0) {
            // Generate the full file path
            $filePath = base_path($homePage->data);

            // Check if the file exists and delete it
            if (file_exists($filePath)) {
                unlink($filePath);  // Delete the file
                Log::info('File ' . $filePath . ' deleted successfully.');
            } else {
                Log::warning('File ' . $filePath . ' not found.');
            }
        }

        // Delete the HomePage element
        $homePage->delete();

        Log::info('HomePage element deleted successfully.');

        // Redirect based on the element type to different routes
        $redirectTo = '/homepage'; // Default redirect

        if (in_array($elementType, ['title', 'description', 'image'])) {
            $redirectTo = '/homepage';
        } elseif (in_array($elementType, ['vision-title', 'vision-description', 'vision-image'])) {
            $redirectTo = '/homepage/vision';
        } elseif (in_array($elementType, ['about-title', 'about-description', 'about-image'])) {
            $redirectTo = '/homepage/about';
        } elseif ($elementType === 'slider-image') {
            $redirectTo = '/homepage/slider';
        }

        Log::info('Redirecting to ' . $redirectTo . ' with success message.');

        // Redirect to the appropriate page after deletion
        return redirect($redirectTo)->with('success', 'HomePage element deleted successfully!');
    }

}
