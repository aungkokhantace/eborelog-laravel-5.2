<?php

/**
 * Author: Aung Ko Khant
 * Date: 2019-07-30
 * Time: 04:46 PM
 */


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Config extends Model
{
    use SoftDeletes;

    protected $table = 'config';

    protected $fillable = [
        'code',
        'type',
        'value',
        'description'

    ];
}
