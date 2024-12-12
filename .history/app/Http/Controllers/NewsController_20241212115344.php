<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

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
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'details' => 'required|string',
        'image' => 'nullable|image|max:2048', // Image is optional
    ]);

    $imagePath = null;

    // Handle file upload if an image is provided
    if ($request->hasFile('image')) {
        // Define the custom upload path
        $uploadPath = public_path('uploads/news');

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

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'details' => 'required|string',
        ]);

        $news = News::findOrFail($id);

        $imagePath = $news->image_path;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/news', 'public');
        }

        $news->update([
            'title' => $validated['title'],
            'image_path' => $imagePath,
            'details' => $validated['details'],
        ]);

        return redirect()->route('news.index')->with('success', 'News updated successfully!');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        if ($news->image_path) {
            unlink(public_path('storage/' . $news->image_path));
        }
        $news->delete();

        return redirect()->route('news.index')->with('success', 'News deleted successfully!');
    }
}

