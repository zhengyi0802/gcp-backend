<?php

namespace App\Http\Controllers;

use App\Models\Startpage;
use App\Models\User;
use App\Models\Project;
use App\Enums\UserRole;
use App\Enums\Permission;
use App\Enums\Content;
use App\Uploads\ImageUpload;
use App\Uploads\VideoUpload;
use Illuminate\Http\Request;

class StartpageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->canRead(Content::Startpage)) {
            $projects = Project::where('status', true)->get();
            if ($user->role <= UserRole::MainManager) {
                $startpages = Startpage::where('status', true)->get();
            } else if ($user->role <= UserRole::Reseller) {
                $projects = $user->projects();
                $arr1 = $projects->pluck('id')->toArray();
                $startpages = Startpage::whereIn('id', $arr1)->get();
            }
            return view('startpages.index', compact('startpages'))
                   ->with(compact('projects'));
        }
        return view('home');
    }

    public function browse()
    {
        $page = 8;
        $user = auth()->user();
        if ($user->canRead(Content::Startpage)) {
            $projects = Project::where('status', true)->get();
            if ($user->role <= UserRole::MainManager) {
                $startpages = Startpage::where('status', true)->latest()->paginate($page);
            } else if ($user->role <= UserRole::Reseller) {
                $projects = $user->projects();
                $arr2 = $projects->pluck('id')->toArray();
                $startpages = Startpage::whereIn('projects', $arr2)->paginate($page);
            }
            return view('startpages.browse', compact('startpages'))
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
        if ($user->canCreate(Content::Startpage)) {
            $data = $request->all();
            $data['status'] = true;
            $data['created_by'] = $user->id;
            if ($data['mime_type'] == 'image' || $data['mime_type'] == 'i_video') {
                if (!$request->file()) {
                    return redirect()->route('startpages.index')
                                 ->with('error', 'No file upload');
                }
                if ($data['mime_type'] == 'image' ) {
                    $upload = new ImageUpload('startpages');
                    $result = $upload->process($request->file);
                    $data['url']     = $result->url;
                    $data['file_id'] = $result->id;
                } else {
                    $upload = new VideoUpload('startpages');
                    $result = $upload->process($request->file);
                    $data['url']     = $result->url;
                    $data['file_id'] = $result->id;
                }
            }
            $startpage = Startpage::create($data);
            return redirect()->route('startpages.index')
                             ->with('insert-success', 'insert success');
        }
        return redirect()->route('startpages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Startpage  $startpage
     * @return \Illuminate\Http\Response
     */
    public function show(Startpage $startpage)
    {
        $user = auth()->user();
        if ($user->canRead(Content::Startpage)) {
            return view('startpages.show', compact('startpage'));
        }
        return redirect()->route('startpages.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Startpage  $startpage
     * @return \Illuminate\Http\Response
     */
    public function edit(Startpage $startpage)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::Startpage)) {
            $projects = Project::where('status', true)->get();
            return view('startpages.edit', compact('startpage'))
                   ->with(compact('projects'));
        }
        return redirect()->route('startpages.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Startpage  $startpage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Startpage $startpage)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::Startpage)) {
            $data = $request->all();
            if ($request->file()) {
                if ($data['mime_type'] == 'image' ) {
                    $upload = new ImageUpload('startpages');
                    $result = $upload->process($request->file);
                    $data['url']     = $result->url;
                    $data['file_id'] = $result->id;
                } else {
                    $upload = new VideoUpload('startpages');
                    $result = $upload->process($result->file);
                    $data['url']     = $result->url;
                    $data['file_id'] = $result->id;
                }
            }
            $startpage->update($data);
            return redirect()->route('startpages.index')
                             ->with('update-success', 'update success');
        }
        return redirect()->route('startpages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Startpage  $startpage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Startpage $startpage)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::Startpage)) {
            $startpage->delete();
        } else if ($user->canDisable(Content::Startpage)) {
            $startoage->status = false;
            $startpage->save();
        }
        return redirect()->route('startpages.index');
    }
}
