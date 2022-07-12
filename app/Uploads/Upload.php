<?php

namespace App\Uploads;

use App\Models\UploadFile;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Upload
{
    protected string $path;
    protected ?string $subpath;
    protected string $type;

    public function __construct($param)
    {
        $this->path      = $param['path'];
        $this->subpath   = $param['subpath'];
        $this->type      = $param['type'];
    }

    public function storage($content, $ftp_enabled = true)
    {
        $filename = $content->getClientOriginalName();
        $storename = date('Y-m-d-H-i-s-').$content->getClientOriginalName();

        $extension = $content->getClientOriginalExtension();
        $mimetype  = $content->getMimeType();
        $size      = $content->getSize();
        if ($ftp_enabled) {
            $fullpath = $this->path.'/'.$this->subpath.'/'.$storename;
            $pathname = Storage::disk('media')->put($fullpath, fopen($content, 'r+'));
            //$pathname  = $content->storeAs($this->subpath, $storename, $this->path);
            $url      = env('FTP_URL').'/'.$fullpath;
        } else {
            $pathname  = $content->storeAs($this->subpath, $storename, $this->path);
            $url = env('APP_URL').'/'.$this->path.'/'.$this->subpath.'/'.$storename;
        }
        $user = auth()->user();
        $data = array(
            'created_by'     => $user->id,
            'type'           => $this->type,
            'subpath'        => $this->subpath,
            'filename'       => $filename,
            'storename'      => $storename,
            'size'           => $size,
            'mime_type'      => $mimetype,
            'extension'      => $extension,
            'path'           => $pathname,
            'url'            => $url,
            'status'         => true,
        );

        $result = UploadFile::create($data);

        return $result;
    }
}

