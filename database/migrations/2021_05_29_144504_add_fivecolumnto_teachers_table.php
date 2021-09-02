<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFivecolumntoTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('subject')->nullable()->after('status');
            $table->date('joining_date')->nullable()->after('status');
            $table->string('nid_number')->nullable()->after('status');
            $table->string('blood_group')->nullable()->after('status');
            $table->string('comment')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropColumn('comment');
            $table->dropColumn('blood_group');
            $table->dropColumn('nid_number');
            $table->dropColumn('joining_date');
            $table->dropColumn('subject');
        });
    }
}
