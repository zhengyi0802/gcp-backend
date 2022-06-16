<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Content;

class Bulletin extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'popup',
        'title',
        'message',
        'date',
        'status',
        'created_by',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items()
    {
        return $this->hasMany(BulletinItem::class, 'bulletin_id');
    }

}
