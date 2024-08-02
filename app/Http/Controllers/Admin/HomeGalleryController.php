<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageContent;

class HomeGalleryController extends Controller
{
    public function index()
    {
        $gallery = PageContent::where('position', 'Gallery')->first();
        $directory = public_path('assets/galleries');
        $files = scandir($directory);
        $images = array_filter($files, function ($file) use ($directory) {
            $path = $directory . '/' . $file;
            return is_file($path) && preg_match('/\.(jpg|jpeg|png|gif)$/i', $file);
        });

        return view('admin.home.gallery.index', compact('gallery', 'images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/galleries'), $filename);

            return redirect()->route('admin.home.gallery')->with('success', 'Image uploaded successfully');
        }

        return redirect()->route('admin.home.gallery')->with('error', 'Failed to upload image');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $gallery = PageContent::findOrFail($id);
        $gallery->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.home.gallery')->with('success', 'Gallery content updated successfully');
    }

    public function destroy($filename)
    {
        $path = public_path('assets/galleries/' . $filename);
        if (file_exists($path)) {
            unlink($path);
            return redirect()->route('admin.home.gallery')->with('success', 'Image deleted successfully');
        }

        return redirect()->route('admin.home.gallery')->with('error', 'Image not found');
    }
}
