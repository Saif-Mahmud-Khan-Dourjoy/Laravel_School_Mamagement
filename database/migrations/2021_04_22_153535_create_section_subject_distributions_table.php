<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionSubjectDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_subject_distributions', function (Blueprint $table) {
            $table->id();
            $table->integer('section_subject_teacher_id')->unsigned();
            $table->decimal('written_total');
            $table->string('written_permission');
            $table->decimal('mcq_total');
            $table->string('mcq_permission');
            $table->decimal('pactical_total');
            $table->string('pactical_permission');
            $table->foreign('section_subject_teacher_id')->references('id')->on('section_subject_teachers')->onDelete('cascade');
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
        Schema::dropIfExists('section_subject_distributions');
    }
}
