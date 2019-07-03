<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCosProjectPurchasedElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cos_project_purchased_elements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cost')->default(0);
            $table->boolean('is_ready')->default(false);
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
        Schema::dropIfExists('cos_project_purchased_elements');
    }
}
