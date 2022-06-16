<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppManager extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'apk_id',
        'market_id',
        'installer_flag',
        'delaytime',
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
