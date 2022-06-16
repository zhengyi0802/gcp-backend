<?php

namespace App\Http\Controllers;

use App\Models\ApkCatagory;
use App\Enums\Content;
use App\Enums\UserRole;
use App\Enums\Permission;
use Illuminate\Http\Request;

class ApkCatagoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->canRead(Content::ApkManager)) {
            $apkcatagories = ApkCatagory::where('status', true)->get();
            return view('apkcatagories.index', compact('apkcatagories'));
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
        if ($user->canCreate(Content::ApkManager)) {
            $data = $request->all();
            $data['status'] = true;
            $data['created_by'] = $user->id;
            ApkCatagory::create($data);
        }
        return redirect()->route('apkcatagories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ApkCatagory  $apkCatagory
     * @return \Illuminate\Http\Response
     */
    public function show(ApkCatagory $apkcatagory)
    {
        $user = auth()->user();
        if ($user->canRead(Content::ApkManager)) {
            return view('apkcatagories.show', compact('apkcatagory'));
        }
        return redirect()->route('apkcatagories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ApkCatagory  $apkCatagory
     * @return \Illuminate\Http\Response
     */
    public function edit(ApkCatagory $apkcatagory)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::ApkManager)) {
            $parents = ApkCatagory::where('status', true)->get();
            return view('apkcatagories.edit', compact('apkcatagory', 'parents'));
        }
        return redirect()->route('apkcatagories.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ApkCatagory  $apkCatagory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApkCatagory $apkcatagory)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::ApkManager)) {
            $data = $request->all();
            $apkcatagory->update($data);
        }
        return redirect()->route('apkcatagories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApkCatagory  $apkCatagory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApkCatagory $apkcatagory)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::ApkManager)) {
            $apkcatagory->delete();
        } else if ($user->canDisable(Content::ApkManager)) {
            $apkcatagory->status = false;
            $apkcatagory->save();
        }

        return redirect()->route('apkcatagories.index');
    }
}
