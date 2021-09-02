<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id')->unsigned();
            $table->string('institute_name');
            $table->string('subject');
            $table->string('training_place');
            $table->date('starting_date');
            $table->date('ending_date');
            $table->string('expiration');
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
        Schema::dropIfExists('training_infos');
    }
}
