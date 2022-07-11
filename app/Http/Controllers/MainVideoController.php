<?php

namespace App\Http\Controllers;

use App\Models\MainVideo;
use App\Models\Project;
use App\Models\User;
use App\Enums\Content;
use App\Enums\UserRole;
use App\Enums\Permission;
use Illuminate\Http\Request;

class MainVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $user = auth()->user();

        if ($user->role <= UserRole::MainManager) {
            $mainvideos = MainVideo::orderBy('id', 'DESC')->get();
            $projects = Project::where('status', true)->get();
        } else if ($user->role <= UserRole::Reseller) {
            $projects = $user->projects();
            $mainvideos = MainVideo::whereIn('id', $arr1)->get();
        } else {
            return view('home');
        }

        return view('mainvideos.index', compact('mainvideos'))
               ->with(compact('projects'));
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
        $data = $request->all();

        if ($user->canCreate(Content::MainVideo)) {
            $mainvideo = MainVideo::where('name', $data['name'])->first();
            if ($mainvideo == null) {
                //$data = $request->all();
                $data['status'] = true;
                $data['created_by'] = $user->id;
                $arr = explode("\r\n", $request->input('playlist'));
                $data['playlist'] = json_encode($arr);
                $mainvideo = MainVideo::create($data);
                return redirect()->route('mainvideos.index')
                                 ->with('insert-success', 'Insert Ok');
            } else {
                return redirect()->route('mainvideos.index')
                                 ->with('insert-error', 'Insert Error');
            }
        }
        return redirect()->route('mainvideos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MainVideo  $mainVideo
     * @return \Illuminate\Http\Response
     */
    public function show(MainVideo $mainvideo)
    {
        $user = auth()->user();
        if ($user->canRead(Content::MainVideo)) {
            return view('mainvideos.show', compact('mainvideo'));
        }
        return redirect()->route('mainvideos.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MainVideo  $mainVideo
     * @return \Illuminate\Http\Response
     */
    public function edit(MainVideo $mainvideo)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::MainVideo)) {
            $projects = Project::where('status', true)->get();
            return view('mainvideos.edit', compact('mainvideo'))
                   ->with(compact('projects'));
        }
        return redirect()->route('mainvideos.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MainVideo  $mainVideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MainVideo $mainvideo)
    {
        $user = auth()->user();
        $data = $request->all();

        if ($user->canUpdate(Content::MainVideo)) {
            $arr = explode("\r\n", $data['playlist']);
            $data['playlist'] = json_encode($arr);
            $mainvideo->update($data);
        }
        return redirect()->route('mainvideos.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MainVideo  $mainVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainVideo $mainvideo)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::MainVideo)) {
            $media_id = $mainvideo->id;
            $mainvideo->delete();
        } else if ($user->canDisable(Content::MainVideo)) {
            $mainvideo->status = false;
            $mainvideo->save();
        }
        return redirect()->route('mainvideos.index');

    }
}
