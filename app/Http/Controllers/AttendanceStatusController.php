<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SectionStudent;
use App\TransferCertificate;
use App\Testimonial;
use App\GeneralSetting;
use App\CollectedFees;
use App\Attendance;
use App\Student;
use App\Session;
use App\Branch;
use App\Level;
use App\Term;
use App\Section;
use App\LevelEnroll;
use App\FiscalYear;
use App\BusinessMonth;
use App\SectionEnroll;
use App\AttendanceStatus;
use App\WorkingDay;
use Carbon\Carbon;
use NumberToWords\NumberToWords;
use Redirect;
use Auth;
use DB;

class AttendanceStatusController extends Controller
{

	public function __construct(){ 

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
        $fiscal_years = FiscalYear::with('session')->get();
        $business_months = BusinessMonth::all();
        $levels = Level::with('level_enroll.section', 
                            'level_enroll.section.section_student', 
                            'level_enroll.section.section_student.student')
                            ->get();
    	return view('admin.attendance_status.index', ['branches' => $branches,
         'sessions' => $sessions, 
         'fiscal_years' => $fiscal_years, 
         'business_months' => $business_months,
         'levels' => $levels]);
    }

    public function dashboard(Request $request){
    	$session_id=$request->session_id;
    	$section_id=$request->section_id;
    	$level_id=$request->level_id;
    	$class_date=$request->class_date;

        $this->validate($request, [
            'session_id' => 'required', 
            'section_id' => 'required', 
            'level_id' => 'required'
            ]);

    	$session=Session::find($session_id);
    	$section=Section::find($section_id);
    	$level=Level::find($level_id);

        if($class_date!=null){
            $section_student=SectionStudent::where('section_id',$section_id)->orderBy('roll')->get();
            $date_query=AttendanceStatus::where('date',$class_date)->count();

            if($date_query>0){
                foreach($section_student as $ss){
                    $status_count=AttendanceStatus::where('section_student_id',$ss->id)
                                                ->where('date',$class_date)
                                                ->count();

                    if($status_count==0){
                        $attendance_status=new AttendanceStatus;
                        $attendance_status->section_student_id=$ss->id;
                        $attendance_status->section_id=$section_id;
                        $attendance_status->session_id=$session_id;
                        $attendance_status->date=$class_date;
                        $attendance_status->status=0;
                        $attendance_status->save();
                    }                              


                }
            }
            else{
                $wroking_day_data=[
                    'session_id'=>$session_id,
                    'section_id'=>$section_id,
                    'date'=>$class_date,

                ];
                $workingday=WorkingDay::create($wroking_day_data);
                $status=0;
                foreach($section_student as $ss){
                    $attendance_status=new AttendanceStatus;
                    $attendance_status->section_student_id=$ss->id;
                    $attendance_status->section_id=$section_id;
                    $attendance_status->session_id=$session_id;
                    $attendance_status->date=$class_date;
                    $attendance_status->status=$status;
                    $attendance_status->save();

                }
            }

            $attendance_status_data=DB::table('attendance_statuses')
                ->join('section_students', 'attendance_statuses.section_student_id','=', 'section_students.id')
                ->where('attendance_statuses.date',$class_date)
                ->orderBy('section_students.roll')
                ->select('attendance_statuses.id','attendance_statuses.section_student_id','attendance_statuses.section_id','attendance_statuses.session_id','attendance_statuses.date','attendance_statuses.status','section_students.student_id','section_students.roll','section_students.section_id')
                ->get();
                

            return view('admin.attendance_status.dashboard',['attendance_status_data'=>$attendance_status_data,'session'=>$session,'section'=>$section,'level'=>$level,'class_date'=>$class_date]);
        }

        else{
            $working_days = WorkingDay::where('session_id', $session_id)->where('section_id',$section_id)->orderBy('date', 'DESC')->get();
            // return response()->json($working_days);
            return view('admin.attendance_status.attendance_days',['working_days'=>$working_days,'session'=>$session,'section'=>$section,'level'=>$level]);
        }

    }

   
    public function store(Request $request){
            $id=$request->id;
            $id=(int)$id;
            $status=$request->status;
            $status=(int)$status;

            $attendance_status=AttendanceStatus::find($id);

            $attendance_status->status=$status;
            $attendance_status->save();

            if(!is_null($attendance_status)){
            	echo json_encode("Successfully Updated");
            }
           

    }

    public function delete($id){
        $working_day = WorkingDay::find($id);
        
        $session_id=$working_day->session_id;
    	$section_id=$working_day->section_id;
    	$date=$working_day->date;

        $working_day = WorkingDay::find($id)->delete();
        $attendance_status=AttendanceStatus::where('session_id', $session_id)->where('section_id',$section_id)->where('date',$date)->delete();
       
        $session=Session::find($session_id);
    	$section=Section::find($section_id);
    	$level_id=$section->level_enroll->level->id;
        $level = Level::find($level_id);

        
        $working_days = WorkingDay::where('session_id', $session_id)->where('section_id',$section_id)->orderBy('date', 'DESC')->get();
            // return response()->json($working_days);
        return view('admin.attendance_status.attendance_days',['working_days'=>$working_days,'session'=>$session,'section'=>$section,'level'=>$level]);
        
    } 
}
