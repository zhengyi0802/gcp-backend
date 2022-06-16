<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_id',
        'project_id',
        'serial',
        'logo_url',
        'link_url',
        'intervals',
        'status',
        'created_by',
    ];

    public function uploadfile()
    {
        return $this->belongsTo(UploadFile::class, 'file_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
