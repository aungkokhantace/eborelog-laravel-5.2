<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRockSampleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rock_sample', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('previous_sample_id');
            $table->bigInteger('bore_hole_id');
            $table->string('sample_name');
            $table->double('depth');
            $table->double('bottom_depth');
            $table->string('core_number');
            $table->integer('tcr');
            $table->integer('scr');
            $table->integer('rqd');
            $table->integer('fi');
            $table->string('weathering_grade');
            $table->string('photo')->nullable();

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
        Schema::drop('rock_sample');
    }
}
