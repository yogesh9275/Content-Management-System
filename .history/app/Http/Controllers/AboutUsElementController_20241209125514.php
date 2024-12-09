<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
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
        // Log the start of the request
        Log::info('Store method called. Request data:', $request->all());

        // Log the element value to check if it's being passed correctly
        Log::info('Selected element: ' . $request->input('element'));

        // Initialize an empty variable for the file path
        $filePath = null;

        // Validate the incoming request based on the selected element
        try {
            // Check the element and validate accordingly
            if ($request->input('element') === 'Header') {
                Log::info('Element is Header');
                $this->validateHeader($request);
            } elseif ($request->input('element') === 'Paragraph') {
                Log::info('Element is Paragraph');
                $this->validateParagraph($request);
            } elseif ($request->input('element') === 'Image') {
                Log::info('Element is Image');
                $this->validateImage($request); // Validate Image and break out of the block
            } elseif ($request->input('element') === 'Video') {
                Log::info('Element is Video');
                $this->validateVideo($request);
            } elseif ($request->input('element') === 'Long Text') {
                Log::info('Element is Long Text');
                $this->validateLongText($request);
            } else {
                Log::info('No valid element selected.');
            }

            // Log success of validation
            Log::info('Validation passed for ' . $request->input('element'));
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors if validation fails
            Log::error('Validation failed: ' . implode(', ', $e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }

        // Handle the file upload based on the selected element type
        if ($request->hasFile('data-image') && $request->input('element') === 'Image') {
            Log::info('Image file uploaded.');
            // Store the image in the public/uploads directory
            $filePath = $request->file('data-image')->store('uploads', 'public');
            Log::info('Image uploaded. File path: ' . $filePath);
        } elseif ($request->hasFile('data-video') && $request->input('element') === 'Video') {
            Log::info('Video file uploaded.');
            // Store the video in the public/uploads directory
            $filePath = $request->file('data-video')->store('uploads', 'public');
            Log::info('Video uploaded. File path: ' . $filePath);
        } else {
            Log::info('No file uploaded.');
        }

        // Log the element type and associated data
        Log::info('Element type: ' . $request->input('element'));
        Log::info('Data (text or file path): ' . ($filePath ?: $request->input('data-' . strtolower(str_replace(' ', '-', $request->input('element'))))));

        // Create a new AboutUsElement record with the appropriate data
        AboutUsElement::create([
            'element' => $request->input('element'),
            'data' => $filePath ?? $request->input('data-' . strtolower(str_replace(' ', '-', $request->input('element')))), // If a file is uploaded, store the path; otherwise, store the text data
        ]);
        Log::info('AboutUsElement created successfully.');

        // Redirect to the About Us page with a success message
        Log::info('Redirecting to /about-us with success message.');
        return redirect('/about-us')->with('success', 'Element added successfully!');
    }

    protected function validateHeader(Request $request)
    {
        $request->validate([
            'element' => 'required|string',
            'data-header' => 'required|string', // Header requires a text input
        ]);
        // Log success for validation
        Log::info('Validation passed for Header');
    }

    protected function validateParagraph(Request $request)
    {
        $request->validate([
            'element' => 'required|string',
            'data-paragraph' => 'required|string', // Paragraph requires text
        ]);
        // Log success for validation
        Log::info('Validation passed for Paragraph');
    }

    protected function validateImage(Request $request)
    {
        $request->validate([
            'element' => 'required|string',
            'data-image' => 'required_if:element,Image|file|mimes:jpeg,png,jpg,gif,webp,svg', // Image validation only if element is Image
        ]);
        // Log success for validation
        Log::info('Image validated, skipping other validations.');
    }

    protected function validateVideo(Request $request)
    {
        $request->validate([
            'element' => 'required|string',
            'data-video' => 'required|file|mimes:mp4,avi,mkv,webm|max:10240', // Video validation
        ]);
        // Log success for validation
        Log::info('Validation passed for Video');
    }

    protected function validateLongText(Request $request)
    {
        $request->validate([
            'element' => 'required|string',
            'data-long-text' => 'required|string', // Long Text requires a text input
        ]);
        // Log success for validation
        Log::info('Validation passed for Long Text');
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
    public function edit($id)
    {
        $element = AboutUsElement::findOrFail($id);
        return view('about-us.edit', compact('element'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'element' => 'required|string',
            'data' => 'required|string',
        ]);

        $element = AboutUsElement::findOrFail($id);
        $element->update($request->all());

        return redirect('/about-us')->with('success', 'Element updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $element = AboutUsElement::findOrFail($id);
        $element->delete();

        return redirect('/about-us')->with('success', 'Element deleted successfully!');
    }

    public function response()
    {
        // Get all AboutUsElement records
        $elements = AboutUsElement::all();

        // Loop through each element to check if it is "Long Text"
        foreach ($elements as $element) {
            // Check if the element type is "Long Text"
            if ($element->element == 'Long Text') {
                // Wrap each paragraph in <p></p> tags
                $paragraphs = explode("\n", $element->data); // Split the data into paragraphs by new lines
                $wrappedParagraphs = array_map(function ($paragraph) {
                    return '<p>' . e($paragraph) . '</p>'; // Wrap each paragraph in <p></p> and escape HTML characters
                }, $paragraphs);

                // Join the wrapped paragraphs back into a single string
                $element->data = implode("\n", $wrappedParagraphs);
            }
        }

        // Customize the response as per your needs
        // Example: Return custom data with a status
        return response()->json([
            'status' => 'success',
            'data' => $elements,
            'message' => 'About Us elements retrieved successfully',
        ]);
    }
}
