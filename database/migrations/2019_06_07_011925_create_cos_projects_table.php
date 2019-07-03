<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCosProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cos_projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('character_name');
            $table->string('serie_name');
            $table->string('image_project')->nullable(true);
            $table->dateTime('starting_date')->nullable(true);
            $table->dateTime('due_date')->nullable(true);
            $table->integer('estimated_budget')->nullable(true);
            $table->boolean('is_planned')->default(false);
            $table->boolean('is_processing')->default(true);
            $table->boolean('is_private')->default(true);
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cos_projects');
    }
}
