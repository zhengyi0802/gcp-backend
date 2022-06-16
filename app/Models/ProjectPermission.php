<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Permission;

class ProjectPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_id',
        'permission',
        'description',
        'status',
        'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function canRead()
    {
        return ($this->permission & Permission::Read);
    }

    public function canCreate()
    {
         return ($this->permission & Permission::Create);
    }

    public function canUpdate()
    {
         return ($this->permission & Permission::Update);
    }

    public function canDisable()
    {
         return ($this->permission & Permission::Disable);
    }

    public function canDelete()
    {
         return ($this->permission & Permission::Delete);
    }

    public function canAudit()
    {
         return ($this->permission & Permission::Audit);
    }

    public function canCopy()
    {
         return ($this->permission & Permission::Copy);
    }

}
