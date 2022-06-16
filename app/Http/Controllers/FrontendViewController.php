<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Collections\ResellerCollection;

class FrontendViewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $project_id = $request->input('project_id');
        $user = auth()->user();
        $projects = $user->projects();
        if ($project_id == null) {
            $project = $projects->first();
            $project_id = $project->id;
        }
        //$projects = Project::where('status', true)->get();
        $collection = new ResellerCollection($project_id);

        return view('frontendviews.index', compact('projects'))
               ->with(compact('collection'))
               ->with('project_id', $project_id);
    }
}
