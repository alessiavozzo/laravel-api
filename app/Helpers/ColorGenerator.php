<?php

namespace App\Helpers;

class ColorGenerator{
    public static function randomColor(){
        /* return '#' . dechex(rand(0, 10000000)); */
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
}