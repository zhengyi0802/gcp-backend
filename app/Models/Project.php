<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Content;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company',
        'description',
        'status',
        'start_time',
        'stop_time',
        'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function mainvideo()
    {
        return $this->hasMany(MainVideo::class, 'project_id')->latest()->first();
    }

    public function appadvertisings()
    {
        return $this->hasMany(AppAdvertising::class, 'project_id');
    }

    public function mediacatagories()
    {
        return $this->hasMany(MediaCatagory::class, 'project_id');
    }
}
