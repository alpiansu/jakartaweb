<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MainConfig;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\File;

class AdminConfigController extends Controller
{
    public function index()
    {
        try {
            $config = MainConfig::first();
            $socialMedias = SocialMedia::all();
            return view('admin.config.index', compact('config', 'socialMedias'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'favicon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'footer_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'footer_text' => 'required|string',
            ]);

            $config = MainConfig::first();
            if (!$config) {
                $config = new MainConfig();
            }

            // Handle logo upload
            if ($request->hasFile('logo')) {
                if ($config->logo && File::exists(public_path('assets/img/' . $config->logo))) {
                    File::delete(public_path('assets/img/' . $config->logo));
                }
                $logo = time() . '_logo.' . $request->logo->extension();
                $request->logo->move(public_path('assets/img'), $logo);
                $config->logo = $logo;
            }

            // Handle favicon upload
            if ($request->hasFile('favicon')) {
                if ($config->favicon && File::exists(public_path('assets/img/' . $config->favicon))) {
                    File::delete(public_path('assets/img/' . $config->favicon));
                }
                $favicon = time() . '_favicon.' . $request->favicon->extension();
                $request->favicon->move(public_path('assets/img'), $favicon);
                $config->favicon = $favicon;
            }

            // Handle footer logo upload
            if ($request->hasFile('footer_logo')) {
                if ($config->footer_logo && File::exists(public_path('assets/img/' . $config->footer_logo))) {
                    File::delete(public_path('assets/img/' . $config->footer_logo));
                }
                $footerLogo = time() . '_footer_logo.' . $request->footer_logo->extension();
                $request->footer_logo->move(public_path('assets/img'), $footerLogo);
                $config->footer_logo = $footerLogo;
            }

            $config->footer_text = $request->footer_text;
            $config->save();

            return redirect()->route('admin.config.index')->with('success', 'Configuration updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the configuration: ' . $e->getMessage()]);
        }
    }

    public function storeSocialMedia(Request $request)
    {
        try {
            $request->validate([
                'icon' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'link' => 'required|string|max:255',
            ]);

            $socialMedia = new SocialMedia();
            $socialMedia->icon = $request->icon; // Menggunakan input teks
            $socialMedia->name = $request->name;
            $socialMedia->link = $request->link;
            $socialMedia->save();

            return redirect()->route('admin.config.index')->with('success', 'Social Media added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while adding the social media: ' . $e->getMessage()]);
        }
    }

    public function updateSocialMedia(Request $request, $id)
    {
        try {
            $request->validate([
                'icon' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'link' => 'required|string|max:255',
            ]);

            $socialMedia = SocialMedia::findOrFail($id);
            $socialMedia->icon = $request->icon; // Menggunakan input teks
            $socialMedia->name = $request->name;
            $socialMedia->link = $request->link;
            $socialMedia->save();

            return redirect()->route('admin.config.index')->with('success', 'Social Media updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the social media: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $socialMedia = SocialMedia::findOrFail($id);
            if ($socialMedia->icon && File::exists(public_path('assets/img/' . $socialMedia->icon))) {
                File::delete(public_path('assets/img/' . $socialMedia->icon));
            }
            $socialMedia->delete();

            return redirect()->route('admin.config.index')->with('success', 'Social Media deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while deleting the social media: ' . $e->getMessage()]);
        }
    }
}
