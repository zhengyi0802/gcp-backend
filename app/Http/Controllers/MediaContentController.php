<?php

namespace App\Http\Controllers;

use App\Models\MediaContent;
use App\Models\MediaCatagory;
use App\Models\User;
use App\Enums\Content;
use App\Enums\UserRole;
use App\Enums\Permission;
use App\Uploads\ImageUpload;
use App\Uploads\VideoUpload;
use Illuminate\Http\Request;

class MediaContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        if ($user->canRead(Content::Medias)) {
            $mediacontents = MediaContent::where('status', true)->get();

            return view('mediacontents.index', compact('mediacontents'));
        }
        return view('home');
    }

    public function browse(Request $request)
    {
        $page = 8;
        $user = auth()->user();
        if ($user->canRead(Content::Medias)) {
            $mediacontents = MediaContent::where('status', true)->orderBy('id', 'DESC')->paginate($page);

            return view('mediacontents.browse', compact('mediacontents'))
                   ->with('i', (request()->input('page', 1) - 1) * $page);
        }
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = auth()->user();
        $project_id = $request->input('project_id');
        if ($project_id == null) {
            $project_id = 1;
        }
        if ($user->canCreate(Content::Medias)) {
            $projects = Project::where('status', true)->get();
            $mediacatagories = MediaCatagory::where('type', 'content')->where('status', true)->get();
            return view('mediacontents.create', compact('projects'))
                   ->with(compact('mediacatagories'))
                   ->with('project_id', $project_id);
        }
        return redirect()->route('mediacontents.index');
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
        if ($user->canCreate(Content::Medias)) {

            $data = $request->all();
            $data['status'] = true;
            $data['created_by'] = $user->id;
            $catagory = MediaCatagory::find($data['catagory_id']);
            $menu_id = $catagory->menu_id;
            if ($request->file('image')) {
                $subdir = 'medias/p_'.$data['project_id'].'_'.$menu_id;
                $upload = new ImageUpload($subdir);
                $result = $upload->process($request->image);
                $data['preview']  = $result->url;
                $data['pfile_id'] = $result->id;
            }
            if ($request->file('video')) {
                $subdir = 'medias/p_'.$data['project_id'].'_'.$menu_id;
                $upload = new VideoUpload($subdir);
                $result = $upload->process($request->video);
                $data['url']      = $result->url;
                $data['cfile_id'] = $result->id;
            }
            $mediacontent = MediaContent::create($data);
        }
        return redirect()->route('mediacontents.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MediaContent  $mediaContent
     * @return \Illuminate\Http\Response
     */
    public function show(MediaContent $mediacontent)
    {
        $user = auth()->user();
        if ($user->canRead(Content::Medias)) {
            return view('mediacontents.show', compact('mediacontent'));
        }
        return redirect()->route('mediacontents.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MediaContent  $mediaContent
     * @return \Illuminate\Http\Response
     */
    public function edit(MediaContent $mediacontent)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::Medias)) {
            $mediacatagories = MediaCatagory::where('status', true)->get();
            return view('mediacontents.edit', compact('mediacontent'))
                   ->with(compact('mediacatagories'));
        }
        return redirect()->route('mediacontents.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MediaContent  $mediaContent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MediaContent $mediacontent)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::Medias)) {
            $catagory = MediaCatagory::find($data['catagory_id']);
            $menu_id = $catagory->menu_id;
            if ($request->file('image')) {
                $subdir = 'medias/p_'.$data['project_id'].'_'.$menu_id;
                $upload = new ImageUpload($subdir);
                $result = $upload->process($request->image);
                $data['preview'] = $result['url'];
            }
            if ($request->file('video')) {
                $subdir = 'medias/p_'.$data['project_id'].'_'.$menu_id;
                $upload = new VideoUpload($subdir);
                $result = $upload->process($request->video);
                $data['url'] = $result['url'];
            }
            $mediacontent->update($data);
        }
        return redirect()->route('mediacontents.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MediaContent  $mediaContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(MediaContent $mediacontent)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::Medias)) {
            $mediacontent->delete();
        } else if ($user->canDisable(Content::Medias)) {
            $mediacontent->status = false;
            $mediacontent->save();
        }
        return redirect()->route('mediacontents.index');
    }
}
