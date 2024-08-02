<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Exception;

class AdminWorkController extends Controller
{
    public function index()
    {
        try {
            $projects = Project::all();
            $projectTypes = Project::select('project_type')->distinct()->get();
            $sectors = Project::select('sector')->distinct()->get();
            return view('admin.work.index', compact('projects', 'projectTypes', 'sectors'));
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'project_type' => 'required|string|max:255',
            'sector' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $projectType = $request->project_type === 'new' ? $request->new_project_type : $request->project_type;
        $sector = $request->sector === 'new' ? $request->new_sector : $request->sector;

        try {
            $project = new Project();
            $project->title = $request->title;
            $project->description = $request->description;
            $project->project_type = $projectType;
            $project->sector = $sector;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('assets/img/work'), $imageName);
                $project->image_path = $imageName;
            }

            $project->save();

            return back()->with('success', 'Project added successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to add project: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'project_type' => 'required|string|max:255',
            'sector' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $projectType = $request->project_type === 'new' ? $request->new_project_type : $request->project_type;
        $sector = $request->sector === 'new' ? $request->new_sector : $request->sector;

        try {
            $project = Project::findOrFail($id);
            $project->title = $request->title;
            $project->description = $request->description;
            $project->project_type = $projectType;
            $project->sector = $sector;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('assets/img/work'), $imageName);
                $project->image_path = $imageName;
            }

            $project->save();

            return back()->with('success', 'Project updated successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to update project: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $project = Project::findOrFail($id);
            $project->delete();
            return back()->with('success', 'Project deleted successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to delete project: ' . $e->getMessage());
        }
    }
}
