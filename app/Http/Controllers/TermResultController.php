<?php

namespace App\Http\Controllers;

use App\LevelEnroll;
use App\User;
use App\Term;
use App\Session;
use App\Section;
use App\SectionStudent;
use App\SectionSubjectTeacher;
use App\TermResult;
use App\TermResultDistribution;
use App\Student;
use App\Subject;
use App\Level;
use DB;
use Illuminate\Http\Request;
use Auth;

class TermResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        if(in_array(\Route::currentRouteName(), ['term_results.showStudents'])){
             $this->middleware(function ($request, $next) {
            if(env('ROLE_ENABLE',0) == 1){                
                if (!$request->user()->hasPermission($request->route()->action['as'])){
                    return redirect('warning');
                }
            }
            return $next($request);
        });
        }
    }
    public function index()
    {
        $term_results = TermResult::all();
        return view('admin.term_results.index', ['term_results' => $term_results]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function searchForBlankResult(){
        $sessions = Session::with('level_enroll.level', 'level_enroll.section')->get();
        $level_enrolls = LevelEnroll::with('section')->get();
        $sections = Section::pluck('section_name', 'id');
        $terms = Term::pluck('term_name', 'id');
        return view('admin.blank_result.blank_result_index', [
            'sections' => $sections, 'sessions' => $sessions, 'level_enrolls' => $level_enrolls,
            'terms' => $terms
            ]);
    }
    public function view_subjects(Request $request){
        $section_id = $request->section_id;
        $session_id = $request->session_id;
        $term_id = $request->term_id;
        $level_id = $request->level_id;


        $SectionSubjectTeacher = SectionSubjectTeacher::where('section_id', $section_id)->get();
      
        return view('admin.blank_result.blank_result_generate', [
            'term_id'=> $term_id, 'session_id'=> $session_id,
            'section_id' =>  $section_id, 'level_id'=> $level_id,
            'sectionSubjectTeacher' => $SectionSubjectTeacher
            ]);

    }
    public function blankResultPdf(Request $request){
        $section_id = $request->section_id;
        $session_id = $request->session_id;
        $term_id = $request->term_id;
        $level_id = $request->level_id;
        $subject_id =$request->subject_id;

        $term = Term::find($term_id);
        $section = Section::find($section_id);
        $level = Level::find($level_id);
        $session = Session::find($session_id);

        $sst = SectionSubjectTeacher::where('subject_id', $subject_id)->where('section_id', $section_id)->first();
       
        $students = SectionStudent::where('section_id', $section_id)->orderBy('roll', 'ASC')->get();

        $mpdf = new \Mpdf\Mpdf();
        $html = view('admin.blank_result.blank_result_pdf', [
            'term'=> $term, 'session'=> $session,
            'section' =>  $section, 'level'=> $level,
            'students'=>$students, 'section_subject_teacher'=> $sst
            ]);
        $mpdf->WriteHTML($html);
        $mpdf->Output();



    }


    public function searchForTermResult(){
        $sessions = Session::with('level_enroll.level', 'level_enroll.section')->get();
        $level_enrolls = LevelEnroll::with('section')->get();
        $sections = Section::pluck('section_name', 'id');
        $terms = Term::pluck('term_name', 'id');
        return view('admin.term_results.result_index', [
            'sections' => $sections, 'sessions' => $sessions, 'level_enrolls' => $level_enrolls,
            'terms' => $terms
            ]);
    }
    public function viewAll(Request $request){
        $section_id = $request->section_id;
        $session_id = $request->session_id;
        $term_id = $request->term_id;
        $student_id = $request->student_id;
        $level_id = $request->level_id;


        $sections = Section::find($session_id);
        $student = Student::find($student_id);
        $sessions = Session::find($session_id);
        $terms = Term::find($term_id);

        $SectionSubjectTeacher = SectionSubjectTeacher::where('section_id', $section_id)->get();
        $section_student = SectionStudent::where('student_id', $student_id)->get();

        return view('admin.term_results.submit_result', [
            'sections' => $sections, 'sessions' => $sessions, 'term_id'=> $term_id, 'session_id'=> $session_id,
            'student'=>$student, 'section_id' =>  $section_id, 'level_id'=> $level_id,
            'terms' => $terms, 'sectionSubjectTeacher' => $SectionSubjectTeacher, 'section_student' => $section_student
            ]);

    }
    public function generateTermResult(Request $request){
        echo "generate";
    }

    public function submitTermResult(Request $request){
        $term_id = $request->term_id;
        $student_id = $request->student_id;
        $section_id = $request->section_id;
        $session_id = $request->session_id;
        $level_id = $request->level_id;
        $section_student = SectionStudent::where('student_id', $student_id)->
        where('section_id', $section_id)->first();

        $sid = $section_student->id;

        $term_res= TermResult::where('term_id',$term_id)->where('section_student_id',$sid)->count(); 
        $i=0;
        foreach ($request->subject_id as $subid) {

            $SectionSubjectTeacher = SectionSubjectTeacher::where('section_id', $section_id)->
            where('subject_id', $subid)->first();

            $tr = TermResult::where('section_subject_teacher_id',$SectionSubjectTeacher->id)->where('section_student_id',$sid)->
            where('term_id', $term_id)->count();

            
            if($tr>0){
                $term_results = TermResult::where('section_subject_teacher_id',$SectionSubjectTeacher->id)->where('section_student_id',$sid)->
                where('term_id', $term_id)->first();
                $term_results->term_marks = $request->term_marks[$i];
                $term_results->taken_term_marks = 100;
                $term_results->weekly_avg = 0;
                $term_results->total_marks =  $request->term_marks[$i];
                $term_results->update();
            }
            else{
                $term_results = new TermResult;
                $term_results->term_marks = $request->term_marks[$i];
                $term_results->taken_term_marks = 100;
                $term_results->weekly_avg = 0;
                $term_results->total_marks =  $request->term_marks[$i];
                $term_results->section_student_id = $section_student->id;
                $term_results->section_subject_teacher_id =  $SectionSubjectTeacher->id;
                $term_results->term_id =  $term_id;
                $term_results->save();
            }

            $ssd = TermResultDistribution::where('term_result_id',$term_results->id)->count();
            if($ssd>0){
                $term_result_distribution = TermResultDistribution::where('term_result_id',$term_results->id)->first();
                $term_result_distribution->written_mark= $request->written_marks[$i];
                $term_result_distribution->mcq_mark= $request->mcq_marks[$i];
                $term_result_distribution->pactical_mark= $request->pactical_marks[$i];
                $term_result_distribution->update();

            }
            else{
                $term_result_distribution = new TermResultDistribution;
                $term_result_distribution->term_result_id= $term_results->id;
                $term_result_distribution->written_mark= $request->written_marks[$i];
                $term_result_distribution->mcq_mark= $request->mcq_marks[$i];
                $term_result_distribution->pactical_mark= $request->pactical_marks[$i];
                $term_result_distribution->save();
            }
            
            $i++;
        }
      
        $section_students = SectionStudent::where('section_id', $section_id);
        $section_students = $section_students->get();

        return view('admin.term_results.view_students', [
            'section_students' => $section_students, 
            'term_id' => $term_id,
            'section_id' => $section_id,
            'level_id' => $level_id,
            'session_id' => $session_id
            ]);

    }
    


    public function showStudents(Request $request) {
     //   $user = User::with('teacher')->findOrFail(Auth::user()->id);
        $section_id = $request->section_id;
        $session_id = $request->session_id;
        $level_id = $request->level_id;
      //  $teacher_id = ($user->teacher != NULL)? $user->teacher->id:0;
        //dd($section_id);
        // if($user->hasPermission('term_results.showStudents')){
        //     $section_students = SectionStudent::where('section_students.section_id', $section_id);
        //     $section_students->whereHas('section.level_enroll', function ($section_students) use ($session_id) {
        //         $section_students->where(['session_id' => $session_id]);
        //     });
        //     $section_students = $section_students->get();
        //     $section_subject_teachers = SectionSubjectTeacher::where('section_id', $section_id)
        //     ->get();
        // }
        // else{

        //     $ss =  SectionStudent::where('section_students.section_id', $section_id);
            
        //     $ss->whereHas('section.level_enroll', function ($ss) use ($session_id) {
        //         $ss->where(['session_id' => $session_id]);
        //     });

        //     $ss->where(function($ss) use ($teacher_id, $section_id, $level_id){
        //         $ss->whereHas('section', function ($ss) use ($teacher_id, $section_id){
        //             $ss->where(['teacher_id' => $teacher_id]);
        //             $ss->where(['id' => $section_id]);
        //         });
        //         $ss->whereHas('section.level_enroll', function ($ss) use ($level_id){
        //             $ss->where(['level_id' => $level_id]);
        //         });
        //     });

        //     $ss->orWhere(function($ss) use ($teacher_id, $section_id, $level_id){
        //         $ss->whereHas('section.section_subject_teacher', function ($ss) use ($teacher_id, $section_id){
        //             $ss->where(['teacher_id' => $teacher_id]);
        //             $ss->where(['section_id' => $section_id]);
        //         });

        //         $ss->whereHas('section.level_enroll', function ($ss) use ($level_id){
        //             $ss->where(['level_id' => $level_id]);
        //         });
        //     });

        //     $section_students = $ss->get();
        //     //dd($section_students);
        //     $section_subject_teachers = SectionSubjectTeacher::join('sections','sections.id' ,'=' , 'section_subject_teachers.section_id')
        //         ->join('level_enrolls','level_enrolls.id' ,'=' , 'sections.level_enroll_id')
        //         ->where(['section_subject_teachers.section_id' => $section_id,  'section_subject_teachers.teacher_id' => $teacher_id, 'level_enrolls.level_id' => $level_id])
        //         ->orWhere(function($query) use ($teacher_id, $section_id, $level_id) {
        //             $query->where(['sections.teacher_id' => $teacher_id, 'sections.id' => $section_id, 'level_enrolls.level_id' => $level_id]);   
        //         })
        //         ->select('section_subject_teachers.id', 'section_subject_teachers.subject_id', 'section_subject_teachers.teacher_id', 'section_subject_teachers.section_id')
        //         ->get();
        // }
        //dd($section_students);
        $term_id = $request->term_id;
        //$subjects = Subject::all();


        $section_students = SectionStudent::where('section_id', $section_id);
            $section_students = $section_students->get();

             //echo $section_students;
        $count = SectionStudent::where('section_id', $section_id)->count();
        if($count>0){
            return view('admin.term_results.view_students', [
                'section_students' => $section_students, 
                'term_id' => $term_id,
                'section_id' => $section_id,
                'level_id' => $level_id,
                'session_id' => $session_id
            ]);
        }
        else{
            return view('admin.term_results.view_students_error', [
                'section_students' => $section_students, 
                'term_id' => $term_id,
                'section_id' => $section_id,
                'level_id' => $level_id,
                'session_id' => $session_id
            ]);  
        }
        
    }
    public function viewStudents(Request $request) {
        $section_id = $request->section_id;
        $session_id = $request->session_id;
        $level_id = $request->level_id;

        $term_id = $request->term_id;

        $section_students = SectionStudent::where('section_id', $section_id);
            $section_students = $section_students->get();

        return view('admin.term_results.show-students', [
            'section_students' => $section_students, 
            'term_id' => $term_id,
            'section_id' => $section_id,
            'level_id' => $level_id,
            'session_id' => $session_id
            ]);

    }
    public function singleView(Request $request) {
        $term_id = $request->term_id;
        $student_id = $request->student_id;
        $section_id = $request->section_id;
        $session_id = $request->session_id;
        $section_student = SectionStudent::where('student_id', $student_id)->
        where('section_id', $section_id)->first();

        $term_results = TermResult::where('section_student_id', $section_student->id)
        ->where('term_id', $term_id)
        ->get();
        //dd($term_results);
        return view('admin.term_results.index', ['term_results' => $term_results,'session_id' => $session_id]);


    }
    
}
