<?php

namespace App\Core;

class FormatGenerator
{

    //create notification params.
    public static function message($title, $body)
    {
        return ['title' => $title, 'body' => $body];
    }
}
