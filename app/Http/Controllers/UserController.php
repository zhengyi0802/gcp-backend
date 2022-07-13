<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserPermission;
use App\Models\Project;
use App\Models\ProjectPermission;
use App\Enums\UserRole;
use App\Enums\Content;
use App\Enums\Permission;

class UserController extends Controller
{

    public function index()
    {
        $suser = auth()->user();

        if ($suser->canRead(Content::User)) {
            if ($suser->role == UserRole::Administrator ||
                $suser->role == UserRole::Developer) {
                $users = User::orderBy('id', 'DESC')->get();;
            } else if ($suser->role == UserRole::MainManager) {
                $users = User::where('created_by', '>', 5)->get();
            } else if ($suser->role >= UserRole::Manager) {
                $users = User::where('created_by', $suser->id)->get();
            }
            return view('users.index', compact('users'));
        }
        return redirect()->route('home');
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $suser = auth()->user();
        $data = $request->all();
        if ($suser->canCreate(Content::User)) {
            $data['created_by'] = $suser->id;
            $data['password'] = bcrypt($data['new-password']);
            $data['status'] = true;
            $user = User::create($data);
            $data['user_id'] = $user->id;
            UserProfile::create($data);
        }
        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        $suser = auth()->user();
        if ($suser->canRead(Content::User)) {
            return view('users.show', compact('user'));
        }
        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        $suser = auth()->user();
        if ($suser->canUpdate(Content::User)) {
            return view('users.edit', compact('user'));
        }
        return redirect()->route('users.index');
    }

    public function update(Request $request, User $user)
    {
        $suser = auth()->user();
        $data = $request->all();
        if ($suser->canUpdate(Content::User)) {
            if ($data['new-password'] != null) {
                $data['password'] = bcrypt($data['new-password']);
            }
            $user->update($data);
            $user->profile->update($data);
        }
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $suser = auth()->user();
        if ($suser->canDelete(Content::User)) {
          $user->delete();
        } else if ($suser->canDisable(Content::User)) {
          $user->status = false;
          $user->save();
        }
        return redirect()->route('users.index');
    }

    public function createPermission(Request $request)
    {
        $suser = auth()->user();
        $user_id = $request->input('user_id');
        $user = User::find($user_id);
        if ($user_id > 6) {
            if ($suser->canCreate(Content::Project)) {
                $projects = Project::where('created_by', $suser->id)->get();
            } else {
                return redirect()->route('users.index');
            }
        } else {
            $projects = Project::where('status', true)->get();
        }
        return view('users.project.create', compact('projects'))
               ->with(compact('user'));
    }

    public function storePermission(Request $request)
    {
        $suser = auth()->user();
        $data = $request->all();

        $perm = ProjectPermission::where('project_id', $data['project_id'])
                                 ->where('user_id', $data['user_id'])
                                 ->first();

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

        if ($perm == null) {
            $data['created_by'] = $suser->id;
            $data['status']     = true;

            ProjectPermission::create($data);
        } else {
            $perm->update($data);
        }

        return redirect()->route('users.index');

    }

    public function editPermission(Request $request)
    {
        $suser = auth()->user();
        $project_id = $request->input('project_id');
        $user_id    = $request->input('user_id');
        if ($user_id > 6) {
          if ($suser->canUpdate(Content::Project)) {
              $permission = ProjectPermission::where('user_id', $user_id)
                                             ->where('project_id', $project_id)
                                             ->first();
              return view('users.project.edit', compact('permission'));
          }
        }
        return redirect()->route('users.index');
    }

    public function updatePermission(Request $request)
    {
        $data = $request->all();
        $data['permission'] = 0;
        $pid = $data['pid'];

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
        $permission = ProjectPermission::find($pid);
        $permission->permission = $data['permission'];
        $permission->save();
        return redirect()->route('users.index');
    }

    public function removePermission(Request $request)
    {
        $suser = auth()->user();
        $user_id = $request->input('user_id');
        $project_id = $request->input('project_id');
        if ($user_id > 6) {
            $permission = ProjectPermission::where('user_id', $user_id)
                                           ->where('project_id', $project_id)
                                           ->first();
            if ($permission != null) {
                $permission->delete();
            }
        }
        return redirect()->route('users.index');
    }
}
