<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('category')->paginate(8) ;
        
        return view('dashboard.projects.index',compact('projects')) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories= Category::all() ;
        return view('dashboard.projects.create',compact('categories')) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        Project::create($request->all()) ;

        return redirect()->route('dashboard.projects.index')->with('success','Project Created Successfully') ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('dashboard.projects.show',compact('project')) ;

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $categories= Category::all() ;
        return view('dashboard.projects.edit',compact('project','categories')) ;

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->all()) ;

        return redirect()->route('dashboard.projects.index')->with('success','Project Updated Successfully') ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete() ;
        return redirect()->route('dashboard.projects.index')->with('success','Project Deleted Successfully') ;

    }

    public function showTrash()
    {
        $projects = Project::onlyTrashed()->paginate();

        return view('dashboard.projects.trash', compact('projects'));
    }

    public function restoreTrash($project)
    {
        $project = Project::onlyTrashed()->findOrFail($project);
        $project->restore();
        return redirect()->route('dashboard.projects.trash')->with('success', 'category restored');
    }


    public function deleteTrash($project)
    {
        $project = Project::onlyTrashed()->findOrFail($project);

 
        $project->forceDelete();

        return redirect()->route('dashboard.projects.trash')->with('success', 'category Deleted');
    }
}
