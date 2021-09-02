<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreateAttendancedevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('attendancedevices', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('DeviceName');
        //     $table->integer('MachineNo');
        //     $table->string('CommType');
        //     $table->string('IPAddress');
        //     $table->integer('Port');
        //     $table->string('DeviceType');
        //     $table->timestamps();
        // });

        DB::table('permissions')->insert([
            ['name' => 'attendancedevices.index','description' => 'All Data Views','created_at' => Carbon::now(),'updated_at' => Carbon::now(),'modual' => 'attendancedevices'],
            ['name' => 'attendancedevices.create','description' => 'Only Can Create','created_at' => Carbon::now(),'updated_at' => Carbon::now(),'modual' => 'attendancedevices'],
            ['name' => 'attendancedevices.show','description' => 'Only Can Read','created_at' => Carbon::now(),'updated_at' => Carbon::now(),'modual' => 'attendancedevices'],
            ['name' => 'attendancedevices.edit','description' => 'Only Can Edit','created_at' => Carbon::now(),'updated_at' => Carbon::now(),'modual' => 'attendancedevices'],
            ['name' => 'attendancedevices.destroy','description' => 'Only Can Delete','created_at' => Carbon::now(),'updated_at' => Carbon::now(),'modual' => 'attendancedevices']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('permissions')->delete(['name' => 'attendancedevices.index']);
        DB::table('permissions')->delete(['name' => 'attendancedevices.create']);
        DB::table('permissions')->delete(['name' => 'attendancedevices.show']);
        DB::table('permissions')->delete(['name' => 'attendancedevices.edit']);
        DB::table('permissions')->delete(['name' => 'attendancedevices.destroy']);
        Schema::dropIfExists('attendancedevices');
    }
}
