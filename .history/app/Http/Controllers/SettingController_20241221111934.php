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
            'links' => 'required_if:media,facebook,instagram,twitter|nullable|url', // Validate the link for specific media options
            'details' => 'required_if:media,style,script|nullable|string', // Validate the details field for "style" and "script"
        ]);

        // Determine the value for the 'data' column based on the selected media type
$data = [
    'media' => $request->media,
    'data' => match ($request->media) {
        'facebook', 'instagram', 'twitter' => $request->links, // Store the link for social media platforms
        'style', 'script' => $request->details, // Store the details for style or script
        default => $request->data, // Handle other media types by storing their corresponding data
    },
];


        // Create the new setting (social media account entry) in the database
        Setting::create($data);

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
            'media' => 'required|string', // Validate the media selection
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
