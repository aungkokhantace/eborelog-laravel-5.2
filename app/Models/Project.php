<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $table = 'projects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'project_id',
        'name',
        'client_name',
        'contract_number',
        'is_soil_investigation',
        'is_instrumentation',
        'location',
        'location_plan',
        'has_wo',
        'number_of_bh',
        'project_start_date',
        'project_completion_date',
        'notes',
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

    public function wo()
    {
        return $this->hasMany('App\Models\WO');
    }
}
