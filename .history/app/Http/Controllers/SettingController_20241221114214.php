<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Support\Facades\Log;
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
    use Illuminate\Support\Facades\Log;

public function update(Request $request, $id)
{
    // Log the request data
    Log::info('Starting update process.', [
        'id' => $id,
        'request_data' => $request->all(),
    ]);

    // Validate the incoming request
    $validatedData = $request->validate([
        'media' => 'required|string', // Validate the media selection
        'links' => 'required_if:media,facebook,instagram,twitter|nullable|url', // Validate the link for specific media options
        'details' => 'required_if:media,style,script|nullable|string', // Validate the details field for "style" and "script"
    ]);

    Log::info('Validation successful.', ['validated_data' => $validatedData]);

    // Find the existing setting record by ID
    $setting = Setting::findOrFail($id);
    Log::info('Record retrieved successfully.', ['setting' => $setting]);

    // Determine the value for the 'data' column based on the selected media type
    $data = [
        'media' => $request->media,
        'data' => match ($request->media) {
            'facebook', 'instagram', 'twitter' => $request->links, // Store the link for social media platforms
            'style', 'script' => $request->details, // Store the details for style or script
            default => $request->data, // Handle other media types by storing their corresponding data
        },
    ];

    Log::info('Data prepared for update.', ['update_data' => $data]);

    // Update the setting record in the database
    $setting->update($data);

    Log::info('Record updated successfully.', ['updated_record' => $setting]);

    // Redirect to the settings index page with a success message
    $message = 'Social media account updated successfully!';
    Log::info($message);

    return redirect()->route('settings.index')->with('success', $message);
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