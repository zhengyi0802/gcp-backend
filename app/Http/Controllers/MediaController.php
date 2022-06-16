<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Menu;
use App\Models\MediaCatagory;
use App\Models\MediaContent;

class MediaController extends Controller
{
    public function browse(Request $request)
    {
        $page = 8;

        $id        = $request->input('id');
        $project_id   = $request->input('project_id');
        $menu_id   = $request->input('menu_id');
        $parent_id = $request->input('parent_id');

        if ($id == null) {
            $id = 0;
        }
        if ($parent_id == null) {
            $parent_id = 0;
        }
        if ($menu_id == null) {
            $menu_id = 1;
        }
        if ($project_id == null) {
            $project_id = 1;
        }

        $projects = Project::where('status', true)->get();
        $menus    = Menu::where('status', true)->get();

        $medias = null;
        $parent = null;
        if ($id > 0) {
            $catagory = MediaCatagory::where('id', $id)->first();
            if ($catagory->type == 'content') {
                $medias = MediaContent::where('catagory_id', $id)
                                      ->where('status', true)
                                      ->orderBy('id', 'DESC')
                                      ->latest()
                                      ->paginate($page);
                $rest = 8-$medias->count();
                for($i = 0; $i < $rest; $i++) {
                    $p = new MediaContent;
                    $medias->add($p);
                }
            }
            $parent = $catagory->name;
        }

        if ($medias == null) {
           $medias = MediaCatagory::where('project_id', $project_id)
                                  ->where('menu_id', $menu_id)
                                  ->where('parent_id', $id)
                                  ->orderBy('id', 'DESC')
                                  ->latest()
                                  ->paginate($page);
           $rest = 8-$medias->count();
           for($i = 0; $i < $rest; $i++) {
               $p = new MediaCatagory;
               $medias->add($p);
           }
        }

        return view('medias.browse', compact('medias'))
               ->with(compact('projects'))
               ->with(compact('menus'))
               ->with('project_id', $project_id)
               ->with('menu_id', $menu_id)
               ->with('parent_id', $parent_id)
               ->with('parent', $parent)
               ->with('i', (request()->input('page', 1) - 1) * $page);
    }

}
