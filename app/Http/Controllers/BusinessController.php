<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Project;
use App\Models\User;
use App\Enums\Content;
use App\Enums\Permission;
use App\Enums\UserRole;
use App\Uploads\ImageUpload;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->canRead(Content::Business)) {
            $projects = $user->projects();
            $projIds = $projects->pluck('id')->toArray();
            $businesses = Business::where('status', true)
                                  ->whereIn('project_id', $projIds)
                                  ->get();

            return view('businesses.index', compact('businesses'))
                   ->with(compact('projects'));
        }
        return view('home');
    }

    public function browse()
    {
        $page = 8;
        $user = auth()->user();
        if ($user->canRead(Content::Business)) {
            $projects = $user->projects();
            $projIds = $projects->pluck('id')->toArray();
            $businesses = Business::where('status', true)
                                  ->whereIn('project_id', $projIds)
                                  ->orderBy('id', 'DESC')
                                  ->paginate($page);

            return view('businesses.browse', compact('businesses'))
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
        if ($user->canCreate(Content::Business)) {
            if (!$request->file()) {
                return redirect()->route('businesses.index')
                                 ->with('insert-error', 'insert error');
            }
            $data = $request->all();
            $data['status'] = true;
            $data['created_by'] = $user->id;

            $upload = new ImageUpload('businesses');
            $result = $upload->process($request->file);
            $data['logo_url'] = $result->url;
            $data['file_id']  = $result->id;
            $business = Business::create($data);
            $project = Project::find($data['project_id']);
            return redirect()->route('businesses.index')
                             ->with('insert-success', 'insert OK');
        }
        return redirect()->route('businesses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function show(Business $business)
    {
        $user = auth()->user();
        if ($user->canRead(Content::Business)) {
            return view('businesses.show', compact('business'));
        }
        return redirect()->route('businesses.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function edit(Business $business)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::Business)) {
            $projects = Project::where('status', true)->get();

            return view('businesses.edit', compact('business'))
                   ->with(compact('projects'));
        }
        return view('businesses.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Business $business)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::Business)) {
            $data = $request->all();
            if ($request->file()) {
                $upload = new ImageUpload('businesses');
                $result = $upload->process($request->file);
                $data['logo_url'] = $result->url;
                $data['file_id']  = $result->id;
            }
            try {
                $business->update($data);
            } catch(Exception $e) {
                return redirect()->route('businesses.index')
                                 ->with('update-error', 'update error');
            }
            return redirect()->route('businesses.index')
                             ->with('update-success', 'update OK');
        }
        return redirect()->route('businesses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function destroy(Business $business)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::Business)) {
            $business->delete();
        } else if ($user->canDisable(Content::Business)) {
            $business->status = false;
            $business->save();
        }
        return redirect()->route('businesses.index');
    }
}
