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

        // Validate the incoming request based on the selected element
        $this->validateElement($request);

        // Handle the file upload based on the selected element type
        $filePath = null;

        // Check and handle file upload for Image and Video
        if ($request->hasFile('data-image') && $request->input('element') === 'Image') {
            Log::info('Image file uploaded.');
            $filePath = $this->handleFileUpload($request, 'data-image');
        } elseif ($request->hasFile('data-video') && $request->input('element') === 'Video') {
            Log::info('Video file uploaded.');
            $filePath = $this->handleFileUpload($request, 'data-video');
        }

        // Log the element type and associated data
        $data = $filePath ?? $request->input('data-' . strtolower(str_replace(' ', '-', $request->input('element'))));
        Log::info('Element type: ' . $request->input('element'));
        Log::info('Data (text or file path): ' . $data);

        // Create a new AboutUsElement record with the appropriate data
        AboutUsElement::create([
            'element' => $request->input('element'),
            'data' => $data,
        ]);
        Log::info('AboutUsElement created successfully.');

        // Redirect to the About Us page with a success message
        Log::info('Redirecting to /about-us with success message.');
        return redirect('/about-us')->with('success', 'Element added successfully!');
    }

    protected function validateElement(Request $request)
    {
        // Validate based on element type
        switch ($request->input('element')) {
            case 'Header':
                $this->validateHeader($request);
                break;
            case 'Paragraph':
                $this->validateParagraph($request);
                break;
            case 'Image':
                $this->validateImage($request);
                break;
            case 'Video':
                $this->validateVideo($request);
                break;
            case 'Long Text':
                $this->validateLongText($request);
                break;
            default:
                Log::info('No valid element selected.');
                throw new \Illuminate\Validation\ValidationException('Invalid element.');
        }
    }

    protected function validateHeader(Request $request)
    {
        $request->validate([
            'element' => 'required|string',
            'data-header' => 'required|string',
        ]);
        Log::info('Validation passed for Header');
    }

    protected function validateParagraph(Request $request)
    {
        $request->validate([
            'element' => 'required|string',
            'data-paragraph' => 'required|string',
        ]);
        Log::info('Validation passed for Paragraph');
    }

    protected function validateImage(Request $request)
    {
        Log::info('Element: ' . $request->input('element'));
        Log::info('Data Image: ' . $request->input('data-image'));

        $request->validate([
            'element' => 'required|string',
            'data-image' => 'required_if:element,Image|file|mimes:jpeg,png,jpg,gif,webp,svg',
        ]);
        Log::info('Image validated, skipping other validations.');
    }

    protected function validateVideo(Request $request)
    {
        $request->validate([
            'element' => 'required|string',
            'data-video' => 'required|file|mimes:mp4,avi,mkv,webm|max:10240',
        ]);
        Log::info('Validation passed for Video');
    }

    protected function validateLongText(Request $request)
    {
        $request->validate([
            'element' => 'required|string',
            'data-long-text' => 'required|string',
        ]);
        Log::info('Validation passed for Long Text');
    }

    protected function handleFileUpload(Request $request, $fileInputName)
    {
        // Store the file in the public/uploads directory
        $filePath = $request->file($fileInputName)->store('uploads', 'public');
        Log::info('File uploaded. File path: ' . $filePath);
        return $filePath;
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
