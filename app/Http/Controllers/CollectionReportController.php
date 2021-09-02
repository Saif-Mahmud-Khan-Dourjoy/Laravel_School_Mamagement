<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
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
use NumberToWords\NumberToWords;
use Carbon\Carbon;
use DB;
use Auth;

class CollectionReportController extends Controller
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
        $fiscal_years = FiscalYear::with('session')->get();
        $business_months = BusinessMonth::all();
        $levels = Level::with('level_enroll.section', 
                            'level_enroll.section.section_student', 
                            'level_enroll.section.section_student.student')
                            ->get();
        return view('admin.collection_report.index', ['branches' => $branches,
         'sessions' => $sessions, 
         'fiscal_years' => $fiscal_years, 
         'business_months' => $business_months,
         'levels' => $levels]);
    }

    public function collectionReportView(Request $request){
        //dd($request->all());
        $search_for = $request->except('_token');
        
    	$session_id = $request->session_id;
    	$level_id = $request->level_id;
    	$section_id = $request->section_id;
    	$section_student_id = $request->section_student_id;
    	// $date_from = $request->date_from;
    	// $date_to = $request->date_to;
    	$fiscal_year_id = $request->fiscal_year_id;
        $business_month_id = $request->business_month_id;
        $collection_type = $request->collection_type;

    	$settings = GeneralSetting::first();
    	$today = Carbon::today()->format('Y-m-d');
    		$collections = CollectedFees::leftJoin('business_months', 'collected_fees.business_month_id', '=', 'business_months.id')
    		->leftJoin('fiscal_years', 'business_months.fiscal_year_id', '=', 'fiscal_years.id')
            ->leftJoin('section_students', 'collected_fees.section_student_id', '=', 'section_students.id')
    		->leftJoin('sections', 'section_students.section_id', '=', 'sections.id')
            ->leftJoin('students', 'section_students.student_id', '=', 'students.id')
    		->leftJoin('level_enrolls', 'sections.level_enroll_id', '=', 'level_enrolls.id')
    		->leftJoin('teachers', 'sections.teacher_id', '=', 'teachers.id')
    		->leftJoin('levels', 'level_enrolls.level_id', '=', 'levels.id')
    		->leftJoin('sessions', 'level_enrolls.session_id', '=', 'sessions.id')
    		->leftJoin('branches', 'level_enrolls.branch_id', '=', 'branches.id')
    		->leftJoin('users', 'collected_fees.collector_id', '=', 'users.id')
    		->select('collected_fees.id as collected_fees_id',
    				 'collected_fees.section_student_id',
    				 'collected_fees.collection_date',
    				 'collected_fees.total_collected',
    				 'collected_fees.discount_amount',
    				 'collected_fees.total_advanced',
    				 'collected_fees.total_due',
    				 'collected_fees.business_month_id',
    				 'collected_fees.section_wise_fees_ids',
    				 'collected_fees.student_id',
    				 'business_months.fiscal_year_id',
                     'fiscal_years.year as fiscal_year',
    				 'business_months.month_name',
    				 'section_students.section_id',
    				 'section_students.student_id',
    				 'section_students.roll',
    				 'sections.section_name',
    				 'level_enrolls.level_id',
    				 'teachers.teacher_name',
    				 'levels.class_name',
    				 'sessions.id as session_id',
    				 'sessions.name as session_name',
    				 'branches.name as branch_name',
                     'students.name as student_name',
                     'students.contact_no',
    				 'users.name as collector_name')
            ->with('section_student')
            ->orderBy('level_id', 'asc')
            ->orderBy('roll', 'asc')
            ->get();
            //dd($collections);

        //student wise collection for a year
        if($session_id != null && $level_id != null && $section_id != null && $section_student_id != null && $fiscal_year_id != null && $business_month_id == null){

            $collections = $collections->where('session_id', $session_id)
                                    ->where('section_id', $section_id)
                                    ->where('student_id', $section_student_id)
                                    ->where('fiscal_year_id', $fiscal_year_id)
                                    ->groupBy('month_name');
        }

        //for session and year wise collection
    	else if($session_id != null && $level_id == null && $section_id == null && $section_student_id == null && $fiscal_year_id != null && $business_month_id == null){

            $collections =  $collections->where('session_id', $session_id)
                                        ->where('fiscal_year_id', $fiscal_year_id)
                                        ->groupBy('class_name');
    	}

        //for class wise students collection 
        else if($session_id != null && $level_id != null && $section_id != null && $fiscal_year_id != null && $section_student_id == null && $business_month_id == null){

            $collections = $collections->where('session_id', $session_id)
                                    ->where('section_id', $section_id)
                                    ->where('level_id', $level_id)
                                    ->where('fiscal_year_id', $fiscal_year_id)
                                    ->groupBy('student_name');
        }


        //for session and year wise, specific month's collection
        else if($session_id != null && $level_id == null && $section_id == null && $section_student_id == null && $fiscal_year_id != null && $business_month_id != null){

            $collections =  $collections->where('session_id', $session_id)
                                        ->where('fiscal_year_id', $fiscal_year_id)
                                        ->where('business_month_id', $business_month_id)
                                        ->groupBy('class_name');
        }

        //for class wise, Monthly students collection 
        else if($session_id != null && $level_id != null && $section_id != null && $fiscal_year_id != null && $section_student_id == null && $business_month_id != null){

            $collections = $collections->where('session_id', $session_id)
                                    ->where('section_id', $section_id)
                                    ->where('level_id', $level_id)
                                    ->where('fiscal_year_id', $fiscal_year_id)
                                    ->where('business_month_id', $business_month_id)
                                    ->groupBy('student_name');
        }

    //student wise collection for a specific Month of a Year
        if($session_id != null && $level_id != null && $section_id != null && $section_student_id != null && $fiscal_year_id != null && $business_month_id != null){

            $collections = $collections->where('session_id', $session_id)
                                    ->where('section_id', $section_id)
                                    ->where('student_id', $section_student_id)
                                    ->where('fiscal_year_id', $fiscal_year_id)
                                    ->where('business_month_id', $business_month_id)
                                    ->groupBy('month_name');
        }
        // dd($collections);
        // print_r($collections);
        // exit();

        $f = new NumberToWords();
        $numberTransformer = $f->getNumberTransformer('en');

    	$user = Auth::user();
    	$mpdf = new \Mpdf\Mpdf();
        $html = view('admin.collection_report.pdf_collection_report')
        ->with(['today' => $today, 
                'user'=> $user, 
                'settings'=> $settings, 
                'collection_type'=> $collection_type, 
                'search_for'=> $search_for, 
                'numberTransformer'=> $numberTransformer, 
                'collections'=> $collections])->render();

        //exit();
        $mpdf->SetHTMLFooter('
            <div width="100%" style="float:left; font-size:12px; text-align:center;">
                <div style="text-align: right;">
                    <p style="padding:0px; margin-top: 5px;margin-bottom: 0px;"><b>Generated by:</b> '." ".''.$user->name.''." ".'('.date('l jS \\of F Y h:i:s A').')</p>
                </div>
            </div>');
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

}
