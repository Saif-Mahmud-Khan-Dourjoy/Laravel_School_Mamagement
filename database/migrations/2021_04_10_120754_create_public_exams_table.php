<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_exams', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->unsigned();
            $table->string('exam_name');
            $table->integer('year');
            $table->string('roll_no')->nullable();
            $table->string('reg_no')->nullable();
            $table->string('board')->nullable();
            $table->string('department')->nullable();
            $table->string('result')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('public_exams');
    }
}
