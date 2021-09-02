<?php

namespace App\Console\Commands;

use App\SmsLog;
use App\Student;
use App\Teacher;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendBirthDayWish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send BirthDay grating';

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
        $today = Carbon::today()->format('Y-m-d');
        $month = Carbon::today()->format('m');
        $day = Carbon::today()->format('d');
        $teachersPhone = Teacher::whereMonth('date_of_birth', $month)->whereDay('date_of_birth', $day)->where('status', 1)->get()->pluck('contact_no')->toArray();
        $students = Student::whereMonth('students.date_of_birth', $month)->whereDay('date_of_birth', $day)->where('students.status', 1)->where('students.deleted_at', NULL)
                    ->join('section_students', 'students.id', '=', 'section_students.student_id')
                    ->join('sections', 'section_students.section_id', '=', 'sections.id')
                    ->join('level_enrolls', 'sections.level_enroll_id', '=', 'level_enrolls.id')
                    ->join('sessions', 'level_enrolls.session_id', '=', 'sessions.id')
                    ->where('starts_from', '<=', $today)
                    ->where('ends_to', '>=', $today)
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

        $total = 0;

        if(!empty($teachersPhone)){
            $total += count($teachersPhone);
            
            $sms = new \App\Helpers\ELITBUZZSmsAPI;
            $message = "Dear teacher,".PHP_EOL."Happy Birthday, We all respect you, teacher. You are not like all, you are not a standard teacher. You teach us to be good persons. Happy birthday!".PHP_EOL;
            
            $message .= env('APP_NAME');
            $sms->send($teachersPhone , $message, 'text');
        }
        
        If(!empty($studentPhone)){
            $total += count($studentPhone);

            $sms = new \App\Helpers\ELITBUZZSmsAPI;
            $message = "Dear student,".PHP_EOL."Happy Birthday, Make the best of this day. Wish you all the joys of life. Find your own amazing way".PHP_EOL;
            $message .= env('APP_NAME');
            
            $sms->send($studentPhone , $message, 'text');
        }

        if($total != 0){
            SmsLog::create(['notification_type_id' => 7, 'total_send' =>  $total]);
        }
    }
}
