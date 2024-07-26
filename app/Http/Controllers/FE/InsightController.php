<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class InsightController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view("fe.insight.index", compact("blogs"));
    }
}
