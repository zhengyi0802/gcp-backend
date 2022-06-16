<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaCatagory extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_id',
        'menu_id',
        'project_id',
        'parent_id',
        'type',
        'name',
        'keywords',
        'description',
        'thumbnail',
        'status',
        'audit',
        'audit_by',
        'audit_time',
        'created_by',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function auditor()
    {
        return $this->belongsTo(User::class, 'audit_by');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function contents()
    {
        return $this->hasMany(MediaContent::class, 'catagory_id');
    }

    public function subdir()
    {
        return $this->hasMany(MediaCatagory::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(MediaCatagory::class, 'parent_id');
    }

}
