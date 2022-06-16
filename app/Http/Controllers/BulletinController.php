<?php

namespace App\Http\Controllers;

use App\Models\Bulletin;
use App\Models\Project;
use App\Models\User;
use App\Enums\UserRole;
use App\Enums\Content;
use App\Enums\Permission;
use Illuminate\Http\Request;

class BulletinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->canRead(Content::Bulletin)) {
            $projects = $user->projects();
            $projIds = $projects->pluck('id')->toArray();
            $bulletins = Bulletin::whereIn('project_id', $projIds)->get();

            return view('bulletins.index', compact('bulletins'))
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
        if ($user->canCreate(Content::Bulletin)) {
            $data = $request->all();
            $data['status'] = true;
            $data['created_by'] = $user->id;
            if ($data['date'] == null) {
                $data['date'] = now();
            }
            $bulletin = Bulletin::create($data);
            return redirect()->route('bulletins.index')
                             ->with('insert-success', 'insert OK');
        }
        return redirect()->route('bulletins.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bulletin  $bulletin
     * @return \Illuminate\Http\Response
     */
    public function show(Bulletin $bulletin)
    {
        $user= auth()->user();
        if ($user->canRead(Content::Bulletin)) {
            return view('bulletins.show', compact('bulletin'));
        }
        return redirect()->route('bulletins.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bulletin  $bulletin
     * @return \Illuminate\Http\Response
     */
    public function edit(Bulletin $bulletin)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::Bulletin)) {
            return view('bulletins.edit', compact('bulletin'));
        }
        return redirect()->route('bulletins.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bulletin  $bulletin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bulletin $bulletin)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::Bulletin)) {
            $bulletin->update($request->all());
        }
        return redirect()->route('bulletins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bulletin  $bulletin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bulletin $bulletin)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::Bulletin)) {
            $bulletin->delete();
        } else if ($user->canDisable(Content::Bulletin)) {
            $bulletin->status = false;
            $bulletin->save();
        }
        return redirect()->route('bulletins.index');
    }
}
