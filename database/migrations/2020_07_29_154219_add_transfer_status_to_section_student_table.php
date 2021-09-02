<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransferStatusToSectionStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('section_students', function (Blueprint $table) {
            $table->integer('transfer_in')->after('roll')->default(0);
            $table->integer('transfer_out')->after('transfer_in')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('section_students', function (Blueprint $table) {
            $table->dropColumn('transfer_in');
            $table->dropColumn('transfer_out');
        });
    }
}
