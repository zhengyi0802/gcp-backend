<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Models\Project;
use App\Models\User;
use App\Enums\Content;
use App\Enums\UserRole;
use App\Enums\Permission;
use App\Uploads\ImageUpload;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->canRead(Content::Logo)) {
            $projects = $user->projects();
            $array = $projects->pluck('id')->toArray();
            $logos = Logo::where('status', true)->whereIn('id', $array)->latest()->get();

            return view('logos.index', compact('logos'))
                   ->with(compact('projects'));
        }
        return view('home');
    }

    public function browse()
    {
        $user = auth()->user();

        $page = 8;
        if ($user->canRead(Content::Logo)) {
            $projects = $user->projects();
            //$projects = Project::where('status', true)->get();
            $array = $projects->pluck('id')->toArray();
            $logos = Logo::where('status', true)->whereIn('id', $array)->latest()->paginate($page);

            return view('logos.browse', compact('logos'))
                   ->with(compact('projects'))
                   ->with('i', (request()->input('page', 1) - 1) * $page);
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
        $data = $request->all();

        if ($user->canCreate(Content::Logo)) {
            if (!$request->file()) {
                return redirect()->route('logos.index')
                                 ->with('insert-error', 'insert error');
            }
            $logo = Logo::where('name', $data['name'])->first();
            if ($logo == null) {
                $upload = new ImageUpload('logos');
                $result = $upload->process($request->file);
                $data['image']   = $result->url;
                $data['file_id'] = $result->id;

                $data['status'] = true;
                $data['created_by'] = $user->id;
                Logo::create($data);
                return redirect()->route('logos.index')
                             ->with('insert-success', 'insert OK');
            } else {
                return redirect()->route('logos.index')
                                 ->with('insert-error1', 'insert error');
            }
        }
        return redirect()->route('logos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function show(Logo $logo)
    {
        $user = auth()->user();
        if ($user->canRead(Content::Logo)) {
            return view('logos.show', compact('logo'));
        }
        return redirect()->route('logos.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function edit(Logo $logo)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::Logo)) {
            $projects = Project::where('status', true)->get();
            return view('logos.edit', compact('logo'))
                   ->with(compact('projects'));
        }
        return redirect()->route('logos.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logo $logo)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::Logo)) {
            $data = $request->all();
            if ($request->file()) {
                $upload = new ImageUpload('logos');
                $result = $upload->process($request->file);
                $data['image']   = $result->url;
                $data['file_id'] = $result->id;
            }
            $logo->update($data);
            return redirect()->route('logos.index')
                            ->with('update-success', 'update OK');
        }
        return redirect()->route('logos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logo $logo)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::Logo)) {
            $logo->delete();
        } else if ($user->canDisable(Content::Logo)) {
            $logo->status = false;
            $logo->save();
        }
        return redirect()->route('logos.index');
    }
}
