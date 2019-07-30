<?php

/**
 * Author: Aung Ko Khant
 * Date: 2019-07-30
 * Time: 04:46 PM
 */


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'config';

    protected $fillable = [
        'code',
        'type',
        'value',
        'description'

    ];
}
