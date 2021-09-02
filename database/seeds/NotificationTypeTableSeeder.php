<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class NotificationTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //seeds for notification type
        $n_type = new \App\NotificationType();
        $n_type->id=1;
        $n_type->type_name="Due Notification";
        $n_type->status=1;
        $n_type->created_at=Carbon::now()->format('Y-m-d H:i:s');
        $n_type->Save();

        $n_type = new \App\NotificationType();
        $n_type->id=2;
        $n_type->type_name="Occasional Notification";
        $n_type->status=1;
        $n_type->created_at=Carbon::now()->format('Y-m-d H:i:s');
        $n_type->Save();

        $n_type = new \App\NotificationType();
        $n_type->id=3;
        $n_type->type_name="Money Receipt SMS";
        $n_type->status=1;
        $n_type->created_at=Carbon::now()->format('Y-m-d H:i:s');
        $n_type->Save();

        $n_type = new \App\NotificationType();
        $n_type->id=5;
        $n_type->type_name="Important Notice";
        $n_type->status=1;
        $n_type->created_at=Carbon::now()->format('Y-m-d H:i:s');
        $n_type->Save();

        $n_type = new \App\NotificationType();
        $n_type->id=6;
        $n_type->type_name="Collected Fees Notification";
        $n_type->status=1;
        $n_type->created_at=Carbon::now()->format('Y-m-d H:i:s');
        $n_type->Save();

        $n_type = new \App\NotificationType();
        $n_type->id=7;
        $n_type->type_name="Birthday Greething";
        $n_type->status=1;
        $n_type->created_at=Carbon::now()->format('Y-m-d H:i:s');
        $n_type->Save();

        $n_type = new \App\NotificationType();
        $n_type->id=8;
        $n_type->type_name="Monthly Fees Payment";
        $n_type->status=1;
        $n_type->created_at=Carbon::now()->format('Y-m-d H:i:s');
        $n_type->Save();

        $n_type = new \App\NotificationType();
        $n_type->id=9;
        $n_type->type_name="Exam Fees Payment";
        $n_type->status=1;
        $n_type->created_at=Carbon::now()->format('Y-m-d H:i:s');
        $n_type->Save();

        $n_type = new \App\NotificationType();
        $n_type->id=10;
        $n_type->type_name="Exam Date Reminder";
        $n_type->status=1;
        $n_type->created_at=Carbon::now()->format('Y-m-d H:i:s');
        $n_type->Save();

        $n_type = new \App\NotificationType();
        $n_type->id=11;
        $n_type->type_name="Parents Meeting";
        $n_type->status=1;
        $n_type->created_at=Carbon::now()->format('Y-m-d H:i:s');
        $n_type->Save();

        $n_type = new \App\NotificationType();
        $n_type->id=12;
        $n_type->type_name="Holiday Reminder";
        $n_type->status=1;
        $n_type->created_at=Carbon::now()->format('Y-m-d H:i:s');
        $n_type->Save();
       
        $n_type = new \App\NotificationType();
        $n_type->id=13;
        $n_type->type_name="Monthly SMS Log";
        $n_type->status=1;
        $n_type->created_at=Carbon::now()->format('Y-m-d H:i:s');
        $n_type->Save();
    }
}
