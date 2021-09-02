<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddThreeColumnToStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('blood_group')->nullable();
            $table->string('scholarship')->nullable();
            $table->string('father_nid_num')->nullable()->after('fathers_name_bangla');
            $table->string('mother_nid_num')->nullable()->after('mothers_name_bangla');
            $table->string('gvt_unique_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
             $table->dropColumn('gvt_unique_id');
             $table->dropColumn('mother_nid_num');
             $table->dropColumn('father_nid_num');
             $table->dropColumn('scholarship');
             $table->dropColumn('blood_group');
        });
    }
}
