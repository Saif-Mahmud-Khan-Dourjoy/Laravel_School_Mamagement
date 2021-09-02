<?php

namespace App\Console\Commands;

use App\CollectedFees;
use App\NotificationReceiver;
use App\Notifications\CommonNotification;
use App\SmsLog;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendDailyCollection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:collection';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Daily Collection SMS and Email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {  
        $receivers = NotificationReceiver::where('notification_type_id', 6)->where('status', 1)->get();
        $receiversPhone = $receivers->pluck('phone')->toArray();

        $today = Carbon::today()->format('Y-m-d');
        $collections = CollectedFees::where('collected_fees.collection_date', $today)
                        ->leftJoin('users', 'users.id', '=', 'collected_fees.collector_id')
                        ->leftJoin('section_students', 'collected_fees.section_student_id', '=', 'section_students.id')
                        ->leftJoin('sections', 'section_students.section_id', '=', 'sections.id')
                        ->leftJoin('level_enrolls', 'sections.level_enroll_id', '=', 'level_enrolls.id')
                        ->leftJoin('branches', 'level_enrolls.branch_id', '=', 'branches.id')
                        ->selectRaw('sum(total_collected) as total_collected, users.name as collector, level_enrolls.branch_id, branches.name as branch_name')
                        ->groupBy(['level_enrolls.branch_id', 'collector_id'])
                        ->get();
        
        //sending email
        foreach($receivers as $receiver){
            Notification::route('mail', $receiver->email)->notify(new CommonNotification($receiver, 'Todays Collections', 'email.daily_total_collection', $collections->toArray()));
        }

        //sending sms

        $sms = new \App\Helpers\ELITBUZZSmsAPI;
        $message = env('APP_NAME').PHP_EOL.'Daily Fees Collection '.PHP_EOL.'Date: '.date('Y-m-d').PHP_EOL;
        $total_amount = 0;
        $branch_id = NULL;
        foreach($collections as $collection){
            $total_amount += $collection->total_collected;
            if($branch_id != $collection->branch_id){
                $message.= PHP_EOL.'Branch Name: '.$collection->branch_name.PHP_EOL;
                $branch_id = $collection->branch_id;
            }

            $message .= 'Collector Name: '.$collection->collector.PHP_EOL;
            $message .= 'Total Amount: '.$collection->total_collected.PHP_EOL;
        }

        $message .=  PHP_EOL.'Total Collected Amount: '.$total_amount.' TK';
        $sms->send($receiversPhone , $message, 'text');

        if(count($receiversPhone) != 0){
            SmsLog::create(['notification_type_id' => 6, 'total_send' =>  count($receiversPhone)]);
        }
    }
}
