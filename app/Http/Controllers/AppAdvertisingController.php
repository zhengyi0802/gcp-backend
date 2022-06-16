<?php

namespace App\Http\Controllers;

use App\Models\AppAdvertising;
use App\Models\User;
use App\Models\Project;
use App\Enums\UserRole;
use App\Enums\Content;
use App\Enums\Permissiion;
use App\Uploads\ImageUpload;
use Illuminate\Http\Request;

class AppAdvertisingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $projects = Project::where('status', true)->get();
        $appadvertisings = AppAdvertising::where('status', true)->get();

        return view('appadvertisings.index', compact('appadvertisings'))
               ->with(compact('projects'));
    }

    public function browse()
    {
        $page = 8;
        $user = auth()->user();
        $projects = Project::where('status', true)->get();
        $appadvertisings = AppAdvertising::where('status', true)
                                          ->orderBy('id', 'DESC')
                                          ->paginate($page);

        return view('appadvertisings.browse', compact('appadvertisings'))
               ->with(compact('projects'))
               ->with('i', (request()->input('page', 1) - 1) * $page);
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
        if ($user->canCreate(Content::AppMarketAdvertising)) {
            if (!$request->file()) {
                return redirect()->route('appadvertisings.index')
                                 ->with('insert-error', 'insert error');
            }

            $data = $request->all();
            $data['status'] = true;
            $data['created_by'] = $user->id;
            $upload = new ImageUpload('appadvertisings');
            $result = $upload->process($request->file);
            $data['thumbnail'] = $result->url;
            $data['file_id']   = $result->id;
            $appadvertising = AppAdvertising::create($data);
        }
        return redirect()->route('appadvertisings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppAdvertising  $appAdvertising
     * @return \Illuminate\Http\Response
     */
    public function show(AppAdvertising $appadvertising)
    {
        $user = auth()->user();
        if ($user->canRead(Content::AppMarketAdvertising)) {
            return view('appadvertisings.show', compact('appadvertising'));
        }
        return redirect()->route('appadvertisings.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppAdvertising  $appAdvertising
     * @return \Illuminate\Http\Response
     */
    public function edit(AppAdvertising $appadvertising)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::AppMarketAdvertising)) {
            $projects = Project::where('status', true)->get();
            return view('appadvertisings.edit', compact('appadvertising'))
                   ->with(compact('projects'));
        }
        return redirect()->route('appadvertisings.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppAdvertising  $appAdvertising
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppAdvertising $appadvertising)
    {
        $user = auth()->user();
        $data = $request->all();
        if (!isset($data['audit'])) {
            $data['audit'] = false;
        } else {
            $data['audit'] = true;
        }
        if ($user->canUpdate(Content::AppMarketAdvertising)) {
            if ($request->file()) {
                $upload = new ImageUpload('appadvertisings');
                $result = $upload->process($request->file);
                $data['thumbnail'] = $result->url;
                $data['file_id']   = $result->id;
            }
            $appadvertising->update($data);
        }
        return redirect()->route('appadvertisings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppAdvertising  $appAdvertising
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppAdvertising $appadvertising)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::AppMarketAdvertising)) {
            $appadvertising->delete();
        } else if ($user->canDisable(Content::AppMarketAdvertising)) {
            $appadvertising->status = false;
            $appadvertising->save();
        }
        return redirect()->route('appadvertisings.index');
    }
}
