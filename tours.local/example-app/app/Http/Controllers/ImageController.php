<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function showUploadForm()
    {
        $images = Image::all(); // To display all images
        return view('images.upload', compact('images'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'imageable_id' => 'required|integer',
            'imageable_type' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');

            $image = new Image();
            $image->url = 'storage/' . $path;
            $image->imageable_id = $request->imageable_id;
            $image->imageable_type = $request->imageable_type;
            $image->save();

            return redirect()->back()->with('success', 'Image uploaded successfully!')->with('image_url', asset($image->url));
        }

        return redirect()->back()->withErrors(['image' => 'No image uploaded.']);
    }

    public function delete($id)
    {
        $image = Image::findOrFail($id);

        // Delete file from storage if it exists
        $filePath = str_replace('storage/', '', $image->url);
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        // Delete from database
        $image->delete();

        return redirect()->back()->with('success', 'Image deleted successfully!');
    }
}
