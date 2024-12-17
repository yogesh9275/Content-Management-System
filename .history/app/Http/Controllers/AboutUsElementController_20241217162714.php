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

        // Check and handle file upload for Image (removed video handling)
        if ($request->hasFile('data-image') && $request->input('element') === 'Image') {
            Log::info('Image file uploaded.');
            $filePath = $this->handleFileUpload($request, 'data-image');
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

    // Validation for Year-specific Paragraph
    protected function validateYearParagraph(Request $request)
    {
        // Dynamic rule generation for years 2004, 2014, etc.
        $yearField = 'data-paragraph-' . $request->input('element');
        $this->validateWordCount($request->input($yearField), 250);

        // Ensure the year-specific paragraph is provided
        $request->validate([
            $yearField => 'required|string|max:65000', // Paragraph for specific year is required and max length of 65,000 characters
        ]);
    }

    protected function validateImage(Request $request)
    {
        Log::info('Element: ' . $request->input('element'));

        // Check if the file is present in the request
        if ($request->hasFile('data-image')) {
            $file = $request->file('data-image');

            // Log the file metadata
            Log::info('File Name: ' . $file->getClientOriginalName());
            Log::info('File Mime Type: ' . $file->getClientMimeType());
            Log::info('File Size: ' . $file->getSize() . ' bytes');

            // Check if the file is valid
            if (!$file->isValid()) {
                Log::error('Uploaded image file is not valid.');
                return back()->withErrors(['data-image' => 'The uploaded file is not valid.']);
            }
        } else {
            Log::error('No file uploaded for Image element.');
            return back()->withErrors(['data-image' => 'No image file uploaded.']);
        }

        // Validate the element and image type
        $request->validate([
            'element' => 'required|string',
            'data-image' => 'required_if:element,Image|file|mimes:jpeg,png,jpg,gif,webp,svg|max:10240', // Adding size limit (10MB)
        ]);

        Log::info('Image validated successfully.');
    }

    protected function validateLongText(Request $request)
    {
        $request->validate([
            'element' => 'required|string',
            'data-long-text' => 'required', // Accepts strings, HTML, and other text content
        ]);
        Log::info('Validation passed for Long Text');
    }

    protected function handleFileUpload(Request $request, $fileInputName)
    {
        // Get the file from the request
        $file = $request->file($fileInputName);

        // Check if the file is valid
        if ($file && $file->isValid()) {
            // Define the destination path where the file will be stored
            $destinationPath = public_path('uploads');

            // Ensure the uploads directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true); // Create directory if not exists
            }

            // Generate a unique filename based on the original file name
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            // Move the file to the uploads directory
            $file->move($destinationPath, $fileName);

            // Generate the relative file path for the database
            $filePath = 'uploads/' . $fileName;

            // Log the file upload information
            Log::info('File uploaded. File path: ' . $filePath);

            return $filePath;
        }

        // If no valid file was uploaded, log and return null
        Log::error('No valid file uploaded.');
        return null;
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
        // Log the start of the request
        Log::info('Update method called. Request data:', $request->all());

        // Validate the incoming request based on the selected element
        $this->validateElement($request);

        // Find the existing element to be updated
        $element = AboutUsElement::findOrFail($id);

        // Handle the file upload based on the selected element type
        $filePath = null;

        // Check and handle file upload for Image (removed video handling)
        if ($request->hasFile('data-image') && $request->input('element') === 'Image') {
            Log::info('Image file uploaded.');
            $filePath = $this->handleFileUpload($request, 'data-image');
        }

        // Log the element type and associated data
        $data = $filePath ?? $request->input('data-' . strtolower(str_replace(' ', '-', $request->input('element'))));
        Log::info('Element type: ' . $request->input('element'));
        Log::info('Data (text or file path): ' . $data);

        // Update the AboutUsElement record with the new data (image or text)
        $element->update([
            'element' => $request->input('element'),
            'data' => $data,
        ]);
        Log::info('AboutUsElement updated successfully.');

        // Redirect to the About Us page with a success message
        Log::info('Redirecting to /about-us with success message.');
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
        return response()->json([
            'status' => 'success',
            'data' => $elements,
            'message' => 'About Us elements retrieved successfully',
        ]);
    }
}
