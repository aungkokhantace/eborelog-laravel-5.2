<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoilSampleSptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soil_sample_spt', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('previous_sample_id');
            $table->bigInteger('bore_hole_id');
            $table->string('sample_id');
            $table->string('sample_name');
            $table->double('depth');
            $table->string('type');
            $table->string('type_short_form');
            $table->integer('blow_1st');
            $table->integer('blow_2nd');
            $table->integer('blow_3rd');
            $table->integer('blow_4th');
            $table->integer('blow_5th');
            $table->integer('blow_6th');
            $table->double('penetration_1st');
            $table->double('penetration_2nd');
            $table->double('penetration_3rd');
            $table->double('penetration_4th');
            $table->double('penetration_5th');
            $table->double('penetration_6th');
            $table->double('n_value');
            $table->integer('recovery_length');
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
        Schema::drop('soil_sample_spt');
    }
}
