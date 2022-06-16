<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marquee extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'project_id',
        'product_id',
        'prev_id',
        'name',
        'content',
        'url',
        'status',
        'created_by',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function previous()
    {
        return $this->belongsTo(Marquee::class, 'prev_id');
    }

    public function next()
    {
        return $this->hasOne(Marquee::class, 'prev_id');
    }

}
