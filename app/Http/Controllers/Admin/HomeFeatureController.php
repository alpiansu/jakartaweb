<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PageContent;
use App\Models\Feature;
use Illuminate\Support\Facades\DB;

class HomeFeatureController extends Controller
{
    public function index()
    {
        try {
            $features = Feature::all();
            $feature_text = PageContent::where('position', 'Features')->first();
            return view('admin.home.feature.index', compact('features', 'feature_text'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $feature = new Feature();
            $feature->title = $request->title;
            $feature->description = $request->description;
            $feature->link_url = $request->link_url;
            $feature->link_text = $request->link_text;
            $feature->save();

            DB::commit();
            return redirect()->route('admin.home.feature')->with('success', 'Fitur berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $feature = Feature::findOrFail($id);
            $feature->title = $request->title;
            $feature->description = $request->description;
            $feature->link_url = $request->link_url;
            $feature->link_text = $request->link_text;
            $feature->save();

            DB::commit();
            return redirect()->route('admin.home.feature')->with('success', 'Fitur berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $feature = Feature::findOrFail($id);
            $feature->delete();

            DB::commit();
            return redirect()->route('admin.home.feature')->with('success', 'Fitur berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateFeatureText(Request $request)
    {
        try {
            DB::beginTransaction();

            $feature_text = PageContent::where('position', 'Features')->first();
            if (!$feature_text) {
                $feature_text = new PageContent();
                $feature_text->position = 'Features';
            }
            $feature_text->title = $request->title;
            $feature_text->content = $request->content;
            $feature_text->save();

            DB::commit();
            return redirect()->route('admin.home.feature')->with('success', 'Teks fitur berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
