<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCosProjectCosProjectElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cos_project_cos_project_elements', function (Blueprint $table) {
            $table->unsignedBigInteger('cos_project_id');
            $table->foreign('cos_project_id')->references('id')->on('cos_projects');
            $table->unsignedBigInteger('cos_project_element_id');
            $table->foreign('cos_project_element_id')->references('id')->on('cos_project_elements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cos_project_cos_project_elements');
    }
}
