<?php

namespace App\Http\Controllers;

use App\LevelEnroll;
use App\Level;
use App\Session;
use App\Section;
use App\SectionStudent;
use App\TermResult;
use App\FinalResult;
use App\FinalReport;
use App\Student;
use App\User;
use Auth;
use Validator;
use Illuminate\Http\Request;

class FinalReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        //dd(\Route::currentRouteName());
        if(!in_array(\Route::currentRouteName(), ['finalReports.processSpecificStudents', 'finalReports.viewStudents', 'finalReports.processStudents', 'finalReports.reProcessStudents'])){ 
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
        $sessions = Session::with('level_enroll.level', 'level_enroll.section','level_enroll.shift')->get();
        $levels = Level::with('level_enroll.section')->get();
        $sections = Section::pluck('section_name', 'id');
        // dd($levels);
        return view('admin.final_reports.index', [
            'sections' => $sections, 'sessions' => $sessions, 'levels' => $levels]);
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
        $section_students = SectionStudent::where('section_id', $id)->orderBy('roll')->get();
        //dd($section_students);
        return view('admin.final_report_view.view_students', ['section_students' => $section_students]);
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

    public function viewStudents(Request $request) {
        $section_id = $request->section_id;
        $session_id = $request->session_id;
        $user = User::with('teacher')->findOrFail(Auth::user()->id);
        //dd($user);
        $teacher_id = ($user->teacher != NULL)? $user->teacher->id:0;
        $processor = $user->name;
        $ss = SectionStudent::with('section.section_subject_teacher');
        $ss->whereHas('section.level_enroll', function ($ss) use ($session_id) {
            $ss->where(['session_id' => $session_id]);
        });

        if(!($user->hasPermission('finalReports.viewStudents'))){ 
            $ss->whereHas('section', function ($ss) use ($teacher_id) {
                $ss->where(['teacher_id' => $teacher_id]);
            });
        }
        
        $ss->where(['section_id' => $section_id]);
        $section_students = $ss->get();
        $final_result = FinalResult::where('section_id', $section_id)
                                    ->where('processor', $processor)
                                    ->get();

        if(count($final_result) > 0) {
            $section_students = SectionStudent::where('section_id',$section_id)->orderBy('roll')->get();
            $count_student = SectionStudent::where('section_id',$section_id)->count();
            return view('admin.final_reports.view_students', ['section_id' => $section_id,
            'section_students' => $section_students, 'count_student'=>$count_student]);
        }
        else {
            $section_students = SectionStudent::where('section_id',$section_id)->orderBy('roll')->get();
            return view('admin.final_reports.generate_students_result', ['section_id' => $section_id,
            'section_students' => $section_students]);
        }
        
    }

    public function processStudents(Request $request) {
        $student_ids = $request->student_ids;
        $section_id = $request->section_id;
        $processor = request()->user()->name;

        
        $final_result = FinalResult::where(['section_id' => $section_id])->count();
        if($final_result == 0){
            $data = $this->processResult($student_ids, $section_id, $processor);
            FinalReport::insert($data);
        }

        return redirect('/final_reports/'.$section_id);
    }

    private function processResult($student_ids, $section_id, $processor){
        $data = [];
        $final_result = FinalResult::create(['section_id' => $section_id, 'processor' => $processor]);
        foreach ($student_ids as $student_id) {
            /*main data*/
            $tr = TermResult::query();
            $tr->whereHas('section_student', function($tr) use ($student_id, $section_id){
                $tr->where(['student_id' => $student_id, 'section_id' => $section_id]);
            });
            $term_results = $tr->orderBy('section_student_id', 'DESC')->get();
            /*end main data*/

            $section_subject_teacher_id = $term_results->pluck('section_subject_teacher_id')->toArray();
            $section_subject_teacher_id_array = array_unique($section_subject_teacher_id);

            foreach ($section_subject_teacher_id_array as $section_subject_teacher_id) {

                $term_result_count = $term_results->where('section_subject_teacher_id', $section_subject_teacher_id)->groupBy('term_id')->count();

                $term_marks = $term_results->where('section_subject_teacher_id', $section_subject_teacher_id)->sum('total_marks');

                $subject_marks = $term_marks/$term_result_count;
                $data[] = [
                    'student_id' => $student_id,
                    'final_result_id' => $final_result->id,
                    'section_subject_teacher_id' => $section_subject_teacher_id,
                    'subject_marks' => $subject_marks
                ];
                $term_results = $tr->orderBy('section_student_id', 'DESC')->get();

                /*******************/
                $validation = Validator::make([
                    'section_subject_teacher_id' => $section_subject_teacher_id,
                    'subject_marks' => $subject_marks,
                    'student_id' => $student_id
                    ],[],[]
                );

                $validation->after(function ($validation) use($section_subject_teacher_id, $subject_marks, $student_id){
                    $checkCombination = FinalReport::where('section_subject_teacher_id', $section_subject_teacher_id)
                    ->where('subject_marks', $subject_marks)
                    ->where('student_id', $student_id)
                    ->get();
                    if (count($checkCombination) > 0) {
                        $validation->errors()->add('section_subject_teacher_id', 'Class already exists, please choose another class.')
                        ->add('subject_marks', 'Session already exists, please choose another session.')
                        ->add('student_id', 'Shift already exists, please choose another shift.');
                    }                                

                });

                if ($validation->fails()) {
                    foreach ($validation->errors()->all() as $error) {
                        $message = $error;
                        return redirect('/final_reports/'.$section_id);
                    }

                }
            }
        }

        return $data;
    }

    //reProcessStudents

    public function reProcessStudents(Request $request) {
        $student_ids = $request->student_ids;
        $section_id = $request->section_id;
        $processor = request()->user()->name;
        
        $final_result = FinalResult::where('section_id' , $section_id)->first();
        FinalReport::where('final_result_id' , $final_result->id)->delete();
        $final_result->delete();
        
        $data = $this->processResult($student_ids, $section_id, $processor);
        FinalReport::insert($data);
        return redirect('/final_reports/'.$section_id);
    }

    public function processSpecificStudents($id) {
        $student_id = $id;
        $student = Student::find($student_id);
        $section_student_id = SectionStudent::where('student_id', $student_id)->get()->first()->id;
        $section = Section::find(SectionStudent::find($section_student_id)->section_id);
        $level_enroll = LevelEnroll::find($section->level_enroll_id);
        $level = Level::find($level_enroll->level_id);
        $session = Session::find($level_enroll->session_id);

        $fr = FinalReport::where('student_id', $student_id);
       /* $fr->whereHas('section.level_enroll', function ($fr) use ($session_id) {
            $fr->where(['session_id' => $session_id]);
        });

        if(!($user->hasPermission('finalReports.viewStudents'))){ 
            $fr->whereHas('section', function ($fr) use ($teacher_id) {
                $fr->where(['teacher_id' => $teacher_id]);
            });
        }*/

        $final_reports = $fr->get();
        $count_freport = FinalReport::where('student_id', $student_id)->count();

        return view('admin.final_report_view.view_student_final_report', 
        [
        'final_reports' => $final_reports, 'student' => $student, 'section' => $section, 'session' => $session,
        'level' => $level, 'count_freport' => $count_freport
        ]);
    }
    
}
