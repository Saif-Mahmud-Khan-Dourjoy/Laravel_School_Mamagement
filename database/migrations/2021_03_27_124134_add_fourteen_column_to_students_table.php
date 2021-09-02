<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFourteenColumnToStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('name_bangla')->after('name');
            $table->string('fathers_name_bangla')->after('fathers_name');
            $table->string('mothers_name_bangla')->after('mothers_name');
            $table->string('local_guardian_name')->nullable();
            $table->string('local_guardian_address')->nullable();
            $table->string('student_guardian_relationship')->nullable();
            $table->string('birth_certificate_number')->after('Birth_place');
            $table->string('local_guardian_cell')->nullable()->after('fathers_cell');
            $table->string('previous_school_name');
            $table->string('previous_school_address');
            $table->string('admission_class');
            $table->string('admission_department')->nullable();
            $table->string('admission_type');
            $table->string('added_by')->after('status');
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
            $table->dropColumn('added_by');
            $table->dropColumn('admission_type');
            $table->dropColumn('admission_department');
            $table->dropColumn('admission_class');
            $table->dropColumn('previous_school_address');
            $table->dropColumn('previous_school_name');
            $table->dropColumn('local_guardian_cell');
            $table->dropColumn('birth_certificate_number');
            $table->dropColumn('student_guardian_relationship');
            $table->dropColumn('local_guardian_address');
            $table->dropColumn('local_guardian_name');
            $table->dropColumn('mothers_name_bangla');
            $table->dropColumn('fathers_name_bangla');
            $table->dropColumn('name_bangla');

        });
    }
}
