<?php

namespace App\Uploads;

class PictureUpload extends Upload
{

    //protected UploadFile $result;

    public function __construct($subpath)
    {
        $param = array(
                 'path'    => 'pictures',
                 'subpath' => $subpath,
                 'type'    => 'image',
               );
        parent::__construct($param);
    }

    public function process($image)
    {
        $result = parent::storage($image);

        return $result;
    }

}

