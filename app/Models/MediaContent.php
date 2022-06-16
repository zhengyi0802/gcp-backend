<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'pfile_id',
        'cfile_id',
        'catagory_id',
        'name',
        'description',
        'preview',
        'mime_type',
        'url',
        'url_http',
        'status',
        'audit',
        'audit_by',
        'audit_time',
        'created_by',
    ];

    public function pfile()
    {
        return $this->belongsTo(UploadFile::class, 'pfile_id');
    }

    public function cfile()
    {
        return $this->belongsTo(UploadFile::class, 'cfile_id');
    }

    public function catagory()
    {
        return $this->belongsTo(MediaCatagory::class, 'catagory_id');
    }

    public function auditor()
    {
        return $this->belongsTo(User::class, 'audit_by');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
