<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use Illuminate\Support\Facades\Log;

class PresensiController extends Controller
{
    // Show the form view
    public function showForm()
    {
        Log::info('Displaying the presence form.');
        return view('welcome'); // Ensure this matches the view name for your form
    }

    public function submitForm(Request $request)
    {
        Log::info('Received form submission:', $request->all());

        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'timestamp' => 'required|date_format:Y-m-d H:i:s',
            'jenis' => 'required|string',
            'lokasi' => 'required|string',
            'kamera' => 'required|string',
        ], [
            // Custom error messages
            'name.required' => 'Nama is required.',
            'nim.required' => 'NIM is required.',
            'timestamp.required' => 'Timestamp is required.',
            'jenis.required' => 'Jenis Absen is required.',
            'lokasi.required' => 'Lokasi is required.',
            'kamera.required' => 'Kamera input is required.',
        ]);

        // Log validation success
        Log::info('Validation passed for all inputs.');

        try {
            // Decode base64 image and save it
            $imageData = $request->input('kamera');
            $fileName = 'presence_' . time() . '.png';
            $imagePath = storage_path('app/public/' . $fileName);

            Log::info('Saving captured image at path: ' . $imagePath);

            // Remove base64 headers
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);

            // Save the image
            file_put_contents($imagePath, base64_decode($imageData));

            // Log image save success
            Log::info('Image saved successfully as ' . $fileName);

            // Save other data in the database
            Presensi::create([
                'name' => $request->input('name'),
                'nim' => $request->input('nim'),
                'timestamp' => $request->input('timestamp'),
                'jenis' => $request->input('jenis'),
                'lokasi' => $request->input('lokasi'),
                'kamera' => $fileName, // Store the image filename in the database
            ]);

            Log::info('Form data saved successfully in the database.');

            // Redirect back with success message
            return redirect()->back()->with('success', 'Presensi berhasil disimpan!');

        } catch (\Exception $e) {
            // Log any exceptions
            Log::error('An error occurred while saving form data: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to save the form data. Please try again.']);
        }
    }

    public function storetype(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    \App\Models\AttendanceType::create([
        'name' => $request->name,
    ]);

    return redirect()->back()->with('success', 'Kegiatan added successfully!');
}

}
