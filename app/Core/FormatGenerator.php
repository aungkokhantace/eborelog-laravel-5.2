<?php

namespace App\Core;

/**
 * Author: Aung Ko Khant
 * Date: 2019-07-02
 * Time: 09:57 AM
 */

class FormatGenerator
{

    //create notification params.
    public static function message($title, $body)
    {
        return ['title' => $title, 'body' => $body];
    }
}
