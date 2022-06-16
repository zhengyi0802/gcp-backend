<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\UserRole;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'created_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function creator()
    {
         return $this->belongsTo(User::class, 'created_by');
    }
/*
    public function created()
    {
         return $this->hasMany(User::class, 'created_by');
    }
*/
    public function profile()
    {
         return $this->hasOne(UserProfile::class, 'user_id');
    }

    public function permissions()
    {
         return $this->hasMany(UserPermission::class, 'user_id');
    }

    public function permission($content)
    {
         $result = $thid->permissions->where('content_id', $content)->last();
         return $result->permission;
    }

    public function canRead($content)
    {
         if ($this->role < UserRole::MainManager) {
             return true;
         }
         $result = $this->permissions->where('content_id', $content)->last();
         return ($result) ? $result->canRead() : false;
    }

    public function canCreate($content)
    {
         if ($this->role < UserRole::MainManager) {
             return true;
         }
         $result = $this->permissions->where('content_id', $content)->last();
         return ($result) ? $result->canCreate() : false;
    }

    public function canUpdate($content)
    {
         if ($this->role < UserRole::MainManager) {
             return true;
         }
         $result = $this->permissions->where('content_id', $content)->last();
         return ($result) ? $result->canUpdate() : false;
    }

    public function canDisable($content)
    {
         if ($this->role < UserRole::MainManager) {
             return true;
         }
         $result = $this->permissions->where('content_id', $content)->last();
         return ($result) ? $result->canDisable() : false;
    }

    public function canDelete($content)
    {
         if ($this->role < UserRole::MainManager) {
             return true;
         }
         $result = $this->permissions->where('content_id', $content)->last();
         return ($result) ? $result->canDelete() : false;
    }

    public function canAudit($content)
    {
         if ($this->role < UserRole::MainManager) {
             return true;
         }
         $result = $this->permissions->where('content_id', $content)->last();
         return ($result) ? $result->canAudit() : false;
    }

    public function projects()
    {
        $projects = null;
        if ($this->role <= UserRole::Developer) {
            $projects = Project::get();
        } else if ($this->role == UserRole::MainManager) {
            $projects = Project::where('status', true)->get();
        } else {
            $data = $this->hasMany(ProjectPermission::class, 'user_id')->pluck('project_id');
            if ($data != null) {
                $arr = $data->toArray();
                $projects = Project::where('status', true)->whereIn('id', $arr)->get();
            }
        }
        return $projects;
    }

}
