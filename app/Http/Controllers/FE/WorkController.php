<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\PageContent;

class WorkController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        $projectTypes = Project::select('project_type')->distinct()->get();
        $sectors = Project::select('sector')->distinct()->get();
        $work_text = PageContent::where('page_id', 3)->first();
        return view("fe.work.index", compact("projects", "projectTypes", "sectors", "work_text"));
    }

    public function filterProjects(Request $request)
    {
        $projectType = $request->get('project_type');
        $sector = $request->get('sector');

        $query = Project::query();

        if ($projectType) {
            $query->where('project_type', $projectType);
        }

        if ($sector) {
            $query->where('sector', $sector);
        }

        $projects = $query->get();

        return response()->json($projects);
    }
}
