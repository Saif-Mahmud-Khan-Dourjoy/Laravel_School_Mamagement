<?php

namespace App\Console\Commands;

use App\OccasionalNotification;
use App\SmsLog;
use App\Student;
use App\Teacher;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendOccasionGreeting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:occasionalGreeting';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Occasion Greeting';

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
        $dateTime = Carbon::now()->format('Y-m-d H:i'); 
        $occasions = OccasionalNotification::where('date', $dateTime)->where('status',1)->get();
        $teachersPhone = [];
        $studentPhone = [];

        foreach($occasions as $occasion){
            if($occasion->send_to == 1){
                $students = Student::where('students.status', 1)->where('students.deleted_at', NULL)
                    ->join('section_students', 'students.id', '=', 'section_students.student_id')
                    ->join('sections', 'section_students.section_id', '=', 'sections.id')
                    ->join('level_enrolls', 'sections.level_enroll_id', '=', 'level_enrolls.id')
                    ->join('sessions', 'level_enrolls.session_id', '=', 'sessions.id')
                    ->select('students.*')
                    ->get();

                $studentPhone = [];
                foreach($students as $student){
                    if($student->fathers_cell != NULL){
                        $studentPhone[] =  $student->fathers_cell;
                    }
                    elseif( $student->mothers_cell != NULL){
                        $studentPhone[] =  $student->mothers_cell;
                    }
                    elseif($student->contact_no != NULL){
                        $studentPhone[] =  $student->contact_no;
                    }
                }
            }
            elseif($occasion->send_to == 2){
                $teachersPhone = Teacher::where('status', 1)->get()->pluck('contact_no')->toArray();
            }
            elseif($occasion->send_to == 3){
                $teachersPhone = Teacher::where('status', 1)->get()->pluck('contact_no')->toArray();
                $students = Student::where('students.status', 1)->where('students.deleted_at', NULL)
                ->join('section_students', 'students.id', '=', 'section_students.student_id')
                ->join('sections', 'section_students.section_id', '=', 'sections.id')
                ->join('level_enrolls', 'sections.level_enroll_id', '=', 'level_enrolls.id')
                ->join('sessions', 'level_enrolls.session_id', '=', 'sessions.id')
                ->select('students.*')
                ->get();

                $studentPhone = [];
                foreach($students as $student){
                    if($student->fathers_cell != NULL){
                        $studentPhone[] =  $student->fathers_cell;
                    }
                    elseif( $student->mothers_cell != NULL){
                        $studentPhone[] =  $student->mothers_cell;
                    }
                    elseif($student->contact_no != NULL){
                        $studentPhone[] =  $student->contact_no;
                    }
                }
            }

            $total = 0;

            if(!empty($teachersPhone)){
                $total += count($teachersPhone);
                $sms = new \App\Helpers\ELITBUZZSmsAPI;
                $message = $occasion->text.PHP_EOL;
                $message .= env('APP_NAME');
                $sms->send($teachersPhone , $message, 'text');
            }

            if(!empty($studentPhone)){
                $total += count($studentPhone);
                $sms = new \App\Helpers\ELITBUZZSmsAPI;
                $message = $occasion->text.PHP_EOL;
                $message .= env('APP_NAME');
                $sms->send($studentPhone , $message, 'text');
            }

            if($total != 0){
                $oldLog = SmsLog::where('notification_type_id', 2)->whereDate('created_at' , date('Y-m-d'))->first();
                
                if($oldLog != NULL){
                    $oldLog->total_send += $total;
                    $oldLog->save();
                }
                else{
                    SmsLog::create(['notification_type_id' => 2, 'total_send' =>  $total]);
                }
            }
        }
    }
}
