<?php

namespace App\Http\Controllers;

use App\Models\OneKeyInstaller;
use App\Models\Project;
use App\Models\ApkCatagory;
use App\Models\ApkProgram;
use App\Models\User;
use App\Enums\UserRole;
use App\Enums\Permission;
use App\Enums\Content;
use Illuminate\Http\Request;

class OneKeyInstallerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        if ($user->canRead(Content::OneKeyInstaller)) {
            $catagory_id = $request->input('catagory_id');
            $projects = $user->projects();
            $catagories = ApkCatagory::where('status', true)->get();
            if ($catagory_id != null) {
               $apks = ApkProgram::where('catagory_id', $catagory_id)->where('status', true)->get();
            } else {
               $apks = ApkProgram::where('status', true)->get();
            }

            $onekeyinstallers = OneKeyInstaller::where('status', true)->get();

            return view('onekeyinstallers.index', compact('onekeyinstallers'))
                   ->with(compact('projects'))
                   ->with(compact('apks'))
                   ->with(compact('catagories'));
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

        if ($user->canCreate(Content::OneKeyInstaller)) {
            $catagory_id = $request->input('catagory_id');
            $projects = $user->projects();
            $catagories = ApkCatagory::where('status', true)->get();
            if ($catagory_id != null) {
               $apks = ApkProgram::where('catagory_id', $catagory_id)->where('status', true)->get();
            } else {
               $apks = ApkProgram::where('status', true)->get();
               $catagory_id = 0;
            }
            return view('onekeyinstallers.create', compact('projects'))
                   ->with(compact('apks'))
                   ->with(compact('catagories'))
                   ->with('catagory_id', $catagory_id);
        }
        return redirect()->route('onekeyinstallers.index');
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
        if ($user->canCreate(Content::OneKeyInstaller)) {
            $data = $request->all();
            $data['status'] = true;
            $data['created_by'] = $user->id;

            try {
                OneKeyInstaller::create($data);
            } catch(Exception $e) {
                return redirect()->route('onekeyinstallers.index')
                                 ->with('insert-error', 'insert error');
            }

            return redirect()->route('onekeyinstallers.index')
                             ->with('insert-success', 'insert OK');
        }
        return redirect()->route('onekeyinstallers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OneKeyInstaller  $oneKeyInstaller
     * @return \Illuminate\Http\Response
     */
    public function show(OneKeyInstaller $onekeyinstaller)
    {
        $user = auth()->user();
        if ($user->canRead(Content::OneKeyInstaller)) {
            return view('onekeyinstallers.show', compact('onekeyinstaller'));
        }
        return redirect()->route('onekeyinstallers.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OneKeyInstaller  $oneKeyInstaller
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, OneKeyInstaller $onekeyinstaller)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::OneKeyInstaller)) {
            $catagory_id = $request->input('catagory_id');
            $projects = Project::where('status', true)->get();
            $catagories = ApkCatagory::where('status', true)->get();
            if ($catagory_id != null) {
                $apks = ApkProgram::where('catagory_id', $catagory_id)->where('status', true)->get();
            } else {
                $catagory_id = $onekeyinstaller->apk->catagory_id;
                $apks = ApkProgram::where('status', true)->get();
            }

            return view('onekeyinstallers.edit', compact('onekeyinstaller'))
                   ->with(compact('projects'))
                   ->with(compact('catagories'))
                   ->with(compact('apks'))
                   ->with('catagory_id', $catagory_id);
        }
        return redirect()->route('onekeyinstallers.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OneKeyInstaller  $oneKeyInstaller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OneKeyInstaller $onekeyinstaller)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::OneKeyInstaller)) {
            $data = $request->all();
            $onekeyinstaller->update($data);
        }
        return redirect()->route('onekeyinstallers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OneKeyInstaller  $oneKeyInstaller
     * @return \Illuminate\Http\Response
     */
    public function destroy(OneKeyInstaller $onekeyinstaller)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::OneKeyInstaller)) {
            $onekeyinstaller->delete();
        } else if ($user->canDisable(Content::OneKeyInstaller)) {
            $onekeyinstaller->status = false;
            $onekeyinstaller->save();
        }
        return redirect()->route('onekeyinstallers.index');
    }
}
