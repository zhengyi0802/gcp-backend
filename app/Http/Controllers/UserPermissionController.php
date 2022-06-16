<?php

namespace App\Http\Controllers;

use App\Models\UserPermission;
use App\Models\User;
use App\Enums\Content;
use App\Enums\Permission;
use App\Enums\UserRole;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suser = auth()->user();

        if ($suser->canRead(Content::User)) {
            if ($suser->role == UserRole::Administrator ||
                $suser->role == UserRole::Developer) {
                $users = User::get();
            } else if ($suser->role == UserRole::MainManager) {
                $users = User::where('created_by', '>', 5)->get();
            } else if ($suser->role >= UserRole::Manager) {
                $users = User::where('created_by', $suser->id)->get();
            }
            return view('permissions.index', compact('users'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserPermission  $userPermission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $permissions = $user->permissions;
        return view('permissions.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserPermission  $userPermission
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPermission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserPermission  $userPermission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserPermission $permission)
    {
        $data = $request->all();
        $data['permission'] = 0;
        if (isset($data['perm_read'])) {
            $data['permission'] = $data['permission'] | Permission::Read;
        }
        if (isset($data['perm_create'])) {
            $data['permission'] = $data['permission'] | Permission::Create;
        }
        if (isset($data['perm_update'])) {
            $data['permission'] = $data['permission'] | Permission::Update;
        }
        if (isset($data['perm_disable'])) {
            $data['permission'] = $data['permission'] | Permission::Disable;
        }
        if (isset($data['perm_Audit'])) {
            $data['permission'] = $data['permission'] | Permission::Audit;
        }
        $permission->update($data);
        $user = $permission->user;
        return redirect()->route('permissions.show', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPermission  $userPermission
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
