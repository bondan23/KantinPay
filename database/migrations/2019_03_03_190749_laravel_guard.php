<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LaravelGuard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function(Blueprint $table){
            $table->increments('id');
            $table->string("tag", 20);
            $table->string("name", 100);
        });

        Schema::create('permissions', function(Blueprint $table){
            $table->increments('id');
            $table->string("tag", 50);
            $table->string("name", 50);
            $table->string("description");
        });

        Schema::create('permission_role', function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('permission_id');

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        });

        Schema::table('users', function(Blueprint $table){
            $table->unsignedInteger('role_id');

            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('users', function(Blueprint $table){
        //     $table->dropForeign('users_role_id_foreign');

        //     $table->dropColumn('role_id');
        // });

        // Schema::dropIfExists('permission_role');
        // Schema::dropIfExists('roles');
        // Schema::dropIfExists('permissions');
    }
}
