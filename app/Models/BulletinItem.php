<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulletinItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_id',
        'bulletin_id',
        'mime_type',
        'url',
        'url_http',
        'status',
        'created_by',
    ];

    public function uploadfile()
    {
        return $this->belongsTo(UploadFile::class, 'file_id');
    }

    public function bulletin()
    {
        return $this->belongsTo(Bulletin::class, 'bulletin_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
