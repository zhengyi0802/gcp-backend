<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSupport extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_id',
        'project_id',
        'qrcode_type',
        'qrcode_content',
        'message',
        'apk_id',
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

    public function apk()
    {
        return $this->belongsTo(ApkProgram::class, 'apk_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
