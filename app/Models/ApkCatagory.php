<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApkCatagory extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'name',
        'description',
        'status',
        'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function parent()
    {
        return $this->belongsTo(ApkCatagory::class, 'parent_id');
    }

    public function childs()
    {
        return $this->hasMany(ApkCatagory::class, 'parent_id', 'id');
    }

    public function apks()
    {
        return $this->hasMany(ApkProgram::class, 'catagory_id');
    }
}
