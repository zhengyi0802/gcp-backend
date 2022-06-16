<?php

namespace App\Http\Controllers;

use App\Models\MediaCatagory;
use App\Models\MediaContent;
use App\Models\Project;
use App\Models\Menu;
use App\Models\User;
use App\Enums\Content;
use App\Enums\UserRole;
use App\Enums\Permission;
use App\Uploads\ImageUpload;
use App\Uploads\VideoUpload;
use Illuminate\Http\Request;

class MediaCatagoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->canRead(Content::Medias)) {
            $mediacatagories = MediaCatagory::where('status', true)->get();

            return view('mediacatagories.index', compact('mediacatagories'));
        }
        return view('home');
    }

    public function browse()
    {
        $page = 8;
        $user = auth()->user();
        if ($user->canRead(Content::Medias)) {
            $mediacatagories = MediaCatagory::where('status', true)
                                           ->orderBy('id', 'DESC')
                                           ->paginate($page);

            return view('mediacatagories.browse', compact('mediacatagories'))
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
        if ($user->canCreate(Content::Medias)) {
            $project_id = $request->input('project_id');
            $menu_id = $request->input('menu_id');
            if ($project_id == null) {
                $project_id = 1;
            }
            $projects = Project::where('status', true)->get();
            $menus = Menu::where('status', true)->get();
            $parents = MediaCatagory::where('type', 'catagory')
                                    ->get();

            return view('mediacatagories.create', compact('projects'))
                   ->with(compact('menus'))
                   ->with(compact('parents'))
                   ->with('project_id', $project_id)
                   ->with('menu_id', $menu_id);
        }
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
            if (!$request->file()) {
               return redirect()->route('mediacatagories.index')
                                ->with('insert-error', 'insert error');
            }

            $data = $request->all();
            $data['status'] = true;
            $data['created_by'] = $user->id;
            if ($request->file()) {
                $subdir = 'medias/p_'.$data['project_id'].'_'.$data['menu_id'];
                $upload = new ImageUpload($subdir);
                $result = $upload->process($request->file);
                $data['thumbnail'] = $result->url;
                $data['file_id']   = $result->id;
            }
            $catagory = MediaCatagory::create($data);
        }
        return redirect()->route('mediacatagories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MediaCatagory  $mediaCatagory
     * @return \Illuminate\Http\Response
     */
    public function show(MediaCatagory $mediacatagory)
    {
        $user = auth()->user();
        if ($user->canRead(Content::Medias)) {
            return view('mediacatagories.show', compact('mediacatagory'));
        }
        return redirect()->route('mediacatagories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MediaCatagory  $mediaCatagory
     * @return \Illuminate\Http\Response
     */
    public function edit(MediaCatagory $mediacatagory)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::Medias)) {
            $menus = Menu::where('status', true)->get();
            $parents = MediaCatagory::where('status', true)->get();
            return view('mediacatagories.edit', compact('mediacatagory'))
                   ->with(compact('parents'))
                   ->with(compact('menus'));
        }
        return redirect()->route('mediacatagories.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MediaCatagory  $mediaCatagory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MediaCatagory $mediacatagory)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::Medias)) {
            $data = $request->all();
            if ($request->file()) {
                $subdir = 'medias/p_'.$data['project_id'].'_'.$data['menu_id'];
                $upload = new ImageUpload($subdir);
                $result = $upload->process($request->file);
                $data['thumbnail'] = $result->url;
                $data['file_id']   = $result->id;
            }
            $mediacatagory->update($data);
        }
        return redirect()->route('mediacatagories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MediaCatagory  $mediaCatagory
     * @return \Illuminate\Http\Response
     */
    public function destroy(MediaCatagory $mediacatagory)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::Medias)) {
            $mediacatagory->delete();
        } else if ($user->canDisable(Content::Medias)) {
            $mediacatagory->status = false;
            $mediacatagory->save();
        }
        return redirect()->route('mediacatagories.index');
    }
}
