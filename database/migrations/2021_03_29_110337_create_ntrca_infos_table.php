<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNtrcaInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ntrca_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id')->unsigned();
            $table->string('registation_no');
            $table->string('roll_no');
            $table->string('subject');
            $table->integer('passing_year')->unsigned();
            $table->date('appoiment_date');
            $table->date('joining_date');
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
        Schema::dropIfExists('ntrca_infos');
    }
}
