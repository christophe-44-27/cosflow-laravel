<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCosProjectCreatedElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cos_project_created_elements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('hours_spent')->default(0);
            $table->integer('minutes_spent')->default(0);
            $table->integer('percentage_of_progression')->default(0);
            $table->string('element_picture')->nullable(true);
            $table->text('comment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cos_project_created_elements');
    }
}
