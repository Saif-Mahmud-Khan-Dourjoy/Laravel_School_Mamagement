<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('birth_place')->after('date_of_birth');
        });

        $birth_places = DB::table('students')->select('id','birth_place')->get();
        foreach ($birth_places as $birth_place){
            DB::table('students')
                ->where('id', $birth_place->id)
                ->update([
                    "birth_place" => "Bangladesh"
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
           $table->dropColumn('birth_place');
        });
    }
}
