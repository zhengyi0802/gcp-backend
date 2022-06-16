<?php

namespace App\Http\Controllers;

use App\Models\AppMenu;
use App\Models\ApkCatagory;
use App\Models\ApkProgram;
use App\Models\Project;
use App\Models\User;
use App\Enums\Content;
use App\Enums\UserRole;
use App\Enums\Permission;
use Illuminate\Http\Request;

class AppMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        if ($user->canRead(Content::AppMenu)) {
            $project_id = $request->input('project');
            if ($project_id == null) {
                $projects = $user->projects();
                $project_id = $projects->first()->id;
            } else {
                $projects = Project::where('id', $project_id)->get();
            }
            $apks = ApkProgram::where('status', true)->get();

            $app_menus = AppMenu::where('project_id', $project_id)
                                ->orderBy('position', 'ASC')
                                ->get();
            $appmenus = null;
            if ($app_menus->count() > 0) {
                $appmenus = array();
                foreach($app_menus as $appmenu) {
                   $appmenus[$appmenu->position] = $appmenu;
                }
            }

            return view('appmenus.index', compact('appmenus'))
                   ->with(compact('apks'))
                   ->with(compact('projects'));
        }
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = auth()->user();
        if ($user->canCreate(Content::AppMenu)) {
            $position = $request->input("position");
            $project_id = $request->input("project_id");
            $catagory_id = $request->input('catagory_id');
            $catagories = ApkCatagory::where('status', true)->get();
            if ($catagory_id == null) {
                $apks = ApkProgram::where('status', true)->get();
                $catagory_id = 0;
            } else {
                $apks = ApkProgram::where('catagory_id', $catagory_id)
                                  ->where('status', true)
                                  ->get();
            }

            return view('appmenus.create', compact('apks'))
                   ->with(compact('catagories'))
                   ->with('project_id', $project_id)
                   ->with('position', $position)
                   ->with('catagory_id', $catagory_id);
        }
        return redirect()->route('appmenus.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user->canCreate(Content::AppMenu)) {
            $data = $request->all();
            $data['status'] = true;
            $data['created_by'] = $user->id;
            AppMenu::create($data);
            echo "<script>window.top.location='".env('APP_URL')."/appmenus';</script>";
        } else {
            return redirect()->route('appmenus.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppMenu  $appMenu
     * @return \Illuminate\Http\Response
     */
    public function show(AppMenu $appmenu)
    {
        $user = auth()->user();
        if ($user->canRead(Content::AppMenu)) {
            $project_id =$appmenu->project_id;
            $app_menus = AppMenu::where('project_id', $project_id)
                                ->orderBy('position', 'ASC')
                                ->get();
            $appmenus = array();
            if ($app_menus->count() > 0) {
                foreach ($app_menus as $app_menu) {
                    $position = $app_menu->position;
                    $appmenus[$position] = $app_menu;
                }
            }
            return view('appmenus.show', compact('appmenus'));
        }
        return redirect()->route('appmenus.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppMenu  $appMenu
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, AppMenu $appmenu)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::AppMenu)) {
            $catagory_id = $request->input('catagory_id');
            if ($catagory_id == nuLL) {
                $catagory_id = $appmenu->apk->catagory_id;
            }
            $projects = Project::where('status', true)->get();
            $apks = ApkProgram::where('catagory_id', $catagory_id)->where('status', true)->get();
            $catagories = ApkCatagory::where('status', true)->get();

            return view('appmenus.edit', compact('appmenu'))
                   ->with(compact('catagories'))
                   ->with(compact('apks'))
                   ->with(compact('projects'))
                   ->with('catagory_id', $catagory_id);
        }
        return redirect()->route('appmenus.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppMenu  $appMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppMenu $appmenu)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::AppMenu)) {
            $data = $request->all();
            $appmenu->update($data);
            echo "<script>window.top.location='".env('APP_URL')."/appmenus';</script>";
        } else {
            return redirect()->route('appmenus.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppMenu  $appMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppMenu $appmenu)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::AppMenu)) {
            $appmenu->delete();
        } else if ($user->canDisable(Content::AppMenu)) {
            $appmenu->status = false;
            $appmenu->save();
        }
        return redirect()->route('appmenus.index');
    }
}
