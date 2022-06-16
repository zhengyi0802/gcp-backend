<?php

namespace App\Http\Controllers;

use App\Models\QACatagory;
use App\Models\QAList;
use App\Models\User;
use App\Enums\Content;
use App\Enums\UserRole;
use App\Enums\Permission;
use Illuminate\Http\Request;

class QACatagoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = 20;
        $user = auth()->user();
        if ($user->canRead(Content::QA)) {
            $qacatagories = QACatagory::where('status', true)
                                      ->orderBy('position', 'ASC')
                                      ->paginate($page);

            $catagory_id = $request->input('catagory_id');

            return view('qacatagories.index', compact('qacatagories'))
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
        if ($user->canCreate(Content::QA)) {
            $data = $request->all();
            $data['created_by'] = $user->id;
            $data['status'] = true;
            QACatagory::create($data);
           return redirect()->route('qacatagories.index');
        }
        return redirect()->route('qacatagories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QACatagory  $qACatagory
     * @return \Illuminate\Http\Response
     */
    public function show(QACatagory $qacatagory)
    {
        $user = auth()->user();
        if ($user->canRead(Content::QA)) {
            return view('qacatagories.show', compact('qacatagory'));
        }
        return redirect()->route('qacatagories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QACatagory  $qACatagory
     * @return \Illuminate\Http\Response
     */
    public function edit(QACatagory $qacatagory)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::QA)) {
            return view('qacatagories.edit', compact('qacatagory'));
        }
        return redirect()->route('qacatagories.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QACatagory  $qACatagory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QACatagory $qacatagory)
    {
        $user = auth()->user();
        $data = $request->all();
        if ($user->canAudit(Content::QA) && $data['audit']) {
            $data['audit'] = true;
            $data['audit_by'] = $user->id;
            $daya['audit_time'] = now();
        }
        if ($user->canUpdate(Content::QA)) {
            $qacatagory->update($data);
        }
        return redirect()->route('qacatagories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QACatagory  $qACatagory
     * @return \Illuminate\Http\Response
     */
    public function destroy(QACatagory $qacatagory)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::QA)) {
            $qacatagory->delete();
        } else if ($user->canDisable(Content::QA)) {
            $qacatagory->status = false;
            $qacatagory->save();
            foreach($qacatagory->lists as $list) {
               $list->status = false;
               $list->save();
            }
        }
        return redirect()->route('qacatagories.index');
    }

}
