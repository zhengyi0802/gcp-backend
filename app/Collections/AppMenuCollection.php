<?php

namespace App\Collections;

use Illuminate\Support\Collection;
use App\Models\Project;
use App\Models\AppMenu;
use App\Models\ApkProgram;

class AppMenuCollection {

    public Collection $data;
    public array      $array;
    public array      $result;

    function __construct($appmenus)
    {
         $arr = array();
         $result = array();
         foreach ($appmenus as $appmenu) {
            $arr[$appmenu->position] = $appmenu;
            $result[$appmenu->position] = array(
                'position'  => $appmenu->position,
                'name'      => $appmenu->apk->program_name,
                'thumbnail' => $appmenu->apk->icon,
                'url'       => $appmenu->apk->url,
            );
         }
         $this->data = collect($arr);
         $this->array = $arr;
         $this->result = $result;
    }

}
