<?php

namespace App\Http\Controllers;

use App\Models\AppManager;
use App\Models\Project;
use App\Models\ApkProgram;
use App\Models\User;
use App\Enums\Content;
use App\Enums\Permission;
use App\Enums\UserRole;
use Illuminate\Http\Request;

class AppManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->canRead(Content::AppMarket)) {
            $catagory_id = 6;
            $projects = $user->projects();
            $apks = ApkProgram::where('catagory_id', $catagory_id)->where('status', true)->get();
            $appmanagers = AppManager::where('status', true)->get();

            return view('appmanagers.index', compact('appmanagers'))
                   ->with(compact('projects'))
                   ->with(compact('apks'));
        }
        return view('home');
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
        $user = auth()->user();
        if ($user->canCreate(Content::AppMarket)) {
            $data = $request->all();
            $data['status'] = true;
            $data['created_by'] = $user->id;
            if (isset($data['market_id'])) $data['market_id'] = true;
            if (isset($data['installer_flag'])) $data['installer_flag'] = true;
            AppManager::create($data);
        }
        return redirect()->route('appmanagers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppManager  $appManager
     * @return \Illuminate\Http\Response
     */
    public function show(AppManager $appmanager)
    {
        $user = auth()->user();
        if ($user->canRead(Content::AppMarket)) {
            return view('appmanagers.show', compact('appmanager'));
        }
        return redirect()->route('appmanagers.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppManager  $appManager
     * @return \Illuminate\Http\Response
     */
    public function edit(AppManager $appmanager)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::AppMarket)) {
            $projects = Project::where('status', true)->get();
            $apks = ApkProgram::where('status', true)->get();

            return view('appmanagers.edit', compact('appmanager'))
                   ->with(compact('projects'))
                   ->with(compact('apks'));
        }
        return redirect()->route('appmanagers.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppManager  $appManager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppManager $appmanager)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::AppMarket)) {
            $data = $request->all();
            if (isset($data['market_id'])) $data['market_id'] = true;
            if (isset($data['installer_flag'])) $data['installer_flag'] = true;
            $appmanager->update($data);
        }
        return redirect()->route('appmanagers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppManager  $appManager
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppManager $appmanager)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::AppMarket)) {
            $appmanager->delete();
        } else if ($user->canDisable(Content::AppMarket)) {
            $appmanager->status = false;
            $appmanager->save();
        }
        return redirect()->route('appmanagers.index');
    }
}
