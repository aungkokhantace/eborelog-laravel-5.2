<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStratigraphyRockLayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stratigraphy_rock_layer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bore_hole_id');
            $table->string('sample_id');
            $table->string('sample_name');
            $table->string('type');
            $table->string('type_short_form');
            $table->double('previous_bottom_depth');
            $table->double('depth');
            $table->double('bottom_depth');
            $table->string('color_from_1');
            $table->string('color_from_2');
            $table->string('color_from_3');
            $table->string('color_joint');
            $table->string('color_to_1');
            $table->string('color_to_2');
            $table->string('color_to_3');
            $table->string('rock_type_from');
            $table->string('rock_type_to');
            $table->string('weathering_from');
            $table->string('weathering_to');
            $table->string('strength_from');
            $table->string('strength_to');
            $table->string('grain_size_from');
            $table->string('grain_size_to');
            $table->string('structure_thickness_from');
            $table->string('structure_thickness_to');
            $table->string('fracture_spacing_from');
            $table->string('fracture_spacing_to');
            $table->string('bedding_angle_from');
            $table->string('bedding_angle_to');
            $table->string('straining');
            $table->longText('comments');
            $table->string('line_type');
            $table->string('graphic');

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
        Schema::drop('stratigraphy_rock_layer');
    }
}
