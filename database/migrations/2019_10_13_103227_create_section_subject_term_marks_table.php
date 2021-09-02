<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionSubjectTermMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_subject_term_marks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('section_subject_teacher_id');
            $table->unsignedInteger('term_id');
            $table->integer('total_mark');
            $table->integer('pass_mark');
            $table->integer('wt_mark');
            $table->integer('ht_mark');
            $table->integer('wt_convert_in');
            $table->integer('ht_convert_in');
            $table->foreign('section_subject_teacher_id')->references('id')->on('section_subject_teachers')->onDelete('cascade');
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
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
        Schema::dropIfExists('section_subject_term_marks');
    }
}
