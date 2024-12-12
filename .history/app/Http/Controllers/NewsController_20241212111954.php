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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'details' => 'required|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/news', 'public');
        }

        News::create([
            'title' => $validated['title'],
            'image_path' => $imagePath,
            'details' => $validated['details'],
        ]);

        return redirect()->route('news.index')->with('success', 'News created successfully!');
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

