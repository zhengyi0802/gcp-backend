<?php

namespace App\Uploads;

class VideoUpload extends Upload
{
    //protected UploadFile $result;

    public function __construct($subpath)
    {
        $param = array(
                 'path'    => 'videos',
                 'subpath' => $subpath,
                 'type'    => 'video',
               );
        parent::__construct($param);
    }

    public function process($video)
    {
        $result = parent::storage($video);

        return $result;
    }

}

