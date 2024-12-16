<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::all();
        return view('settings.index', compact('settings')); // Adjust view as needed
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('settings.create'); // Adjust view as needed
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'media' => 'required|string', // Validate the media selection
            'links' => 'required|url', // Validate the link is a valid URL
        ]);

        // Create the new setting (social media account entry) in the database
        Setting::create([
            'media' => $request->media, // Media field (Facebook, Instagram, Twitter, Threads)
            'links' => $request->links, // Social media link
        ]);

        // Redirect to the settings index page with a success message
        return redirect()->route('settings.index')->with('success', 'Social media account added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $setting = Setting::findOrFail($id);
    return view('settings.edit', compact('setting')); // Adjust view as needed
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'links' => 'required|string',
        ]);

        $setting = Setting::findOrFail($id);
        $setting->update($request->all());

        return redirect()->route('settings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id)
    // {
    //     Setting::destroy($id);

    //     return redirect()->route('settings.index');
    // }
}
