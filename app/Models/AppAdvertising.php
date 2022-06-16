<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Content;

class AppAdvertising extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'file_id',
        'interval',
        'thumbnail',
        'link_url',
        'status',
        'audit',
        'audit_by',
        'audit_time',
        'created_by',
    ];

    public function auditor()
    {
        return $this->belongsTo(User::class, 'audit_by');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
