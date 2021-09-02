<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddModulePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permissions', function (Blueprint $table) {
           $table->dropForeign(['parent_id']);
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->unsignedInteger('parent_id')->nullable()->change();
            $table->foreign('parent_id')->references('id')->on('permissions'); 
            $table->string('modual');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
        });
        Schema::table('permissions', function (Blueprint $table) {
            $table->unsignedInteger('parent_id')->change();
            $table->foreign('parent_id')->references('id')->on('permissions'); 
            $table->dropColumn('modual');
        });
    }
}
