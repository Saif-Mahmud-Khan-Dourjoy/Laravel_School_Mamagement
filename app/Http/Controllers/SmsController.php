<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SectionStudent;
use App\GeneralSetting;
use App\CollectedFees;
use App\Attendance;
use App\Student;
use App\Session;
use App\Branch;
use App\Level;
use App\Section;
use App\LevelEnroll;
use App\FiscalYear;
use App\BusinessMonth;
use App\SmsLog;
use DB;
use Log;

class SmsController extends Controller
{  
    public function __construct()
    {
        $this->middleware('auth');
        
        
        $this->middleware(function ($request, $next) {
            

            if(env('ROLE_ENABLE',0) == 1){                
                if (!$request->user()->hasPermission($request->route()->action['as'])){
                    return redirect('warning');
                }
            }
            return $next($request);
        });
    }
    public function index(){

    	$sessions = Session::with('level_enroll.level', 'level_enroll.section', 'level_enroll.branch', 'level_enroll.section.section_student', 'fiscal_year')->get();
        $branches = Branch::all();
        $levels = Level::with('level_enroll.section', 
                            'level_enroll.section.section_student', 
                            'level_enroll.section.section_student.student')
                            ->get();
        return view('admin.sms.index', 
        ['branches' => $branches,
         'sessions' => $sessions,
         'levels' => $levels]);
    	return view('admin.sms.index');
    }

    public function loadSmsInfo(Request $request){

    	$session_id = $request->session_id;
    	$section_id = $request->section_id;
    	$level_id = $request->level_id;
    	$sms_type = $request->sms_type;


        if ($session_id != null) {
            
        
    	if($sms_type == 1 && $session_id != null){
    		$section_students = SectionStudent::leftJoin('sections', 'section_students.section_id', '=', 'sections.id')
    			->leftJoin('students', 'section_students.student_id', '=', 'students.id')
    			->leftJoin('level_enrolls', 'sections.level_enroll_id', '=', 'level_enrolls.id')
    			->leftJoin('levels', 'level_enrolls.level_id', '=', 'levels.id')
    			->leftJoin('sessions', 'level_enrolls.session_id', '=', 'sessions.id')
    			->select(
    				'sections.section_name',
    				'section_students.section_id',
    				'section_students.student_id',
    				'section_students.roll',
    				'level_enrolls.level_id',
    				'levels.class_name',
    				'sessions.id as session_id',
    				'sessions.name as session_name',
                    'students.name as student_name',
                    'students.religion',
                    'students.mothers_cell',
                    'students.contact_no',
                    'students.fathers_cell')
                ->where('sessions.id', $session_id);

                if($section_id != NULL){
                    $section_students->where('section_students.section_id', $section_id);
                }
                if($level_id != NULL){
                    $section_students->where('level_enrolls.level_id', $level_id);
                }
                
                $section_students = $section_students->orderBy('level_id', 'asc')->orderBy('roll', 'asc')->get();

            return $section_students;
    	}

        elseif($sms_type == 2 && $session_id != NULL && $level_id != NULL){
            $class_teacher = SectionStudent::leftJoin('sections', 'section_students.section_id', '=', 'sections.id')
                    ->leftJoin('teachers', 'sections.teacher_id', '=', 'teachers.id')
                    ->leftJoin('level_enrolls', 'sections.level_enroll_id', '=', 'level_enrolls.id')
                    ->leftJoin('levels', 'level_enrolls.level_id', '=', 'levels.id')
                    ->leftJoin('sessions', 'level_enrolls.session_id', '=', 'sessions.id')
                    ->select(
                        'sections.section_name',
                        'section_students.section_id',
                        'section_students.student_id',
                        'section_students.roll',
                        'level_enrolls.level_id',
                        'levels.class_name',
                        'sessions.id as session_id',
                        'sessions.name as session_name',
                        'teachers.teacher_name',
                        'teachers.religion',
                        'teachers.contact_no')
                    ->where('sessions.id', $session_id)
                    ->where('level_enrolls.level_id', $level_id);

                    if($section_id != NULL){
                        $class_teacher->where('section_students.section_id', $section_id);
                    }
                    
                    $class_teacher = $class_teacher->orderBy('level_id', 'asc')->orderBy('roll', 'asc')->first();

            return $class_teacher;
        }

        elseif($sms_type == 3){

            $session_wise_teachers = Section::leftJoin('level_enrolls', 'sections.level_enroll_id', '=', 'level_enrolls.id')
                ->leftJoin('teachers', 'sections.teacher_id', '=', 'teachers.id')
                ->leftJoin('levels', 'level_enrolls.level_id', '=', 'levels.id')
                ->leftJoin('sessions', 'level_enrolls.session_id', '=', 'sessions.id')
                ->select(
                        'sections.section_name',
                        'level_enrolls.level_id',
                        'levels.class_name',
                        'sessions.id as session_id',
                        'sessions.name as session_name',
                        'teachers.teacher_name',
                        'teachers.religion',
                        'teachers.contact_no');

                if($session_id != NULL){
                    $session_wise_teachers->where('sessions.id', $session_id);
                }

                $session_wise_teachers = $session_wise_teachers->orderBy('level_id', 'asc')->get();

            return $session_wise_teachers;
        }
    }else{
        $no_data=["data"=>"invalid"];
        return $no_data;
    }

    }
    
    public function sendSms(Request $request){
        if(!empty($request->phone) && $request->msg != NULL && $request->notification_type_id != NULL){
            $sms = new \App\Helpers\ELITBUZZSmsAPI;
            $type = ($request->msg_type == 1)?'text':'unicode';
            $sendSms = $sms->send($request->phone, $request->msg, $type);

            if (strpos($sendSms, 'SMS SUBMITTED:') === false) {
                echo 'false';
                Log::info($sendSms);
                return;
            }
            
            $oldLog = SmsLog::where('notification_type_id', $request->notification_type_id)->whereDate('created_at' , date('Y-m-d'))->first();
            if($oldLog != NULL){
                $oldLog->total_send += count($request->phone);
                $oldLog->save();
            }
            else{
                SmsLog::create(['notification_type_id' => $request->notification_type_id, 'total_send' =>  count($request->phone)]);
            }

            echo 'true';
        }
        else{
            echo 'false';
        }
    }
}
