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

        // Handle file uploads based on the selected element type
        $filePath = null;

        // Check and handle file upload for Image elements
        if ($request->hasFile('data-image') && $request->input('element') === 'image') {
            Log::info('Image file uploaded for element: Image.');
            $filePath = $this->handleFileUpload($request, 'data-image');
        } elseif ($request->hasFile('about-data-image') && $request->input('element') === 'about-image') {
            Log::info('Image file uploaded for element: about-image.');
            $filePath = $this->handleFileUpload($request, 'about-data-image');
        }

        // Retrieve the element type and format it to lowercase with hyphens
        $element = strtolower(str_replace(' ', '-', $request->input('element')));

        $data = null; // Initialize $data to avoid null value errors

        // Special handling for year-based paragraph fields
        if (in_array($element, ['2004', '2014', '2016', '2018', '2021', '2024'])) {
            // Construct the data key for the specific year
            $dataKey = 'data-paragraph-' . $element;
            $data = $filePath ?? $request->input($dataKey);
        } elseif ($element === 'about-header') {
            // Handle the case where 'about-header' corresponds to 'about-data-header'
            $data = $request->input('about-data-header');
        } elseif ($element === 'about-paragraph') {
            // Handle "about-paragraph" element
            $data = $request->input('data-paragraph');
        } else {
            // Handle general cases like Header, Paragraph, etc.
            $dataKey = 'data-' . $element;
            $data = $filePath ?? $request->input($dataKey);
        }

        // Log the resolved data
        Log::info('Resolved Element Type: ' . $request->input('element'));
        if ($data) {
            Log::info('Resolved Data: ' . $data);
        } else {
            Log::warning('No data provided for ' . $element . ' element.');
        }

        // Ensure data is not null before creating the record
        if ($data === null) {
            return back()
                ->withErrors(['data' => 'No valid data provided for the selected element.'])
                ->withInput();
        }

        // Create a new AboutUsElement record
        AboutUsElement::create([
            'element' => $request->input('element'),
            'data' => $data,
        ]);

        Log::info('AboutUsElement created successfully.');

        // Redirect to the About Us page with a success message
        return redirect('/about-us')->with('success', 'Element added successfully!');
    }

    protected function validateElement(Request $request)
    {
        // Validate based on element type
        switch ($request->input('element')) {
            case 'header':
            case 'about-header':
                $this->validateHeader($request);
                break;
            case 'about-paragraph':
                $this->validateParagraph($request);
                break;
            case 'image':
            case 'about-image':
                $this->validateImage($request);
                break;
            case '2004':
            case '2014':
            case '2016':
            case '2018':
            case '2021':
            case '2024':
                // Ensure paragraph data for specific years is provided and word count <= 250
                $this->validateYearParagraph($request);
                break;
            default:
                Log::info('No valid element selected.');
                throw new \Illuminate\Validation\ValidationException('Invalid element.');
        }
    }

    protected function validateHeader(Request $request)
    {
        // Validate the input
        $request->validate([
            'element' => 'required|string',
            // Ensure at least one of 'data-header' or 'about-data-header' is present
            'data-header' => 'nullable|string|required_without:about-data-header',
            'about-data-header' => 'nullable|string|required_without:data-header',
        ]);

        // Log the validation success
        Log::info('Validation passed for Header', [
            'element' => $request->input('element'),
            'data-header' => $request->input('data-header'),
            'about-data-header' => $request->input('about-data-header'),
        ]);
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

        // Ensure the year-specific paragraph is provided
        $request->validate([
            $yearField => 'required|string|max:65000', // Paragraph for specific year is required and max length of 65,000 characters
        ]);
        Log::info('Validation passed for Paragraph');
    }

    protected function validateImage(Request $request)
    {
        Log::info('Element: ' . $request->input('element'));

        // Check if either file is present in the request
        $file = $request->file('data-image') ?? $request->file('about-data-image');

        if ($file) {
            // Log the file metadata
            Log::info('File Name: ' . $file->getClientOriginalName());
            Log::info('File Mime Type: ' . $file->getClientMimeType());
            Log::info('File Size: ' . $file->getSize() . ' bytes');

            // Check if the file is valid
            if (!$file->isValid()) {
                Log::error('Uploaded image file is not valid.');
                return back()->withErrors([
                    'data-image' => 'The uploaded file is not valid.',
                    'about-data-image' => 'The uploaded file is not valid.',
                ]);
            }
        } else {
            Log::error('No file uploaded for Image element.');
            return back()->withErrors([
                'data-image' => 'No image file uploaded.',
                'about-data-image' => 'No image file uploaded.',
            ]);
        }

        // Validate the element and image type
        $request->validate([
            'element' => 'required|string',
            'data-image' => 'required_if:element,Image|file|mimes:jpeg,png,jpg,gif,webp,svg|max:10240', // Image size limit of 10MB
            'about-data-image' => 'required_if:element,About Image|file|mimes:jpeg,png,jpg,gif,webp,svg|max:10240', // Image size limit of 10MB
        ]);

        Log::info('Image validated successfully.');
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

        // Retrieve the element type and format it to lowercase with hyphens
        $elementType = strtolower(str_replace(' ', '-', $request->input('element')));

        // Initialize the data variable
        $data = null;

        // Handle file uploads and specific paragraph elements
        if ($elementType === 'image' && $request->hasFile('data-image')) {
            Log::info('Image file uploaded for element: image.');
            $data = $this->handleFileUpload($request, 'data-image'); // Upload file and get the path
        } elseif ($elementType === 'about-image' && $request->hasFile('about-data-image')) {
            Log::info('Image file uploaded for element: about-image.');
            $data = $this->handleFileUpload($request, 'about-data-image'); // Upload file and get the path
        } elseif (in_array($elementType, ['2004', '2014', '2016', '2018', '2021', '2024'])) {
            // Handle year-specific paragraph data
            $dataKey = 'data-paragraph-' . $elementType;
            $data = $request->input($dataKey);
            Log::info('Year-specific paragraph element: ' . $elementType . ', Data: ' . $data);
        } elseif ($elementType === 'about-paragraph') {
            // Handle "about-paragraph" element
            $data = $request->input('data-paragraph');
            Log::info('Element type: about-paragraph, Data: ' . $data);
        } else {
            // Handle other element types like Header, Paragraph, Long Text, etc.
            $dataKey = 'data-' . $elementType;
            $data = $request->input($dataKey);
            Log::info('Element type: ' . $elementType . ', Data: ' . $data);
        }

        // Update the AboutUsElement record with the new data
        $element->update([
            'element' => $request->input('element'),
            'data' => $data,
        ]);

        Log::info('AboutUsElement updated successfully.');

        // Redirect to the About Us page with a success message
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
