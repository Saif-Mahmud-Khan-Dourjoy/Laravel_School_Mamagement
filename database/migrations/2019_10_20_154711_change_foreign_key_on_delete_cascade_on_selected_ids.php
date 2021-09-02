<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeForeignKeyOnDeleteCascadeOnSelectedIds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('selected_ids', function (Blueprint $table) {
        $table->dropForeign('selected_ids_term_result_id_foreign');
        $table->foreign('term_result_id')
            ->references('id')->on('term_results')
            ->onDelete('cascade')
            ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign('term_result_id');
    }
}
