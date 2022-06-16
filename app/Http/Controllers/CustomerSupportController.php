<?php

namespace App\Http\Controllers;

use App\Models\CustomerSupport;
use App\Models\ApkProgram;
use App\Models\Project;
use App\Models\User;
use App\Enums\Content;
use App\Enums\Permission;
use App\Enums\UserRole;
use App\Uploads\ImageUpload;
use Illuminate\Http\Request;

class CustomerSupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->canRead(Content::CustomerSupport)) {
            $catagory_id = 8;
            $projects = $user->projects();
            $apks = ApkProgram::where('catagory_id', $catagory_id)->where('status', true)->get();
            $customersupports = CustomerSupport::where('status', true)->get();

            return view('customersupports.index', compact('customersupports'))
                   ->with(compact('projects'))
                   ->with(compact('apks'));
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
        if ($user->canCreate(Content::CustomerSupport)) {
            $data = $request->all();
            $data['status'] = true;
            $data['created_by'] = $user->id;

            if ($request->file()) {
                $upload = new ImageUpload('customersupports');
                $result = $upload->process($request->file);
                $data['qrcode_content'] = $result->url;
                $data['file_id']        = $result->id;
            }
            CustomerSupport::create($data);
        }
        return redirect()->route('customersupports.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerSupport  $customerSupport
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerSupport $customersupport)
    {
        $user= auth()->user();
        if ($user->canRead(Content::CustomerSupport)) {
            return view('customersupports.show', compact('customersupport'));
        }
        return redirect()->route('customersupports.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerSupport  $customerSupport
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerSupport $customersupport)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::CustomerSupport)) {
            $catagory_id = 8;
            $projects = Project::where('status', true)->get();
            $apks = ApkProgram::where('catagory_id', $catagory_id)->where('status', true)->get();
            return view('customersupports.edit', compact('customersupport'))
                   ->with(compact('projects'))
                   ->with(compact('apks'));
        }
        return redirect()->route('customersupports.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerSupport  $customerSupport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerSupport $customersupport)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::CustomerSupport)) {
            $data = $request->all();
            if ($request->file()) {
                $upload = new ImageUpload('customersupports');
                $result = $upload->process($request->file);
                $data['qrcode_content'] = $result->url;
                $data['file_id']        = $result->id;
            }
            $customersupport->update($data);
        }
        return redirect()->route('customersupports.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerSupport  $customerSupport
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerSupport $customersupport)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::CustomerSupport)) {
            $customersupport->delete();
        } else if ($user->canDisable(Content::CustomerSupport)) {
            $customersupport->status = false;
            $customersupport->save();
        }
        return redirect()->route('customersupports.index');
    }
}
