<?php

namespace App\Http\Controllers;

use App\Models\VoiceSetting;
use App\Models\Project;
use App\Models\ApkProgram;
use App\Models\User;
use App\Enums\UserRole;
use App\Enums\Permission;
use App\Enums\Content;
use Illuminate\Http\Request;

class VoiceSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->canRead(Content::VoiceSetting)) {
            $catagory_id = 7;
            $projects = $user->projects();
            $apks = ApkProgram::where('status', true)->get();

            $voicesettings = VoiceSetting::where('status', true)->get();

            return view('voicesettings.index', compact('voicesettings'))
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
        if ($user->canCreate(Content::VoiceSetting)) {
            $data = $request->all();
            $data['status'] = true;
            $data['created_by'] = $user->id;
            VoiceSetting::create($data);
        }
        return redirect()->route('voicesettings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VoiceSetting  $voiceSetting
     * @return \Illuminate\Http\Response
     */
    public function show(VoiceSetting $voicesetting)
    {
        $user = auth()->user();
        if ($user->canRead(Content::VoiceSetting)) {
            return view('voicesettings.show', compact('voicesetting'));
        }
        return redirect()->route('voicesettings.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VoiceSetting  $voiceSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(VoiceSetting $voicesetting)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::VoiceSetting)) {
            $catagory_id = 7;
            $projects = Project::where('status', true)->get();
            $apks = ApkProgram::where('catagory_id', $catagory_id)->where('status', true)->get();

            return view('voicesettings.edit', compact('voicesetting'))
                   ->with(compact('apks'))
                   ->with(compact('projects'));
        }
        return redirect()->route('voicesettings.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VoiceSetting  $voiceSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VoiceSetting $voicesetting)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::VoiceSetting)) {
            $data = $request->all();
            $voicesetting->update($data);
        }
        return redirect()->route('voicesettings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VoiceSetting  $voiceSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(VoiceSetting $voicesetting)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::VoiceSetting)) {
            $voicesetting->delete();
        } else if ($user->canDisable(Content::VoiceSetting)) {
            $voicesetting->status = false;
            $voicesetting->save();
        }
        return redirect()->route('voicesettings.index');
    }
}
