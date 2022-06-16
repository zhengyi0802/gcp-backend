<?php

namespace App\Http\Controllers;

use App\Models\QACatagory;
use App\Models\QAList;
use App\Models\User;
use App\Enums\UserRole;
use App\Enums\Content;
use App\Enums\Permission;
use App\Uploads\ImageUpload;
use App\Uploads\VideoUpload;
use Illuminate\Http\Request;

class QAListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $catagory_id = $request->input('catagory_id');

        if ($catagory_id == null) $catagory_id = 1;
        $catagory = QACatagory::find($catagory_id);
        $qalists = QAList::where('catagory_id', $catagory_id)->get();

        return view('qalists.index', compact('qalists'))
               ->with(compact('catagory'));
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
        if ($user->canCreate(Content::QA)) {
            $user = auth()->user();
            $data = $request->all();
            if (!$request->file()) {
                $data['answer'] = $data['url'];
            }
            $data['created_by'] = $user->id;
            $data['status'] = true;
            if ($data['type'] == 'image') {
                $upload = new ImageUpload('qalists');
                $result = $upload->process($request->file);
                $data['answer']  = $result->url;
                $data['file_id'] = $result->id;
            } else if ($data['type'] == 'i_video') {
                $upload = new VideoUpload('qalists');
                $result = $upload->process($request->file);
                $data['answer']  = $result->url;
                $data['file_id'] = $result->id;
            }
            QAList::create($data);
        }
        return redirect()->route('qalists.index', ['catagory_id' => $data['catagory_id']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QAList  $qAList
     * @return \Illuminate\Http\Response
     */
    public function show(QAList $qalist)
    {
        $user = auth()->user();
        if ($user->canRead(Content::QA)) {
            return view('qalists.show', compact('qalist'));
        }
        return redirect()->route('qalists.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QAList  $qAList
     * @return \Illuminate\Http\Response
     */
    public function edit(QAList $qalist)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::QA)) {
            return view('qalists.edit', compact('qalist'));
        }
        return redirect()->route('qalists.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QAList  $qAList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QAList $qalist)
    {
        $user = auth()->user();
        $data = $request->all();
        if ($user->canAudit(Content::QA) && $data['audit']) {
            $data['audit'] = true;
            $data['audit_by'] = $user->id;
            $data['audit_time'] = now();
        }
        if ($user->canUpdate(Content::QA)) {
            $qalist->update($data);
        }
        //var_dump($qalist->catagory_id);
        return redirect()->route('qalists.index',['catagory_id' => $qalist->catagory_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QAList  $qAList
     * @return \Illuminate\Http\Response
     */
    public function destroy(QAList $qalist)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::QA)) {
            $qalist->delete();
        } else if ($user->canDisable(Content::QA)) {
            $qalist->status = false;
            $qalist->save();
        }
        return redirect()->route('qalists.index');
    }
}
