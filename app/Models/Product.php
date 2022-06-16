<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'serialno',
        'ether_mac',
        'wifi_mac',
        'project_id',
        'expire_date',
        'status_id',
        'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function type()
    {
        return $this->belongsTo(ProductType::class, 'type_id');
    }

    public function project()
    {
         return $this->belongsTo(Project::class, 'project_id');
    }

    public function status()
    {
        return $this->belongsTo(ProductStatus::class, 'status_id');
    }

    public function ether()
    {
        return str_replace(':', '', $this->ether_mac);
    }

    public function wifi()
    {
        return str_replace(':', '', $this->wifi_mac);
    }

    public function records()
    {
        return $this->hasMany(ProductRecord::class, 'product_id');
    }

    public function logmessages()
    {
        return $this->hasMany(LogMessage::class, 'product_id');
    }

}
