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
use Carbon\Carbon;
use NumberToWords\NumberToWords;
use Auth;
use DB;

class TransferCertificateController extends Controller
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

    function index(){
    	$sessions = Session::with('level_enroll.level', 'level_enroll.section', 'level_enroll.branch', 'level_enroll.section.section_student', 'fiscal_year')->get();
        $branches = Branch::all();
        $fiscal_years = FiscalYear::with('session')->get();
        $business_months = BusinessMonth::all();
        $levels = Level::with('level_enroll.section', 
                            'level_enroll.section.section_student', 
                            'level_enroll.section.section_student.student')
                            ->get();
    	return view('admin.transfer_certificate.index', ['branches' => $branches,
         'sessions' => $sessions, 
         'fiscal_years' => $fiscal_years, 
         'business_months' => $business_months,
         'levels' => $levels]);
    }
    function testimonial_index(){
    	$sessions = Session::with('level_enroll.level', 'level_enroll.section', 'level_enroll.branch', 'level_enroll.section.section_student', 'fiscal_year')->get();
        $branches = Branch::all();
        $fiscal_years = FiscalYear::with('session')->get();
        $business_months = BusinessMonth::all();
        $levels = Level::with('level_enroll.section', 
                            'level_enroll.section.section_student', 
                            'level_enroll.section.section_student.student')
                            ->get();
    	return view('admin.transfer_certificate.testimonial_index', ['branches' => $branches,
         'sessions' => $sessions, 
         'fiscal_years' => $fiscal_years, 
         'business_months' => $business_months,
         'levels' => $levels]);
    }

    function studentship_index(){
    	$sessions = Session::with('level_enroll.level', 'level_enroll.section', 'level_enroll.branch', 'level_enroll.section.section_student', 'fiscal_year')->get();
        $branches = Branch::all();
        $fiscal_years = FiscalYear::with('session')->get();
        $business_months = BusinessMonth::all();
        $levels = Level::with('level_enroll.section', 
                            'level_enroll.section.section_student', 
                            'level_enroll.section.section_student.student')
                            ->get();
    	return view('admin.transfer_certificate.studentship_index', ['branches' => $branches,
         'sessions' => $sessions, 
         'fiscal_years' => $fiscal_years, 
         'business_months' => $business_months,
         'levels' => $levels]);
    }

    public function admitCard_index(){
        $sessions = Session::with('level_enroll.level', 'level_enroll.section', 'level_enroll.branch', 'level_enroll.section.section_student', 'fiscal_year')->get();
        $branches = Branch::all();
        $fiscal_years = FiscalYear::with('session')->get();
        $business_months = BusinessMonth::all();
        $levels = Level::with('level_enroll.section', 
                            'level_enroll.section.section_student', 
                            'level_enroll.section.section_student.student')
                            ->get();

        $terms=Term::all();
        return view('admin.transfer_certificate.admitCard_index', ['branches' => $branches,
         'sessions' => $sessions, 
         'fiscal_years' => $fiscal_years, 
         'business_months' => $business_months,
         'levels' => $levels,
         'terms'=>$terms]);
    }

    function load_transfer_certificate(Request $request){
        $this->validate($request, 
            [
                'session_id' => 'required',
                'level_id' => 'required',
                'section_id' => 'required',
                'section_student_id' => 'required',
                'transfer_place' => 'required',
                'reason' => 'required',
            ]);

       $session_trans=$request->session_id;
       $class_trans=$request->level_id;
       $section_trans=$request->section_id;
       $transfer_place=$request->transfer_place;
       $transfer_reason=$request->reason;

       $result = $request->result;
       $lesson = $request->lesson;
       $character = $request->character;


     	$request_data =  $request->except('_token');

        $student_details = SectionStudent::leftJoin('sections', 'section_students.section_id', '=', 'sections.id')
        ->leftJoin('students', 'section_students.student_id', '=', 'students.id')
        ->leftJoin('level_enrolls', 'sections.level_enroll_id', '=', 'level_enrolls.id')
        ->leftJoin('levels', 'level_enrolls.level_id', '=', 'levels.id')
        ->leftJoin('sessions', 'level_enrolls.session_id', '=', 'sessions.id')
        ->select('sections.id as section_id',

                'section_students.roll',
                'students.id as student_id',
                'students.name',
                'students.date_of_birth',
                'students.birth_place',
                'students.admission_date',
                'students.nationality',
                'students.mothers_cell',
                'students.fathers_cell',
                'students.contact_no',
                'students.mothers_name',
                'students.fathers_name',
                'sections.section_name',
                'levels.id as level_id',
                'levels.class_name',
                'sessions.id as session_id',
                'sessions.name as session_name')
        ->where('students.id', $request->section_student_id)
        ->where('levels.id', $request->level_id)
        ->where('sessions.id', $request->session_id)
        ->with('term_result','collected_fees')
        ->first();

        $transfer_certificate=new TransferCertificate;
        $transfer_certificate->session_id=$session_trans;
        $transfer_certificate->level_id=$class_trans;
        $transfer_certificate->section_id=$section_trans;
        $transfer_certificate->student_id=$student_details->student_id;
        $transfer_certificate->transfer_place=$transfer_place;
        $transfer_certificate->reason=$transfer_reason;
        $transfer_certificate->save();

        $transfer_certificate_no=TransferCertificate::get()->count();

        $students = Student::find($student_details->student_id);
        $student_roll = $students->roll_no;
        $collected_fees=CollectedFees::select("*")
                        ->where("student_id", $student_details->student_id)
                        ->orderBy('collection_date', 'desc')
                        ->first();
                        
        
        $update_transfer_status = SectionStudent::findOrFail($request->section_id);
        $update_transfer_status->transfer_out = 1;
        $update_transfer_status->update();

        
       
    	//dd($student_details);
    	$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
    	$today = Carbon::today()->format('Y-m-d');
        $settings = GeneralSetting::first();
        // return  view('admin.transfer_certificate.pdf_transfer_certificate')
        // ->with(['result' => $result, 'character' => $character, 'lesson' => $lesson, 'today' => $today, 'transfer_reason' => $transfer_reason, 'student_details' => $student_details, 'request_data' => $request_data, 'students'=>$students,'collected_fees'=>$collected_fees,'transfer_certificate_no'=>$transfer_certificate_no]);
        // exit();
        $html = view('admin.transfer_certificate.pdf_transfer_certificate')
        ->with(['result' => $result, 'character' => $character, 'lesson' => $lesson, 'today' => $today, 'transfer_reason' => $transfer_reason, 'student_details' => $student_details, 'request_data' => $request_data, 'students'=>$students,'collected_fees'=>$collected_fees,'transfer_certificate_no'=>$transfer_certificate_no])->render();
      
        $mpdf->WriteHTML($html);
        $mpdf->Output($student_roll.'-'.date('Ymdhis').'-transferCertificate.pdf','I');
    }

    function load_testimonial(Request $request){


        $this->validate($request, 
            [
                'session_id' => 'required',
                'level_id' => 'required',
                'section_id' => 'required',
                'section_student_id' => 'required',
            ]);

            $request_data =  $request->except('_token');
            $session_trans=$request->session_id;
            $class_trans=$request->level_id;
            $section_trans=$request->section_id;

        $student_details = SectionStudent::leftJoin('sections', 'section_students.section_id', '=', 'sections.id')
        ->leftJoin('students', 'section_students.student_id', '=', 'students.id')
        ->leftJoin('level_enrolls', 'sections.level_enroll_id', '=', 'level_enrolls.id')
        ->leftJoin('levels', 'level_enrolls.level_id', '=', 'levels.id')
        ->leftJoin('sessions', 'level_enrolls.session_id', '=', 'sessions.id')
        ->select('sections.id as section_id',
                'section_students.roll',
                'students.id as student_id',
                'students.name',
                'students.date_of_birth',
                'students.birth_place',
                'students.admission_date',
                'students.nationality',
                'students.mothers_cell',
                'students.fathers_cell',
                'students.contact_no',
                'students.mothers_name',
                'students.fathers_name',
                'sections.section_name',
                'levels.id as level_id',
                'levels.class_name',
                'sessions.id as session_id',
                'sessions.name as session_name')
        ->where('students.id', $request->section_student_id)
        ->where('levels.id', $request->level_id)
        ->where('sessions.id', $request->session_id)
        ->with('term_result','collected_fees')
        ->first();
        $testimonial=new Testimonial;
        $testimonial->session_id=$session_trans;
        $testimonial->level_id=$class_trans;
        $testimonial->section_id=$section_trans;
        $testimonial->student_id=$student_details->student_id;
        $testimonial->save();
        $testimonial_no=Testimonial::get()->count();
        $today = Carbon::today()->format('Y-m-d');
        $settings = GeneralSetting::first();
        $students = Student::find($student_details->student_id);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
         $html = view('admin.transfer_certificate.pdf_testimonial')->with(['today' => $today, 'student_details' => $student_details, 'students' => $students, 'request_data' => $request_data,'testimonial_no'=>$testimonial_no])->render();
        $mpdf->WriteHTML($html);
        $mpdf->Output();

    }
    function load_studentship_certificate(Request $request){
        $this->validate($request, 
            [
                'session_id' => 'required',
                'level_id' => 'required',
                'section_id' => 'required',
                'section_student_id' => 'required',
            ]);

            $request_data =  $request->except('_token');

        $student_details = SectionStudent::leftJoin('sections', 'section_students.section_id', '=', 'sections.id')
        ->leftJoin('students', 'section_students.student_id', '=', 'students.id')
        ->leftJoin('level_enrolls', 'sections.level_enroll_id', '=', 'level_enrolls.id')
        ->leftJoin('levels', 'level_enrolls.level_id', '=', 'levels.id')
        ->leftJoin('sessions', 'level_enrolls.session_id', '=', 'sessions.id')
        ->select('sections.id as section_id',
                'section_students.roll',
                'students.id as student_id',
                'students.name',
                'students.date_of_birth',
                'students.birth_place',
                'students.admission_date',
                'students.nationality',
                'students.mothers_cell',
                'students.fathers_cell',
                'students.contact_no',
                'students.mothers_name',
                'students.fathers_name',
                'sections.section_name',
                'levels.id as level_id',
                'levels.class_name',
                'sessions.id as session_id',
                'sessions.name as session_name')
        ->where('students.id', $request->section_student_id)
        ->where('levels.id', $request->level_id)
        ->where('sessions.id', $request->session_id)
        ->with('term_result','collected_fees')
        ->first();
        $today = Carbon::today()->format('Y-m-d');
        $settings = GeneralSetting::first();
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
        $students = Student::find($student_details->student_id);
  
        $html = view('admin.transfer_certificate.pdf_studentship_certificate')->with(['today' => $today, 'student_details' => $student_details, 'students' => $students, 'request_data' => $request_data])->render();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function load_admit_card(Request $request){
     
         $this->validate($request, 
            [
                'session_id' => 'required',
                'level_id' => 'required',
                'section_id' => 'required',
                'section_student_id' => 'required',
                'term_id' => 'required',
                'exam_start_date' => 'required'
            ]);

            $request_data =  $request->except('_token');
            $term_id=$request->term_id;
            $term_info=Term::find($term_id);
            $exam_start_date = $request->exam_start_date;

        $student_details = SectionStudent::leftJoin('sections', 'section_students.section_id', '=', 'sections.id')
        ->leftJoin('students', 'section_students.student_id', '=', 'students.id')
        ->leftJoin('level_enrolls', 'sections.level_enroll_id', '=', 'level_enrolls.id')
        ->leftJoin('levels', 'level_enrolls.level_id', '=', 'levels.id')
        ->leftJoin('sessions', 'level_enrolls.session_id', '=', 'sessions.id')
        ->select('sections.id as section_id',
                'section_students.roll',
                'students.id as student_id',
                'students.name',
                'students.date_of_birth',
                'students.birth_place',
                'students.admission_date',
                'students.nationality',
                'students.mothers_cell',
                'students.fathers_cell',
                'students.contact_no',
                'students.mothers_name',
                'students.fathers_name',
                'sections.section_name',
                'levels.id as level_id',
                'levels.class_name',
                'sessions.id as session_id',
                'sessions.name as session_name')
        ->where('students.id', $request->section_student_id)
        ->where('levels.id', $request->level_id)
        ->where('sessions.id', $request->session_id)
        ->with('term_result','collected_fees')
        ->first();
        $today = Carbon::today()->format('Y-m-d');
        $settings = GeneralSetting::first();
        $students = Student::find($student_details->student_id);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A6-L']);
        $html = view('admin.transfer_certificate.pdf_admit')->with(['today' => $today, 'exam_start_date' => $exam_start_date, 'student_details' => $student_details, 'students' => $students, 'request_data' => $request_data,'term_info'=>$term_info])->render();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
     


    }

}
