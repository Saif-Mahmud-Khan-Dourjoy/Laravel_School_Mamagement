<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScaleChangingInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scale_changing_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id')->unsigned();
            $table->string('salary_grade')->nullable();
            $table->string('present_salary_scale')->nullable();
            $table->date('first_mpo_joining_date')->nullable();
            $table->date('first_high_scale_date')->nullable();
            $table->date('second_high_scale_date')->nullable();
            $table->date('first_time_scale_date')->nullable();
            $table->date('second_time_scale_date')->nullable();
            $table->date('bed_scale_date')->nullable();
            $table->string('comment')->nullable();
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
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
        Schema::dropIfExists('scale_changing_infos');
    }
}
