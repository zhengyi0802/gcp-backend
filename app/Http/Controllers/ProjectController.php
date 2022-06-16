<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Enums\Content;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suser = auth()->user();
        if ($suser->canRead(Content::Project)) {
            $projects = $suser->projects();
            //$projects = Project::where('status', true)->get();

            return view('projects.index', compact('projects'));
        }
        return redirect()->route('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $suser = auth()->user();
        $data = $request->all();
        if ($suser->canCreate(Content::Project)) {
            $data['created_by'] = $suser->id;
            $data['status']     = true;
            Project::create($data);
        }
        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $suser = auth()->user();
        if ($suser->canRead(Content::Project)) {
            return view('projects.show', compact('project'));
        }
        return redirect()->route('projects.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $suser = auth()->user();
        if ($suser->canUpdate(Content::Project)) {
            return view('projects.edit', compact('project'));
        }
        return redirect()->route('projects.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $suser = auth()->user();
        $data = $request->all();
        if ($suser->canUpdate(Content::Project)) {
            $project->update($data);
        }
        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $suser = auth()->user();
        if ($suser->canDelete(Content::Project)) {
            $project->delete();
        } else if ($suser->canDisable(Content::Project)) {
            $project->status = false;
            $project->save();
        }
        return redirect()->route('projects.index');
    }
}
