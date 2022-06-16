<?php

namespace App\Http\Controllers;

use App\Models\BulletinItem;
use App\Models\Bulletin;
use App\Models\User;
use App\Uploads\ImageUpload;
use App\Uploads\VideoUpload;
use App\Enums\Content;
use App\Enums\UserRole;
use App\Enums\Permission;
use Illuminate\Http\Request;

class BulletinItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $bulletin_id = $request->input('bulletin_id');
        if ($user->canRead(Content::Bulletin) && ($bulletin_id != null)) {
            $bulletin = Bulletin::find($bulletin_id);
            $bulletinitems = BulletinItem::where('bulletin_id', $bulletin_id)
                                         ->where('status', true)
                                         ->get();

            return view('bulletinitems', compact('bulletinitems'))
                   ->with(compact('bulletin'));
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
        $bulletin = Bulletin::find($data['bulletin_id']);
        if ($user->canCreate(Content::Bulletin)) {
            $data['status'] = true;
            $data['created_by'] = $user->id;
            if ($data['mime_type'] == 'image' || $data['mime_type'] == 'i_video') {
                if (!$request->file()) {
                    return redirect()->route('bulletinitems', compact('bulletin'));
                }
                if ($data['mime_type'] == 'image' ) {
                    $upload = new ImageUpload('bulletins');
                    $result = $upload->process($request->file);
                    $data['url']     = $result->url;
                    $data['file_id'] = $result->id;
                } else {
                    $upload = new VideoUpload('bulletins');
                    $result = $upload->process($request->file);
                    $data['url']     = $result->url;
                    $data['file_id'] = $result->id;
                }
            }
            BulletinItem::create($data);
        }
        return redirect()->route('bulletins.show', compact('bulletin'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BulletinItem  $bulletinItem
     * @return \Illuminate\Http\Response
     */
    public function show(BulletinItem $bulletinitem)
    {
        //var_dump($bulletinitem);

        $user = auth()->user();
        if ($user->canRead(Content::Bulletin)) {
            return view('bulletinitems.show', compact('bulletinitem'));
        }
        return redirect()->route('bulletinitems.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BulletinItem  $bulletinItem
     * @return \Illuminate\Http\Response
     */
    public function edit(BulletinItem $bulletinitem)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::Bulletin)) {
            return view('bulletinitems.edit', compact('bulletinitem'));
        }
        return redirect()->route('bulletinitems.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BulletinItem  $bulletinItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BulletinItem $bulletinitem)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::Bulletin)) {

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BulletinItem  $bulletinItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(BulletinItem $bulletinitem)
    {
/*
        $user = auth()->user();
        $bulletin = Bulletin::find($bulletinitem->bulletin_id);
        if ($user->canDelete(Content::Bulletin)) {
            $bulletinitem->delete();
        } else if ($user->canDisable(Content::Bulletin)) {
            $bulletinitem->status = false;
            $bulletinitems->save();
        }
        return redirect()->route('bulletins.show', compact('bulletin'));
*/
    }
}
