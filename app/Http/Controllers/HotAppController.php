<?php

namespace App\Http\Controllers;

use App\Models\HotApp;
use App\Models\ApkCatagory;
use App\Models\ApkProgram;
use App\Models\Project;
use App\Models\User;
use App\Enums\Content;
use App\Enums\UserRole;
use App\Enums\Permission;
use Illuminate\Http\Request;

class HotAppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        if ($user->canRead(Content::HotApp)) {
            $catagory_id = $request->input('catagory_id');
            $projects = Project::where('status', true)->get();
            $catagories = ApkCatagory::where('status', true)->get();
            if ($catagory_id != null) {
                $apks = ApkProgram::where('catagory_id', $catagory_id)->where('status', true)->get();
            } else {
                $apks = ApkProgram::where('status', true)->get();
            }
            $hotapps = HotApp::where('status', true)->get();

            return view('hotapps.index', compact('hotapps'))
                   ->with(compact('projects'))
                   ->with(compact('catagories'))
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
        if ($user->canCreate(Content::HotApp)) {
            $data = $request->all();
            $data['status'] = true;
            $data['created_by'] = $user->id;

            try {
                HotApp::create($data);
            } catch(Exception $e) {
                return redirect()->route('hotapps.index')
                                 ->with('insert-error', 'insert error');
            }

            return redirect()->route('hotapps.index')
                             ->with('insert-success', 'insert OK');
        }
        return redirect()->route('hotapps.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HotApp  $hotApp
     * @return \Illuminate\Http\Response
     */
    public function show(HotApp $hotapp)
    {
        $user = auth()->user();
        if ($user->canRead(Content::HotApp)) {
            return view('hotapps.show', compact('hotapp'));
        }
        return redirect()->route('hotapps.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HotApp  $hotApp
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, HotApp $hotapp)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::HotApp)) {
            $catagory_id = $request->input('catagory_id');
            $projects = Project::where('status', true)->get();
            $catagories = ApkCatagory::where('status', true)->get();
            if ($catagory_id != null) {
                $apks = ApkProgram::where('catagory_id', $catagory_id)->where('status', true)->get();
            } else {
                $catagory_id = $hotapp->apk->catagory_id;
                $apks = ApkProgram::where('status', true)->get();
            }
            return view('hotapps.edit', compact('hotapp'))
                   ->with(compact('projects'))
                   ->with(compact('catagories'))
                   ->with(compact('apks'))
                   ->with('catagory_id', $catagory_id);
        }
        return redirect()->route('hotapps.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HotApp  $hotApp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HotApp $hotapp)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::HotApp)) {
            $data = $request->all();
            $hotapp->update($data);
        }
        return redirect()->route('hotapps.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HotApp  $hotApp
     * @return \Illuminate\Http\Response
     */
    public function destroy(HotApp $hotapp)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::HotApp)) {
            $hotapp->delete();
        } else if ($user->canDisable(Content::HotApp)) {
            $hotapp->status = false;
            $hotapp->save();
        }
        return redirect()->route('hotapps.index');
    }
}
