<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QACatagory extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'name',
        'description',
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

    public function lists()
    {
        return $this->hasMany(QAList::class, 'catagory_id');
    }

}
