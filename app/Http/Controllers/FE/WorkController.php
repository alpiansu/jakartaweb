<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class WorkController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view("fe.work.index", compact("projects"));
    }
}
