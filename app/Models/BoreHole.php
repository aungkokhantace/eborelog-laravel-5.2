<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoreHole extends Model
{
    use SoftDeletes;

    protected $table = 'bore_holes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'project_id',
        'project_wo_id',
        'hole_id',
        'driller_id',
        'supervisor_id',
        'casing_id',
        'diameter',
        'orientation',
        'start_date',
        'start_time',
        'general_remark',
        'location_description',
        'north',
        'east',
        'elevation',
        'offset',
        'drilling_company_id',
        'drilling_rig_id',
        'drilling_method_id',
        'spt_method_id',
        'spt_hammer_number',
        'coring_method_id',
        'drilling_fluid_id',
        'is_terminated',
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

    // public function nationality()
    // {
    //     return $this->belongsTo('App\Models\Nationality', 'nationality_id', 'id');
    // }
}
