<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Content;

class MainVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'type',
        'playlist',
        'playlist_http',
        'description',
        'status',
        'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function playlists()
    {
        $str = $this->playlist;
        $array = json_decode($str);
        $result = implode(PHP_EOL, $array);

        return $result;
    }

    public function firstvideo()
    {
        $str = $this->playlist;
        $arr = json_decode($str);
        return $arr[0];
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
