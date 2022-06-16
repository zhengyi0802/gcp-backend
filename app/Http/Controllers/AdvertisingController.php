<?php

namespace App\Http\Controllers;

use App\Models\Advertising;
use App\Models\Project;
use App\Models\User;
use App\Enums\Content;
use App\Enums\Permission;
use App\Enums\UserRole;
use App\Uploads\ImageUpload;
use Illuminate\Http\Request;

class AdvertisingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->canRead(Content::Advertising)) {
            $projects = $user->projects();
            $projIds  = $projects->pluck('id')->toArray();
            $advertisings = Advertising::where('status', true)
                                       ->whereIn('project_id', $projIds)
                                       ->get();
            return view('advertisings.index', compact('advertisings'))
                   ->with(compact('projects'));
        }
        return view('home');
    }

    public function browse()
    {
        $page = 8;
        $user = auth()->user();
        if ($user->canRead(Content::Advertising)) {
            $projects = $user->projects();
            $projIds  = $projects->pluck('id')->toArray();
            $advertisings = Advertising::where('status', true)
                                       ->whereIn('project_id', $projIds)
                                       ->orderBy('id', 'DESC')
                                       ->paginate($page);
            return view('advertisings.browse', compact('advertisings'))
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
        if ($user->canCreate(Content::Advertising)) {
            if (!$request->file()) {
                return redirect()->route('advertisings.index')
                                 ->with('insert-error', 'insert error');
            }

            $data = $request->all();
            $data['status'] = true;
            $data['created_by'] = $user->id;
            $upload = new ImageUpload('advertisings');
            $result = $upload->process($request->file);
            $data['thumbnail'] = $result->url;
            $data['file_id']   = $result->id;
            $advertising = Advertising::create($data);
            return redirect()->route('advertisings.index')
                             ->with('insert-success', 'insert OK');
        }
        return redirect()->route('advertisings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advertising  $advertising
     * @return \Illuminate\Http\Response
     */
    public function show(Advertising $advertising)
    {
        $user = auth()->user();
        if ($user->canRead(Content::Advertising)) {
            return view('advertisings.show', compact('advertising'));
        }
        return redirect()->route('advertisings.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advertising  $advertising
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertising $advertising)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::Advertising)) {
            $projects = Project::where('status', true)->get();
            return view('advertisings.edit', compact('advertising'))
                   ->with(compact('projects'));
        }
        return redirect()->route('advertisings.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Advertising  $advertising
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertising $advertising)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::Advertising)) {
            $data = $request->all();
            if ($request->file()) {
                $upload = new ImageUpload('advertisings');
                $result = $upload->process($request->file);
                $data['thumbnail'] = $result->url;
                $data['file_id']   = $result->id;
            }
            try {
                $advertising->update($data);
            } catch(Exception $e) {
                return redirect()->route('advertisings.index')
                                 ->with('update-error', 'update error');
            }
            return redirect()->route('advertisings.index')
                             ->with('update-success', 'update OK');
        }
        return redirect()->route('advertisings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advertising  $advertising
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertising $advertising)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::Advertising)) {
            $advertising->delete();
        } else if ($user->canDisable(Content::Advertising)) {
            $advertising->status = false;
            $advertising->save();
        }
        return redirect()->route('advertisings.index');
    }
}
