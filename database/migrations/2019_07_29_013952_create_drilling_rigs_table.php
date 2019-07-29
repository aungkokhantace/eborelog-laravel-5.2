<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrillingRigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drilling_rigs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rig_no');
            $table->string('model');
            $table->integer('year_made');
            $table->string('lm_cert_no');
            $table->string('noise_reduce_cylinder');

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
        Schema::drop('drilling_rigs');
    }
}
