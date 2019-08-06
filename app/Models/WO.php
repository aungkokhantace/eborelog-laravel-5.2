<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WO extends Model
{
    use SoftDeletes;

    protected $table = 'project_wo';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'project_id', 'wo_number', 'number_of_bh', 'location', 'location_plan', 'wo_start_date', 'wo_completion_date',
        'created_by', 'updated_by', 'deleted_by',
        'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];


    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id', 'id');
    }
}
