<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('project_id');
            $table->string('name');
            $table->string('client_name');
            $table->string('contract_number');
            $table->tinyInteger('is_soil_investigation');
            $table->tinyInteger('is_instrumentation');
            $table->longText('notes')->nullable();
            $table->date('project_start_date');
            $table->date('project_completion_date')->nullable();
            $table->tinyInteger('has_wo')->detault(0);
            $table->integer('number_of_bh')->default(0);
            $table->string('location');
            $table->string('location_plan')->nullable();

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
        Schema::drop('projects');
    }
}
