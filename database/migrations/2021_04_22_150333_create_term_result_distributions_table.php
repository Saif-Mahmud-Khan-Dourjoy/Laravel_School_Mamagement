<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermResultDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_result_distributions', function (Blueprint $table) {
            $table->id();
            $table->integer('term_result_id')->unsigned();
            $table->decimal('written_mark');
            $table->decimal('mcq_mark');
            $table->decimal('pactical_mark');
            $table->foreign('term_result_id')->references('id')->on('term_results')->onDelete('cascade');
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
        Schema::dropIfExists('term_result_distributions');
    }
}
