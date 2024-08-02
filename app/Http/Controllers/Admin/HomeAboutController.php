<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AboutUs;
use App\Models\SubAboutUs;

class HomeAboutController extends Controller
{
    public function index()
    {
        $about = AboutUs::with('features')->first();
        return view('admin.home.about.index', compact('about'));
    }

    public function edit($id)
    {
        $data = AboutUs::findOrFail($id);
        return response()->json($data);
    }

    public function editFeature($id)
    {
        $data = SubAboutUs::findOrFail($id);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title2' => 'required|string|max:255',
            'description2' => 'required|string',
        ]);

        try {
            $imageName = time() . '.' . $request->image_url->extension();
            $request->image_url->move(public_path('assets/img/'), $imageName);

            AboutUs::create([
                'title' => $request->title,
                'description' => $request->description,
                'image_url' => 'assets/img/' . $imageName,
                'title2' => $request->title2,
                'description2' => $request->description2,
            ]);

            return redirect()->route('admin.home.about')->with('success', 'About Us section created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to save about section: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title2' => 'required|string|max:255',
            'description2' => 'required|string',
        ]);

        try {
            $about = AboutUs::findOrFail($id);

            if ($request->hasFile('image_url')) {
                $imageName = time() . '.' . $request->image_url->extension();
                $request->image_url->move(public_path('assets/img/'), $imageName);
                $about->image_url = 'assets/img/' . $imageName;
            }

            $about->title = $request->title;
            $about->description = $request->description;
            $about->title2 = $request->title2;
            $about->description2 = $request->description2;
            $about->save();

            return redirect()->route('admin.home.about')->with('success', 'About Us section updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update about section: ' . $e->getMessage()]);
        }
    }

    public function updateFeature(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string|max:75',
        ]);

        try {
            $feature = SubAboutUs::findOrFail($id);

            $feature->icon = $request->icon;
            $feature->title = $request->title;
            $feature->description = $request->description;
            $feature->save();

            return redirect()->route('admin.home.about')->with('success', 'Feature About Us section updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update feature about section: ' . $e->getMessage()]);
        }
    }

    public function addFeature(Request $request, $about_us_id)
    {
        $request->validate([
            'icon' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        try {
            SubAboutUs::create([
                'about_us_id' => $about_us_id,
                'icon' => $request->icon,
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return redirect()->route('admin.home.about')->with('success', 'Feature added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to add feature: ' . $e->getMessage()]);
        }
    }

    public function destroyFeature($id)
    {
        $feature = SubAboutUs::findOrFail($id);
        $feature->delete();

        return redirect()->route('admin.home.about')->with('success', 'Feature deleted successfully.');
    }
}
