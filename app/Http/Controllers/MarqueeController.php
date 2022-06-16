<?php

namespace App\Http\Controllers;

use App\Models\Marquee;
use App\Models\Project;
use App\Models\Product;
use App\Models\User;
use App\Enums\Content;
use App\Enums\UserRole;
use App\Enums\Permission;
use Illuminate\Http\Request;

class MarqueeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->canRead(Content::Marquee)) {
            $projects = $user->projects();
            $projIds  = $projects->pluck('id')->toArray();
            $marquees = Marquee::where('project_id', $projIds)
                               ->where('status', true)
                               ->get();
            return view('marquees.index', compact('marquees'))
                   ->with(compact('projects'));
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
        if ($user->canCreate(Content::Marquee)) {
            $data = $request->all();
            $data['status'] = true;
            $data['created_by'] = $user->id;
            if ($data['type'] == 1) {
                $data['project_id'] = null;
            }
            Marquee::create($data);
        }
        return redirect()->route('marquees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marquee  $marquee
     * @return \Illuminate\Http\Response
     */
    public function show(Marquee $marquee)
    {
        $user = auth()->user();
        if ($user->canRead(Content::Marquee)) {
            return view('marquees.show', compact('marquee'));
        }
        return redirect()->route('marquees.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marquee  $marquee
     * @return \Illuminate\Http\Response
     */
    public function edit(Marquee $marquee)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::Marquee)) {
            $projects = Project::where('status', true)->get();
            return view('marquees.edit', compact('marquee'))
                   ->with(compact('projects'));
        }
        return redirect()->route('marquees.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marquee  $marquee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marquee $marquee)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::Marquee)) {
            $data = $request->all();
            if ($data['type'] == 1) {
                $data['project_id'] = null;
            }
            $marquee->update($data);
        }
        return redirect()->route('marquees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marquee  $marquee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marquee $marquee)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::Marquee)) {
            $marquee->delete();
        } else if ($user->canDisable(Content::Marquee)) {
            $marquee->status = false;
            $marquee->save();
        }
        return redirect()->route('marquees.index');
    }
}
