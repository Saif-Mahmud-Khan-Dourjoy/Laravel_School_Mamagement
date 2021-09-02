<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TermResult;
use App\Student;
use App\SectionStudent;
use App\BusinessMonth;
use App\FiscalYear;
use App\FeesType;
use App\Section;
use App\LevelEnroll;
use App\Level;
use App\User;
use App\Session;
use App\FinalReport;
use App\StudentSubjectResult;
use App\AttendanceStatus;
use App\WorkingDay;
use Carbon\Carbon;
use NumberToWords\NumberToWords;
use Auth;
use DB;

class ReportController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    public function statistics_index(){
        $sessions = Session::all();
        return view('admin.report.index_student_statistic')->with(['sessions'=> $sessions]);
    }

    public function statistics_pdf(Request $request){
        $session = Session::find($request->session_id);
       // return view('admin.report.student_statistic_pdf')->with(['session'=> $session]);
        $mpdf = new \Mpdf\Mpdf();
        $html = view('admin.report.student_statistic_pdf')->with(['session'=> $session])->render();
        $mpdf->WriteHTML($html);
        $mpdf->Output();

    }


    public function weeklyTest($id, Request $request){
    	// $term_id = $id;
        // $session_id = $request->session_id;
        // $section_student_id = $request->section_student_id;
        // $user = User::with('teacher')->findOrFail(Auth::user()->id);
        // $teacher_id = ($user->teacher != NULL)? $user->teacher->id:0;

        // if($user->hasPermission('reports.weeklyTest')){
        //     $tr = TermResult::where('section_student_id', $section_student_id)->where('term_id', $term_id)->with('section_subject_teacher.student_subject_term_mark');
        //     $tr->whereHas('section_subject_teacher.section.level_enroll', function ($tr) use ($session_id) {
        //         $tr->where(['session_id' => $session_id]);
        //     });
        //     $term_results = $tr->get();
        // }
        // else{
        //     $tr = TermResult::where('section_student_id', $section_student_id)->where('term_id', $term_id)->with('section_subject_teacher.student_subject_term_mark');
        //     $tr->whereHas('section_subject_teacher.section.level_enroll', function ($tr) use ($session_id) {
        //         $tr->where(['session_id' => $session_id]);
        //     });

        //     $tr->where(function($tr) use ($teacher_id){
        //         $tr->whereHas('section_subject_teacher', function ($tr) use ($teacher_id){
        //             $tr->where(['teacher_id' => $teacher_id]);
        //         });
        //         $tr->orWhereHas('section_subject_teacher.section', function ($tr) use ($teacher_id){
        //             $tr->where(['teacher_id' => $teacher_id]);
        //         });

        //     });

        //     $term_results = $tr->get();
        // }

    	// $section_student = \App\SectionStudent::with(['student','section.level_enroll.level','section.level_enroll.branch','section.level_enroll.session'])->find($section_student_id);
        // $term = \App\Term::find($term_id);
    	//dd($section_student);

            ///my new code
        $term_id = $request->term_id;
        $student_id = $request->student_id;
        $section_id = $request->section_id;
        $session_id = $request->session_id;
        $section_student = SectionStudent::where('student_id', $student_id)->
        where('section_id', $section_id)->first();

        $term_results = TermResult::where('section_student_id', $section_student->id)
        ->where('term_id', $term_id)
        ->get();



    	$mpdf = new \Mpdf\Mpdf();

    	$html = view('admin.report.termReport')
    	->with(['term_results' => $term_results, 'session_id' => $session_id]);
      // exit($html);
    //    return view('admin.report.termReport')
    //    ->with(['term_results' => $term_results, 'session_id' => $session_id]);
    	
		$mpdf->WriteHTML($html);
		$mpdf->Output();
    }

    public function pdfReportFinal(Request $request, $id) {
        $section_id = $request->input('section_id');
        $student_id = $id;
        $section_student = SectionStudent::where(['student_id' => $student_id, 'section_id' => $section_id])->with(['student','section.level_enroll.level', 'section.level_enroll.session', 'section.level_enroll.branch'])->first();

        $fr = FinalReport::where('student_id', $student_id);
        $fr->whereHas('section_subject_teacher', function ($fr) use ($section_id) {
            $fr->where(['section_id' => $section_id]);
        });

        $fr->with(['section_subject_teacher.term_result','section_subject_teacher.subject']);
        $final_reports = $fr->get();

        $terms = TermResult::with('term');
        $terms->whereHas('section_student', function ($terms) use ($section_id, $student_id) {
            $terms->where(['section_id' => $section_id]);
            $terms->where(['student_id' => $student_id]);
        });
        $terms = $terms->groupBy('term_id')->get();
        /********************/
        $mpdf= new \Mpdf\Mpdf(array(
                    'mode' => 'utf-8',
                    'format' => 'A4-L',
                    'default_font_size' =>  10,
                    'default_font' =>  'helvetica',                                
                    'orientation' => 'P',
                    'margin_left' => '8',
                    'margin_bottom' => '0',
                    'margin_top' => '0',
                    'margin_right' => '8',
                    'setAutoTopMargin' => 'stretch',
                    'setAutoBottomMargin' => 'stretch',
                    'autoPageBreak' => false
                ));

         $html = view('admin.report.view_student_pdf_final_report')->with(['final_reports' => $final_reports,'section_student' => $section_student, 'terms' => $terms]);
       // return view('admin.report.view_student_pdf_final_report')->with(['final_reports' => $final_reports,'section_student' => $section_student, 'terms' => $terms]);

       //exit($html);
        $mpdf->AddPage('L');
        // $mpdf->SetHTMLHeader('');
        // $mpdf->SetHTMLFooter('');
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function pdfAttendanceReport(Request $request){
        $this->validate($request, [
            'session_id' => 'required', 
            'section_id' => 'required', 
            'level_id' => 'required',
            'attendance_date' => 'required',
            'collection_type' => 'required'
        ]);

        $session_id=$request->session_id;
    	$section_id=$request->section_id;
    	$level_id=$request->level_id;
    	$attendance_date=$request->attendance_date;
        $collection_type=$request->collection_type;

        $session=Session::find($session_id);
    	$section=Section::find($section_id);
    	$level=Level::find($level_id);

        //$attendance_date= $attendance_date->format('d/m/Y');
        // $attendance_date= $attendance_date->toDateTimeString();
        // $date=  Carbon::$attendance_date->toDateTimeString();
        
        //$attendance_date = date("d-m-Y", strtotime($attendance_date)); 
        // echo $newDate;
        // exit();
        if($collection_type==1){
            $attendances=AttendanceStatus::where('section_id',$section_id)
                                        ->where('date',$attendance_date)->where('status',1)->get();

        }
        elseif($collection_type==2){
            $attendances=AttendanceStatus::where('section_id',$section_id)
            ->where('date',$attendance_date)->where('status',0)->get();

        }
        else{
            $attendances=AttendanceStatus::where('section_id',$section_id)
            ->where('date',$attendance_date)->get();

        }


        
        $date = date("d-m-Y", strtotime($attendance_date)); 


        
        $mpdf = new \Mpdf\Mpdf();
        // $html = view('admin.attendance.pdf_attendance_report')
        // ->with(['today' => $today, 'section_student_attendance' => $section_student_attendance, 'user'=> $user, 'total_student' => $total_student, 'present_student' => $present_student, 'absent_student' => $absent_student, 'filter_type' => $filter_type, 'total_student_number' => $total_student_number])->render();
       
        $html = view('admin.attendance.pdf_attendance_report')
        ->with(['section_id'=>$section_id, 'filter_type' => $collection_type, 'attendances'=> $attendances,'attendance_date'=>$attendance_date, 
        'session'=>$session,'section'=>$section,'level'=>$level,'attendance_date'=>$attendance_date,'date'=>$date])->render();
  
        
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function monthlyFeesCollectionIndex(){
        $fiscal_years = FiscalYear::orderBy('year')->get();
        $fees_types = FeesType::orderBy('fees_type_name')->get();
        $business_months = BusinessMonth::orderBy('month_name')->get();
        return view('admin.collected_fees.monthly_collection',['fees_types' => $fees_types, 'fiscal_years' => $fiscal_years, 'business_months' => $business_months]);
    }

    public function monthlyCollectionReport(Request $request){
       // dd($request->all());
        $fd = $request->from_date;
        $td = $request->to_date;
        $fy = $request->fiscal_year;
        $bm = $request->business_month;
        $ft = $request->fees_type;
        $ct = $request->collection_type;
        $collection = DB::table('collected_fees')
        ->join("section_wise_fees",\DB::raw("FIND_IN_SET(section_wise_fees.id,collected_fees.section_wise_fees_ids)"),">",\DB::raw("'0'"))
        ->where('collected_fees.business_month_id', $bm)
        ->leftJoin('business_months', 'section_wise_fees.business_month_id','=', 'business_months.id')
        ->leftJoin('fees_types', 'section_wise_fees.fees_type_id','=', 'fees_types.id')
        ->leftJoin('section_students', 'collected_fees.section_student_id','=', 'section_students.id')
        ->leftJoin('students', 'collected_fees.student_id','=', 'students.id')
        ->leftJoin('sections', 'section_wise_fees.section_id','=', 'sections.id')
        ->leftJoin('level_enrolls', 'sections.level_enroll_id','=', 'level_enrolls.id')
        ->leftJoin('teachers', 'sections.teacher_id','=', 'teachers.id')
        ->leftJoin('levels', 'level_enrolls.level_id','=', 'levels.id')
        ->leftJoin('fiscal_years', 'business_months.fiscal_year_id','=', 'fiscal_years.id')
        ->selectRaw('section_wise_fees.id as swf_id, section_wise_fees.amount, business_months.id as bm_id, fiscal_years.year, business_months.month_name, fees_types.fees_type_name, students.name as std_name, sections.section_name, teachers.teacher_name, levels.id as level_id, levels.class_name, collected_fees.collection_date, collected_fees.total_collected, collected_fees.discount_amount,collected_fees.total_advanced, collected_fees.total_due, collected_fees.section_wise_fees_ids')
        ->orderBy('level_id')
        ->get();
        dd($collection);
        echo view('admin.collected_fees.monthly_collection_report');
    }
}
