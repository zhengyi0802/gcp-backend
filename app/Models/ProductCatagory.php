<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCatagory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function producttypes()
    {
        return $this->hasMany(ProductType::class, 'catagory_id');
    }

    public function childs()
    {
        $result = $this->producttypes;
        return $result;
    }
}
