<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpectedCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expected_collections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fiscal_year_id')->unsigned();
            $table->integer('business_month_id')->unsigned();
            $table->decimal('amount', 8, 2);
            $table->unique(['fiscal_year_id','business_month_id']);
            $table->foreign('fiscal_year_id')->references('id')->on('fiscal_years')->onDelete('cascade');
            $table->foreign('business_month_id')->references('id')->on('business_months')->onDelete('cascade');
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
        // Schema::table('training_types', function (Blueprint $table) {
        //     $table->dropUnique('expected_collections_fiscal_year_id_business_month_id_unique');
        //     $table->dropForeign('business_months_business_month_id_foreign');
        // });
        Schema::dropIfExists('expected_collections');
    }
}
