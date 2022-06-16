<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QAList extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_id',
        'catagory_id',
        'question',
        'type',
        'answer',
        'answer_http',
        'status',
        'audit',
        'audit_by',
        'audit_time',
        'created_by',
    ];

    public function catagory()
    {
        return $this->belongsTo(QACatagory::class, 'catagory_id');
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
