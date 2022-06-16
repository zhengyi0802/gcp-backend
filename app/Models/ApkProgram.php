<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApkProgram extends Model
{
    use HasFactory;

    protected $fillable = [
         'file_id',
         'catagory_id',
         'launcher_id',
         'keywords',
         'label',
         'package_name',
         'package_version_name',
         'package_version_code',
         'sdk_version',
         'icon',
         'path',
         'description',
         'local',
         'status',
         'created_by',
         'type_id',
         'project_id',
         'mac_addresses',
    ];

    public function catagory()
    {
        return $this->belongsTo(ApkCatagory::class, 'catagory_id');
    }

    public function uploadfile()
    {
        return $this->belongsTo(UploadFile::class, 'file_id');
    }

    public function types()
    {
        $types = json_decode($this->type_id);
        $producttypes = ProductType::whereIn('id', $types)->get();
        return $producttypes;
    }

    public function projects()
    {
        $pids = json_decode($this->project_id);
        $projects = Project::whereIn('id', $pids)->get();
        return $projects;
    }

    public function macAddresses()
    {
        return json_decode($this->mac_addresses);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
