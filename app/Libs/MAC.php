<?php

namespace App\Libs;

class MAC {

    public function __construct() {}

    public static function tostr($mac)
    {
        return strtoupper(str_replace(':', '', $mac));
    }

    public static function fromstr($str)
    {
        return implode(':', str_split($this->tostr($str), 2)));
    }

}
