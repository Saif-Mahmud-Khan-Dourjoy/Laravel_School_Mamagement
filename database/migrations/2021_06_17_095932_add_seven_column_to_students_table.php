<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSevenColumnToStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('father_profession')->nullable();
            $table->string('mother_profession')->nullable();
            $table->string('previous_school_class')->nullable();
            $table->string('previous_school_testimonial_number')->nullable();
            $table->string('previous_school_testimonial_date')->nullable();
            $table->string('tc_number')->nullable();
            $table->string('tc_date')->nullable();
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
            
             $table->dropColumn('father_profession');
             $table->dropColumn('mother_profession');
             $table->dropColumn('previous_school_class');
             $table->dropColumn('previous_school_testimonial_number');
             $table->dropColumn('previous_school_testimonial_date');
             $table->dropColumn('tc_number');
             $table->dropColumn('tc_date');
            
        });
    }
}
