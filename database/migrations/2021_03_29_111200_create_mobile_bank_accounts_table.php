<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobileBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id')->unsigned();
            $table->string('mobile_account_holder_name');
            $table->string('mobile_bank_name');
            $table->string('mobile_account_number');
            $table->string('mobile_account_type');
            $table->string('mobile_routing_number')->nullable();
            $table->string('mobile_comment')->nullable();
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
        Schema::dropIfExists('mobile_bank_accounts');
    }
}
