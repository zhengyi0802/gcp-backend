<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    protected $fillable = [
        'catagory_id',
        'name',
        'description',
        'status',
        'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function catagory()
    {
        return $this->belongsTo(ProductCatagory::class, 'catagory_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'type_id');
    }

    public function childs()
    {
        return array();
    }
}
