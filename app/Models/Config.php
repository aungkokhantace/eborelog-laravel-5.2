<?php


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
