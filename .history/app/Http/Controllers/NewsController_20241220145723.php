<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('news.index', compact('news'));
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        // Log received data before validation
        Log::info('Received data for Store:', $request->all());

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'required',
            'image' => 'nullable|image|max:2048', // Image is optional
        ]);

        $imagePath = null;

        // Handle file upload if an image is provided
        if ($request->hasFile('image')) {
            // Define the custom upload path
            $uploadPath = base_path('uploads/gallery');

            // Ensure the directory exists
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true); // Create the directory if it doesn't exist
            }

            // Get the uploaded file and generate a unique name
            $file = $request->file('image');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            // Move the file to the custom upload path
            $file->move($uploadPath, $fileName);

            // Save the relative path for storing in the database
            $imagePath = 'uploads/news/' . $fileName;
        }

        // Create the news record
        News::create([
            'title' => $validated['title'],
            'details' => $validated['details'],
            'image_path' => $imagePath,
        ]);

        return redirect()->route('news.index')->with('success', 'News created successfully.');
    }

    public function show($id)
    {
        $news = News::findOrFail($id);
        return view('news.show', compact('news'));
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        // Log received data before validation
        Log::info('Received data for update:', $request->all());

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'required',
            'image' => 'nullable|image|max:2048', // Image is optional during updates
        ]);

        // Handle file upload if a new image is provided
        if ($request->hasFile('image')) {
            // Define the custom upload path
            $uploadPath = base_path('uploads/gallery');

            // Ensure the directory exists
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true); // Create the directory if it doesn't exist
            }

            // Get the uploaded file and generate a unique name
            $file = $request->file('image');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            // Delete the old file if it exists
            if ($news->image_path && file_exists(public_path($news->image_path))) {
                unlink(public_path($news->image_path));
            }

            // Move the new file to the custom upload path
            $file->move($uploadPath, $fileName);

            // Update the path in the news record
            $news->image_path = 'uploads/news/' . $fileName;
        }

        // Update other fields and save
        $news->title = $validated['title'];
        $news->details = $validated['details'];
        $news->save();

        return redirect()->route('news.index')->with('success', 'News updated successfully.');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        if ($news->image_path) {
            unlink(public_path('storage/' . $news->image_path));
            base_path('uploads/gallery');
        }
        $news->delete();

        return redirect()->route('news.index')->with('success', 'News deleted successfully!');
    }

    public function response()
    {
        // Get all Gallery records
        $news = News::all();

        // Customize the response as per your needs
        return response()->json([
            'status' => 'success',
            'data' => $news,
            'message' => 'Gallery elements retrieved successfully',
        ]);
    }
}
