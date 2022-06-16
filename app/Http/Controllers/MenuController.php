<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Project;
use App\Enums\Content;
use App\Enums\UserRole;
use App\Enums\Permission;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->canRead(Content::Menu)) {
            $projects = $user->projects();
            $projIds = $projects->pluck('id')->toArray();
            if ($user->role <= UserRole::Administrator) {
                array_push($projIds, 0);
            }
            $menus = Menu::where('status', true)->whereIn('project_id', $projIds)->get();

            return view('menus.index', compact('menus'))
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
        if ($user->canCreate(Content::Menu)) {
            $data = $request->all();
            $data['status'] = true;
            $data['created_by'] = $user->id;

            if ($request->file()) {
                $imagefile = date('Y-m-d-H-i-s-').$request->file->getClientOriginalName();
                $path = $request->file('file')->storeAs('menus', $imagefile, 'images');
                $data['icon'] = env('APP_URL').'/images/menus/'.$imagefile;
            }
            Menu::create($data);
        }
        return redirect()->route('menus.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        $user = auth()->user();
        if ($user->canRead(Content::Menu)) {
            return view('menus.show', compact('menu'));
        }
        return redirect()->route('menus.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::Menu)) {
            $projects = Project::where('status', true)->get();
            return view('menus.edit', compact('menu'))
                   ->with(compact('projects'));
        }
        return redirect()->route('menus.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::Menu)) {
            $data = $request->all();
            if ($request->file()) {
                $imagefile = date('Y-m-d-H-i-s-').$request->file->getClientOriginalName();
                $path = $request->file('file')->storeAs('menus', $imagefile, 'images');
                $data['icon'] = env('APP_URL').'/images/menus/'.$imagefile;
            }
            $menu->update($data);
        }
        return redirect()->route('menus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::Menu)) {
            $menu->delete();
        } else if ($user->canDisable(Content::Menu)) {
            $menu->status = false;
            $menu->save();
        }
        return redirect()->route('menus.index');
    }
}
