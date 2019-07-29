<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoreHolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bore_holes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('project_id');
            $table->bigInteger('project_wo_id');
            $table->string('hole_id');
            $table->bigInteger('driller_id');
            $table->bigInteger('supervisor_id');
            $table->bigInteger('casing_id');
            $table->double('diameter');
            $table->string('orientation');
            $table->date('start_date');
            $table->time('start_time');
            $table->longText('general_remark');
            $table->longText('location_description');
            $table->string('north');
            $table->string('east');
            $table->string('elevation');
            $table->string('offset');
            $table->bigInteger('drilling_company_id');
            $table->bigInteger('drilling_rig_id');
            $table->bigInteger('drilling_method_id');
            $table->bigInteger('spt_method_id');
            $table->string('spt_hammer_number');
            $table->bigInteger('coring_method_id');
            $table->bigInteger('drilling_fluid_id');
            $table->tinyInteger('is_terminated');

            $table->integer('created_by')->default(1);
            $table->integer('updated_by')->default(1);
            $table->integer('deleted_by')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bore_holes');
    }
}
