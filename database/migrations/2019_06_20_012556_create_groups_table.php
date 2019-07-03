<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('group_code')->unique();
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id', 'fk_owner_id')->references('id')->on('users');
        });

        Schema::create('users_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'fk_user_groups_id')->references('id')->on('users');
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id', 'fk_users_groups_group_id')->references('id')->on('groups');
        });

        Schema::create('cos_projects_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id', 'fk_group_id')->references('id')->on('groups');
            $table->unsignedBigInteger('cos_project_id');
            $table->foreign('cos_project_id', 'fk_cos_project_group_id')->references('id')->on('cos_projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cos_projects_groups');
        Schema::dropIfExists('users_groups');
        Schema::dropIfExists('groups');
    }
}
