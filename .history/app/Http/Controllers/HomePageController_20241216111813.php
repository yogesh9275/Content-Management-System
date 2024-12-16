<?php

namespace App\Http\Controllers;

use App\Models\HomePage;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    // Display a listing of the Home page elements
    public function index()
    {
        $homePages = HomePage::all();
        return view('home.index', compact('homePages'));
    }

    // Show the form for creating a new Home page element
    public function create()
    {
        return view('home.create');
    }

    // Store a new Home page element
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Store image
        $imagePath = $request->file('image')->store('uploads/home', 'public');

        HomePage::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image_path' => $imagePath,
        ]);

        return redirect()->route('home.index')->with('success', 'Home page element created successfully.');
    }

    // Show the form for editing the specified Home page element
    public function edit(HomePage $homePage)
    {
        return view('home.edit', compact('homePage'));
    }

    // Update the specified Home page element
    public function update(Request $request, HomePage $homePage)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update image if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/home', 'public');
            $homePage->image_path = $imagePath;
        }

        $homePage->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('home.index')->with('success', 'Home page element updated successfully.');
    }

    // Remove the specified Home page element
    public function destroy(HomePage $homePage)
    {
        $homePage->delete();
        return redirect()->route('home.index')->with('success', 'Home page element deleted successfully.');
    }
}
