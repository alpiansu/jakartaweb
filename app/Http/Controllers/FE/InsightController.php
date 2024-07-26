<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\PageContent;

class InsightController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        $insight_text = PageContent::where('page_id', '4')->first();
        return view("fe.insight.index", compact("blogs", "insight_text"));
    }
}
