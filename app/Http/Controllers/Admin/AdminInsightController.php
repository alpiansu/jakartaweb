<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminInsightController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.insight.index', compact('blogs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'required|string',
        ]);

        try {
            $blog = new Blog();
            $blog->title = $request->title;
            $blog->description = $request->description;
            $blog->link = $request->link;

            if ($request->hasFile('image_path')) {
                $imageName = time() . '.' . $request->image_path->extension();
                $request->image_path->move(public_path('assets/img/insights/'), $imageName);
                $blog->image_path = $imageName;
            }

            $blog->save();
            return redirect()->route('admin.insight.index')->with('success', 'Insight added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to add insight: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'required|string',
        ]);

        try {
            $blog = Blog::findOrFail($id);
            $blog->title = $request->title;
            $blog->description = $request->description;
            $blog->link = $request->link;

            if ($request->hasFile('image_path')) {
                // Delete old image if exists
                if ($blog->image_path && file_exists(public_path('assets/img/insights/' . $blog->image_path))) {
                    unlink(public_path('assets/img/insights/' . $blog->image_path));
                }
                $imageName = time() . '.' . $request->image_path->extension();
                $request->image_path->move(public_path('assets/img/insights/'), $imageName);
                $blog->image_path = $imageName;
            }

            $blog->save();
            return redirect()->route('admin.insight.index')->with('success', 'Insight updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update insight: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $blog = Blog::findOrFail($id);

            // Delete image if exists
            if ($blog->image_path && file_exists(public_path('assets/img/insights/' . $blog->image_path))) {
                unlink(public_path('assets/img/insights/' . $blog->image_path));
            }

            $blog->delete();
            return redirect()->route('admin.insight.index')->with('success', 'Insight deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to delete insight: ' . $e->getMessage()]);
        }
    }
}
