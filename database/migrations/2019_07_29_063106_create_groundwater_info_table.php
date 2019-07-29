<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroundwaterInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groundwater_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bore_hole_id');
            $table->string('type');
            $table->string('type_short_form');
            $table->double('water_depth');
            $table->date('date');
            $table->time('time');
            $table->longText('notes')->nullable();
            $table->double('casing_depth');
            $table->double('cave_in_depth');
            $table->double('hole_depth');

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
        Schema::drop('groundwater_info');
    }
}
