<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTerminationInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('termination_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bore_hole_id');
            $table->double('hole_depth');
            $table->double('rock_depth');
            $table->date('termination_date');
            $table->time('termination_time');
            $table->longText('comments');
            $table->string('backfill_method');
            $table->date('backfill_date');
            $table->time('backfill_time');

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
        Schema::drop('termination_info');
    }
}
