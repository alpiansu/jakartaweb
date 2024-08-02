<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Carousel;

class HomeCarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::all();
        return view('admin.home.carousel.index', compact('carousels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'button_text' => 'required|string',
            'button_link' => 'required|string',
        ]);

        try {
            $imageName = time() . '.' . $request->image_url->extension();
            $request->image_url->move(public_path('assets/img/'), $imageName);

            Carousel::create([
                'title' => $request->title,
                'description' => $request->description,
                'image_url' => 'assets/img/' . $imageName,
                'button_text' => $request->button_text,
                'button_link' => $request->button_link,
            ]);

            return redirect()->route('admin.home.carousel')->with('success', 'Carousel item created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan transaksi: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $carousel = Carousel::findOrFail($id);
        return response()->json($carousel);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'button_text' => 'required|string',
            'button_link' => 'required|string',
        ]);

        try {
            $carousel = Carousel::findOrFail($id);

            if ($request->hasFile('image_url')) {
                $imageName = time() . '.' . $request->image_url->extension();
                $request->image_url->move(public_path('assets/img/'), $imageName);
                $carousel->image_url = 'assets/img/' . $imageName;
            }

            $carousel->title = $request->title;
            $carousel->description = $request->description;
            $carousel->button_text = $request->button_text;
            $carousel->button_link = $request->button_link;
            $carousel->save();

            return redirect()->route('admin.home.carousel')->with('success', 'Carousel item updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan transaksi: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $carousel = Carousel::findOrFail($id);
        $carousel->delete();

        return redirect()->route('admin.home.carousel')->with('success', 'Carousel item deleted successfully.');
    }
}
