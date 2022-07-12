<?php

namespace App\Http\Controllers;

use App\Models\ApkProgram;
use App\Models\ApkCatagory;
use App\Models\Project;
use App\Models\ProductType;
use App\Models\User;
use App\Enums\Content;
use App\Enums\Permission;
use App\Enums\UserRole;
use App\Uploads\ApkUpload;
use Illuminate\Http\Request;

class ApkProgramController extends Controller
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
            $projects = Project::where('status', true)->get();
            $types = ProductType::where('status', true)->get();
            $catagories = ApkCatagory::where('status', true)->get();
            $apkprograms = ApkProgram::where('status', true)->get();
            return view('apkprograms.index', compact('apkprograms'))
                   ->with(compact('catagories'))
                   ->with(compact('projects'))
                   ->with(compact('types'));
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
            $flag = $request->input('from');
            $data = $request->all();
            $data['type_id']    = json_encode($data['type_id']);
            $data['project_id'] = json_encode($data['project_id']);
            $data['status']     = true;
            $data['created_by'] = $user->id;
            $data['file_id']    = 0;

            if ($request->file()) {
                if ($flag == "upload") {
                    $upload = new ApkUpload();
                    $result = $upload->process($request->file);
                    $data['label']                = $result['label'];
                    $data['package_name']         = $result['package_name'];
                    $data['package_version_name'] = $result['package_version_name'];
                    $data['package_version_code'] = $result['package_version_code'];
                    $data['sdk_version']          = $result['sdk_version'];
                    $data['icon']                 = $result['icon'];
                    $data['path']                 = $result['path'];
                    $data['file_id']              = $result['id'];
                    $data['local']                = true;
                } else {
                    $upload = new ImageUpload();
                    $result = $upload->process($request->file2);
                    $data['file_id'] = $result->id;
                    $data['local']   = false;
                }
            }
            $mac_addresses = trim($data['mac_addresses']);
            $macaddresses  = explode("\r\n", $mac_addresses);
            $mac_array = array();
            foreach ($macaddresses as $macaddress) {
                $mac = strtoupper(str_replace(':', '', $macaddress));
                array_push($mac_array, $mac);
            }
            if (count($mac_array) > 0) {
               $data['mac_addresses'] = json_encode($mac_array);
            } else {
               $data['mac_addresses'] = null;
            }
            ApkProgram::create($data);
        }
        return redirect()->route('apkprograms.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ApkProgram  $apkProgram
     * @return \Illuminate\Http\Response
     */
    public function show(ApkProgram $apkprogram)
    {
        $user = auth()->user();
        if ($user->canRead(Content::ApkManager)) {
            return view('apkprograms.show', compact('apkprogram'));
        }
        return redirect()->route('apkprograms.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ApkProgram  $apkProgram
     * @return \Illuminate\Http\Response
     */
    public function edit(ApkProgram $apkprogram)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::ApkManager)) {
            $catagories = ApkCatagory::where('status', true)->get();
            $projects = Project::where('status', true)->get();
            $types = ProductType::where('status', true)->get();
            return view('apkprograms.edit', compact('apkprogram'))
                   ->with(compact('catagories'))
                   ->with(compact('projects'))
                   ->with(compact('types'));
        }
        return redirect()->route('apkprograms.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ApkProgram  $apkProgram
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApkProgram $apkprogram)
    {
        $user = auth()->user();
        $data = $request->all();
        if ($user->canUpdate(Content::ApkManager)) {
            //$data['type_id'] = json_encode($data['type_id']);
            //$data['project_id'] = json_encode($data['project_id']);
            $mac_addresses = trim($data['mac_addresses']);
            $macaddresses  = explode("\r\n", $mac_addresses);
            $mac_array = array();
            foreach ($macaddresses as $macaddress) {
                $mac = strtoupper(str_replace(':', '', $macaddress));
                array_push($mac_array, $mac);
            }
            if (count($mac_array) > 0) {
               $data['mac_addresses'] = json_encode($mac_array);
            } else {
               $data['mac_addresses'] = null;
            }
            $apkprogram->update($data);
        }
        return redirect()->route('apkprograms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApkProgram  $apkProgram
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApkProgram $apkprogram)
    {

        $user = auth()->user();
        if ($user->canDelete(Content::ApkManager)) {
            $apkprogram->delete();
        } else if ($user->canDisable(Content::ApkManager)) {
            $apkprogram->status = false;
            $apkprogram->save();
        }
        return redirect()->route('apkprograms.index');
    }

}
