<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoiceSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'keywords',
        'apk_id',
        'status',
        'created_by',
    ];

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
