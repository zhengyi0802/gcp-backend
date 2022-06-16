<?php

namespace App\Http\Controllers;

use App\Models\ApiTest;
use App\Models\Project;
use App\Models\User;
use App\Enums\UserRole;
use App\Enums\Permission;
use App\Enums\Content;
use Illuminate\Http\Request;

class ApiTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->canRead(Content::ApiTest)) {
            $apitests = ApiTest::get();
            $projects = Project::where('status', true)->get();

            return view('apitests.index', compact('apitests'))
                   ->with(compact('projects'));
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
        if ($user->canCreate(Content::ApiTest)) {
            $data = $request->all();
            $data['status'] = true;
            $data['created_by'] = $user->id;
            ApiTest::create($data);
            return redirect()->route('apitests.index');
        }
        return view('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ApiTest  $apiTest
     * @return \Illuminate\Http\Response
     */
    public function show(ApiTest $apitest)
    {
        $user = auth()->user();
        if ($user->canRead(Content::ApiTest)) {
            return view('apitests.show', compact('apitest'));
        }
        return view('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ApiTest  $apiTest
     * @return \Illuminate\Http\Response
     */
    public function edit(ApiTest $apitest)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::ApiTest)) {
            $projects = Project::where('status', true)->get();
            return view('apitests.edit', compact('apitest'))
                   ->with(compact('projects'));
        }
        return view('home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ApiTest  $apiTest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApiTest $apitest)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::ApiTest)) {
            $data = $request->all();
            $apitest->update($data);
            return redirect()->route('apitests.index');
        }
        return view('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApiTest  $apiTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApiTest $apitest)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::ApiTest)) {
            $apitest->delete();
        } else if ($user->canDisable(Content::ApiTest)) {
            $apitest->status = false;
            $apitest->save();
        }
        return view('home');
    }
}
