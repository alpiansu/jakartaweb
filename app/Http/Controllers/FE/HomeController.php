<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carousel;
use App\Models\AboutUs;
use App\Models\PageContent;
use App\Models\Feature;

class HomeController extends Controller
{
    public function index()
    {
        // Lokasi folder yang berisi gambar
        $directory = public_path('assets/galleries');
        // Mendapatkan semua file dalam folder
        $files = scandir($directory);
        // Filter file untuk hanya mengambil gambar (jpg, png, gif, dll.)
        $images = array_filter($files, function ($file) use ($directory) {
            $path = $directory . '/' . $file;
            return is_file($path) && preg_match('/\.(jpg|jpeg|png|gif)$/i', $file);
        });

        $about = AboutUs::with('features')->first();
        $carousels = Carousel::all();
        $features = Feature::all();
        $gallery = PageContent::where('position', 'Gallery')->first();
        $feature_text = PageContent::where('position', 'Features')->first();
        return view("fe.home.index", compact("carousels", "about", "gallery", "images", "features", "feature_text"));
    }
}
