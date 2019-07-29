<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldTestVaneShearTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_test_vane_shear', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('previous_sample_id');
            $table->bigInteger('bore_hole_id');
            $table->string('sample_id');
            $table->string('sample_name');
            $table->double('depth');
            $table->double('bottom_depth');
            $table->string('type');
            $table->string('type_short_form');
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
        Schema::drop('field_test_vane_shear');
    }
}
