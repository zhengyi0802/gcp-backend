<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company',
        'job',
        'contacts',
        'description',
        'status',
        'created_by',
    ];

    public function user()
    {
         return $this->belongsTo(User::class, 'user_id');
    }

    public function creator()
    {
         return $this->belongsTo(User::class, 'created_by');
    }
/*
    public functioin permissions()
    {
         return $this->hasManyThrough(UserPermission::class, User::class, 'user_id', 'user_id');
    }
*/

}
