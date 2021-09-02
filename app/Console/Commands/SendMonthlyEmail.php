<?php

namespace App\Console\Commands;

use App\NotificationReceiver;
use App\Notifications\CommonNotification;
use App\SmsLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Console\Command;

class SendMonthlyEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:monthlySmsReport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Monthly Sms Report';

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
        $receivers = NotificationReceiver::where('notification_type_id', 13)->where('status', 1)->get();

        $month = Carbon::today()->format('m');
        $smsLogs = SmsLog::whereMonth('created_at', $month)->get();
        
        //sending email
        foreach($receivers as $receiver){
            Notification::route('mail', $receiver->email)->notify(new CommonNotification($receiver, 'Monthly SMS Report', 'email.monthly_sms_report', $smsLogs->toArray()));
        }
    }
}
