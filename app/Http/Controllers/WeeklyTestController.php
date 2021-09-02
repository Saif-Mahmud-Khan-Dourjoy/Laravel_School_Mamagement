<?php

namespace App\Http\Controllers;

use App\LevelEnroll;
use App\Level;
use App\User;
use App\Session;
use App\Section;
use App\Subject;
use App\Student;
use App\WeeklyTest;
use App\SectionSubjectTeacher;
use App\StudentSubjectResult;
use App\SectionStudent;
use App\TermResult;
use App\SelectedId;
use App\FinalResult;
use App\SectionSubjectTermMark;
use Auth;
use Validator;
use App\Term;
use PDF;
use DB;

use Illuminate\Http\Request;

class WeeklyTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        if(in_array(\Route::currentRouteName(), ['weeklyTests.index','weeklyTests.store', 'weeklyTests.update','weeklyTests.show','weeklyTests.edit','weeklyTests.destroy'])){ 
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

    public function index() {
        $sessions = Session::with('level_enroll.level', 'level_enroll.section')->get();
        $level_enrolls = LevelEnroll::with('section')->get();
        $sections = Section::pluck('section_name', 'id');
        $terms = Term::pluck('term_name', 'id');
        return view('admin.weekly_tests.index', [
            'sections' => $sections, 'sessions' => $sessions, 'level_enrolls' => $level_enrolls,
            'terms' => $terms
            ]);
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
     * @param  \App\WeeklyTest  $weeklyTest
     * @return \Illuminate\Http\Response
     */
    public function show(WeeklyTest $weeklyTest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request) {
        $weekly_test = StudentSubjectResult::findOrFail($id);
        $student_subject_results = StudentSubjectResult::where(['weekly_test_number' => $weekly_test->weekly_test_number, 'term_id' => $weekly_test->term_id, 'section_subject_teacher_id' => $weekly_test->section_subject_teacher_id])->get();
        
        $term = Term::findOrFail($weekly_test->term_id);
        $section_subject_teacher = SectionSubjectTeacher::with('subject', 'section')->find($weekly_test->section_subject_teacher_id);

        $wt_mark = SectionSubjectTermMark::where('section_subject_teacher_id', $section_subject_teacher->id)->first();

        return view('admin.weekly_tests.edit', compact('section_subject_teacher','student_subject_results','wt_mark', 'term', 'weekly_test'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $term_id = $request->term_id;
        $section_subject_teacher_id = $request->section_subject_teacher_id;
        $section_subject_teacher = SectionSubjectTeacher::find($section_subject_teacher_id);

        $student_subject_result_id  = $request->student_subject_result_id;
        $marks  = $request->marks;
        $request = [
                'term_id' => $term_id, 
                'section_id' => $section_subject_teacher->section_id, 
                'level_id' => $section_subject_teacher->subject_id,
                'section_subject_teacher_id' => $section_subject_teacher_id, 
            ];
            try{
                for ($i=0; $i< count($student_subject_result_id) ; $i++) {
                    $ssr = StudentSubjectResult::find($student_subject_result_id[$i]);
                    $ssr->wt_mark = $request->set_test_marks;
                    $ssr->weekly_test_marks = $marks[$i];
                    $ssr->update();
                }
            }
            catch(\Exception $e){
                return redirect()->action('WeeklyTestController@proceedWithSubject', $request)->with('warning', 'This WeeklyTest data has already processed');
            }

        return redirect()->action('WeeklyTestController@proceedWithSubject', $request)->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id, Request $request) {
        $weekly_test = StudentSubjectResult::findOrFail($id);
        try{
            StudentSubjectResult::where(['weekly_test_number' => $weekly_test->weekly_test_number, 'term_id' => $weekly_test->term_id, 'section_subject_teacher_id' => $weekly_test->section_subject_teacher_id])->delete();
        }
        catch (\Exception $e) {
            return redirect()->back()->with('warning', 'This test has already processed');
        }

        return redirect()->back()->with('success', 'Deleted Successfully');
    }

    public function showSubjects(Request $request) {
        $user = User::with('teacher')->findOrFail(Auth::user()->id);
        $section_id = $request->section_id;
        $session_id = $request->session_id;
        $level_id = $request->level_id;
        $teacher_id = ($user->teacher != NULL)? $user->teacher->id:0;
        //dd($section_id);
        if($user->hasPermission('weeklyTests.showSubjects')){
            $section_students = SectionStudent::where('section_students.section_id', $section_id);
            $section_students->whereHas('section.level_enroll', function ($section_students) use ($session_id) {
                $section_students->where(['session_id' => $session_id]);
            });
            $section_students = $section_students->get();
            $section_subject_teachers = SectionSubjectTeacher::where('section_id', $section_id)
            ->get();
        }
        else{

            $ss =  SectionStudent::where('section_students.section_id', $section_id);
            
            $ss->whereHas('section.level_enroll', function ($ss) use ($session_id) {
                $ss->where(['session_id' => $session_id]);
            });

            $ss->where(function($ss) use ($teacher_id, $section_id, $level_id){
                $ss->whereHas('section', function ($ss) use ($teacher_id, $section_id){
                    $ss->where(['teacher_id' => $teacher_id]);
                    $ss->where(['id' => $section_id]);
                });
                $ss->whereHas('section.level_enroll', function ($ss) use ($level_id){
                    $ss->where(['level_id' => $level_id]);
                });
            });

            $ss->orWhere(function($ss) use ($teacher_id, $section_id, $level_id){
                $ss->whereHas('section.section_subject_teacher', function ($ss) use ($teacher_id, $section_id){
                    $ss->where(['teacher_id' => $teacher_id]);
                    $ss->where(['section_id' => $section_id]);
                });

                $ss->whereHas('section.level_enroll', function ($ss) use ($level_id){
                    $ss->where(['level_id' => $level_id]);
                });
            });

            $section_students = $ss->get();
            //dd($section_students);
            $section_subject_teachers = SectionSubjectTeacher::join('sections','sections.id' ,'=' , 'section_subject_teachers.section_id')
                ->join('level_enrolls','level_enrolls.id' ,'=' , 'sections.level_enroll_id')
                ->where(['section_subject_teachers.section_id' => $section_id,  'section_subject_teachers.teacher_id' => $teacher_id, 'level_enrolls.level_id' => $level_id])
                ->orWhere(function($query) use ($teacher_id, $section_id, $level_id) {
                    $query->where(['sections.teacher_id' => $teacher_id, 'sections.id' => $section_id, 'level_enrolls.level_id' => $level_id]);   
                })
                ->select('section_subject_teachers.id', 'section_subject_teachers.subject_id', 'section_subject_teachers.teacher_id', 'section_subject_teachers.section_id')
                ->get();
        }
        //dd($section_students);
        $term_id = $request->term_id;
        //$subjects = Subject::all();
        return view('admin.weekly_tests.subjectList', [
            'section_subject_teachers' => $section_subject_teachers, 'section_students' => $section_students, 
            'term_id' => $term_id,
            'section_id' => $section_id,
            'level_id' => $level_id,
            'session_id' => $session_id
            ]);
    }


    public function proceedWithSubject(Request $request) {

        $section_subject_teacher_id = $request->section_subject_teacher_id;
        $term_id = $request->term_id;
        $section_id = $request->section_id;
        $level_id = $request->level_id;
        $section_subject_teacher = SectionSubjectTeacher::find($section_subject_teacher_id);

        $student_subject_results = StudentSubjectResult::where(['section_subject_teacher_id' =>
            $section_subject_teacher_id, 'term_id' => $term_id]);
        $student_subject_results->whereHas('section_subject_teacher', function($student_subject_results) use($section_id, $level_id){
            $student_subject_results->where(['subject_id' => $level_id, 'section_id' => $section_id]);
        });

        $student_subject_results = $student_subject_results->with('section_subject_teacher.subject')->groupBy('weekly_test_number')->get();
        $subject = Subject::findOrFail($level_id);
        return view('admin.weekly_tests.choose_num', 
            ['sec_sub_teach' => $section_subject_teacher, 'student_subject_results' => $student_subject_results, 
            'term_id' => $term_id,'level_id' => $level_id,'section_id' => $section_id, 'subject' => $subject]);
    }

    public function proceedWithTestNumber(Request $request) {
       
        $check  = StudentSubjectResult::where(['term_id' => $request->term_id, 'weekly_test_number' => $request->weekly_test_number, 'section_subject_teacher_id' => $request->sec_sub_teach_id])->get();
        if(count($check) == 0){
            $section_subject_teacher_id = $request->sec_sub_teach_id;
            $term = Term::findOrFail($request->term_id);
            $section_subject_teacher = SectionSubjectTeacher::with('subject', 'section')->find($section_subject_teacher_id);
            $section_id = $section_subject_teacher->section_id;
            $section_students = SectionStudent::where('section_id', $section_id)->get();
            $weekly_test_number = $request->weekly_test_number;
            $wt_mark = SectionSubjectTermMark::where('section_subject_teacher_id', $section_subject_teacher->id)->first();
            return view('admin.weekly_tests.mark', [
                'sec_sub_teach' => $section_subject_teacher, 'weekly_test_number' => $weekly_test_number,
                'section_students' => $section_students,'wt_mark' => $wt_mark, 'term' => $term
                ]);
        }
        else{
            return redirect()->back()->with('warning', 'This WeeklyTest Number Has already exist!!');
        }
    }

    public function subjectWiseResult() {

        $student_subject_result = StudentSubjectResult::all();
        $section_subject_teacher_id = $student_subject_result->first()->section_subject_teacher_id;
        $section_subject_teacher = SectionSubjectTeacher::find($section_subject_teacher_id);
        $section_id = $section_subject_teacher->section_id;
        $section_subject_teacher = SectionSubjectTeacher::where('section_id', $section_id)->get();
        //dd($section_subject_teacher);
        return view('admin.weekly_tests.subject_wise_result',
            ['section_subject_teacher' => $section_subject_teacher]);
    }

    public function viewSubjectWiseResult(Request $request) {

        $section_subject_teacher_id = $request->section_subject_teacher_id;
        $section_subject_teacher = SectionSubjectTeacher::find($section_subject_teacher_id);
        $subject = Subject::find($section_subject_teacher->subject_id);
        //dd($subject);
        $student_subject_result = StudentSubjectResult::where
        ('section_subject_teacher_id', $section_subject_teacher_id)
        ->get();
        //dd($student_subject_result);
        return view('admin.weekly_tests.view_subject_wise_result',
            ['student_subject_result' => $student_subject_result, 'subject' => $subject]);
    }

    public function viewNumberWiseResult($id) {
        $student_subject_result = StudentSubjectResult::findOrFail($id);
        if ($student_subject_result != null) {
            $section_subject_teacher_id = $student_subject_result->section_subject_teacher_id;
            $term_id = $student_subject_result->term_id;
            $term = Term::findOrFail($term_id);
            $weekly_test_number = $student_subject_result->weekly_test_number;
            
            $student_subject_results = 
            StudentSubjectResult::where('section_subject_teacher_id', $section_subject_teacher_id)
            ->where('weekly_test_number', $weekly_test_number)
            ->where('term_id', $term_id)
            ->with('section_subject_teacher.subject')
            ->with('student')
            ->get();

            return view('admin.weekly_tests.number_wise_result', 
            ['student_subject_results' => $student_subject_results, 'weekly_test_number' => $weekly_test_number, 'term' => $term,
            'sec_sub_teach_id' => $section_subject_teacher_id, 'ssr_id' => $id]);
        }
        
    }

    public function updateMarks(Request $request) {

        $data = $request->only('weekly_test_marks');
        $student_subject_result_id = $request->student_subject_result_id;
        $term_id = $request->term_id;
        $term = Term::find($term_id);
        $weekly_test_number = $request->weekly_test_number;
        $section_subject_teacher_id = $request->section_subject_teacher_id;
        $student_subject_results = 
        StudentSubjectResult::where('section_subject_teacher_id', $section_subject_teacher_id)
        ->where('weekly_test_number', $weekly_test_number)
        ->get();
        //$student_subject_result_id = $request->student_subject_result_id;
        $student_subject_result = StudentSubjectResult::find($student_subject_result_id);
        $student_subject_result -> update($data);

        $student_subject_results = 
        StudentSubjectResult::where('section_subject_teacher_id', $section_subject_teacher_id)
        ->where('weekly_test_number', $weekly_test_number)
        ->where('term_id', $term_id)
        ->get();
        return view('admin.weekly_tests.number_wise_result',
            ['student_subject_results' => $student_subject_results, 
            'weekly_test_number' => $weekly_test_number, 'term' => $term,
            'sec_sub_teach_id' => $section_subject_teacher_id]);

    }

    public function deleteResult(Request $request) {

        $student_subject_result_id = $request->student_subject_result_id;
        $ekta_habijabi = StudentSubjectResult::find($student_subject_result_id);
        $weekly_test_number = $ekta_habijabi->weekly_test_number;
        $section_subject_teacher_id = $request->sec_sub_teach_id;
        //dd($section_subject_teacher_id);
        $student_subject_results = 
        StudentSubjectResult::where('section_subject_teacher_id', $section_subject_teacher_id)
        ->where('weekly_test_number', $weekly_test_number)
        ->get(); 
        $ekta_habijabi->delete();  
        //$section_subject_teacher_id = $student_subject_result->section_subject_teacher_id;
        //$weekly_test_number = $student_subject_result->weekly_test_number;
        /*$student_subject_results = StudentSubjectResult::where('weekly_test_number', $weekly_test_number)
        ->where('section_subject_teacher_id', $student_subject_result->section_subject_teacher_id)
        ->get();*/

        return view('admin.weekly_tests.number_wise_result', 
            ['student_subject_results' => $student_subject_results, 
            'weekly_test_number' => $weekly_test_number,
            'sec_sub_teach_id' => $section_subject_teacher_id]);
    }


    public function storeMarks(Request $request) {
        for ($i = 0; $i < count($request->student_id); $i++) {

            $student_id = $request->student_id[$i];
            $weekly_test_number = $request->weekly_test_number[$i];
            $section_subject_teacher_id = $request->section_subject_teacher_id[$i];
            $marks = $request->marks[$i];
            $wt_mark = $request->set_test_marks;
            $term_id = $request->term_id;
            $data = [
                'student_id' => $student_id,
                'weekly_test_number' => $weekly_test_number,
                'section_subject_teacher_id' => $section_subject_teacher_id,
                'weekly_test_marks' => $marks,
                'wt_mark' => $wt_mark,
                'term_id' => $term_id,
            ];
            
            /**********/

            $validation = Validator::make([
                'student_id' => $student_id, 
                'weekly_test_number' => $weekly_test_number,
                'section_subject_teacher_id' => $section_subject_teacher_id,
                'term_id' => $term_id
                ], [], []);
            $validation->after(function ($validation) 
                use($student_id, $weekly_test_number, $section_subject_teacher_id, $term_id) {
            $checkCombination = StudentSubjectResult::where('student_id', $student_id)
            ->where('weekly_test_number', $weekly_test_number)
            ->where('section_subject_teacher_id', $section_subject_teacher_id)
            ->where('term_id', $term_id)
            ->get();

            if (count($checkCombination) > 0) {
                    $validation->errors()
                    ->add('student_id', 'Student result already exists')
                    ->add('weekly_test_number', 'Test already exists')
                    ->add('section_subject_teacher_id', 'Subject already exists');
                }                                
            });

            if ($validation->fails()) {
                foreach ($validation->errors()->all() as $error) {
                    $message = $error;
                }
            
            }   
            else {
                $student_subject_result = StudentSubjectResult::create($data); 
            }

            /**********/
            
            
        }

        return redirect('weekly_test/view_by_number/'. $student_subject_result->id)->with('warning', 'This test has already processed');
    }


    public function viewStudentWiseResult(Request $request) {
        $student_id = $request->student_id;
        $term_id = $request->term_id;
        $student = Student::find($student_id);
        $session_id = $request->session_id;
        $user = User::with('teacher')->findOrFail(Auth::user()->id);
        $teacher_id = ($user->teacher != NULL)? $user->teacher->id:0;
        $ssr = StudentSubjectResult::where('student_id', $student_id)->where('term_id', $term_id);
        $ssr->whereHas('section_subject_teacher.section.level_enroll', function ($ssr) use ($session_id) {
            $ssr->where(['session_id' => $session_id]);
        });
        
        if(!$user->hasPermission('weeklyTests.viewStudentWiseResult')){
            $ssr->whereHas('section_subject_teacher.section.level_enroll', function ($ssr) use ($session_id) {
                $ssr->where(['session_id' => $session_id]);
            });
        }

        $ssr->orderBy('weekly_test_number', 'DESC');
        $student_subject_results = $ssr->get();
        //dd($student_subject_results);
        // regeneration code testing starts after this line 
        $section_students = SectionStudent::where('student_id', $student_id)->get();

        $section_student = $section_students->first();
        $section_id = $section_student->section_id;
        $section_student = SectionStudent::where('student_id', $student_id)
                                        ->where('section_id', $section_id)
                                        ->get()
                                        ->first();
        $section_student_id = $section_student->id;
        $checkCombination = TermResult::where('section_student_id', $section_student_id)
        ->where('term_id', $term_id)
        ->get();
        //dd($checkCombination);
        $term_results = TermResult::where('section_student_id', $section_student_id)->where('term_id', $term_id)->get();
        //dd($term_results);
        $isGenerated = false;
        if (count($term_results) > 0) {
            $isGenerated = true;
            $section_subject_teacher_id = $student_subject_results->first()->section_subject_teacher_id;
            $section_subject_teacher = SectionSubjectTeacher::find($section_subject_teacher_id);
            $section = Section::find($section_subject_teacher->section_id);
            $session = Session::find(LevelEnroll::find($section->level_enroll_id)->session_id);
            $level = Level::find(LevelEnroll::find($section->level_enroll_id)->level_id);
            //dd($student_subject_results);
            return view('admin.weekly_tests.view_student_wise_result', [
                'student_subject_results' => $student_subject_results, 'student' => $student,
                'session' => $session, 'section' => $section, 'level' => $level,
                'section_subject_teacher' => $section_subject_teacher,
                'term_id' => $term_id, 'session_id'=> $session_id, 'isGenerated' => $isGenerated
                ]);
        }
        else {
            $section_subject_teacher_id = $student_subject_results->first()->section_subject_teacher_id;
            $section_subject_teacher = SectionSubjectTeacher::find($section_subject_teacher_id);
            $section = Section::find($section_subject_teacher->section_id);
            $session = Session::find(LevelEnroll::find($section->level_enroll_id)->session_id);
            $level = Level::find(LevelEnroll::find($section->level_enroll_id)->level_id);
            //dd($student_subject_results);
            return view('admin.weekly_tests.generate_student_wise_result', [
                'student_subject_results' => $student_subject_results, 'student' => $student,
                'session' => $session, 'section' => $section, 'level' => $level,
                'section_subject_teacher' => $section_subject_teacher,
                'term_id' => $term_id,'session_id'=> $session_id, 'isGenerated' => $isGenerated
                ]);
        }
        //dd($student_subject_results);
        if (count($student_subject_results) > 0) {
            //dd($isGenerated);
            $section_subject_teacher_id = $student_subject_results->first()->section_subject_teacher_id;
            $section_subject_teacher = SectionSubjectTeacher::find($section_subject_teacher_id);
            $section = Section::find($section_subject_teacher->section_id);
            $session = Session::find(LevelEnroll::find($section->level_enroll_id)->session_id);
            $level = Level::find(LevelEnroll::find($section->level_enroll_id)->level_id);
            //dd($student_subject_results);
            return view('admin.weekly_tests.view_student_wise_result', [
                'student_subject_results' => $student_subject_results, 'student' => $student,
                'session' => $session, 'section' => $section, 'level' => $level,
                'section_subject_teacher' => $section_subject_teacher,
                'term_id' => $term_id, 'session_id'=> $session_id, 'isGenerated' => $isGenerated
                ]);
        }
        else {
            
        }
        
    }

    public function generateTermResult(Request $request) {
        
        $student_id = $request->student_id;
        $term_id = $request->term_id;
        $session_id = $request->session_id;
        
       
        
    }

    public function reGenerateTermResult(Request $request) {
        $student_id = $request->student_id;
        $term_id = $request->term_id;
        $session_id = $request->session_id;
        $user = User::with('teacher')->findOrFail(Auth::user()->id);
        $teacher_id = ($user->teacher != NULL)? $user->teacher->id:0;
        //dd($term_id);
        $student = Student::find($student_id);

        if($user->hasPermission('weeklyTests.generateTermResult')){
            $ssr = StudentSubjectResult::where(['student_id'=> $student_id, 'term_id' => $term_id])->with('section_subject_teacher.student_subject_term_mark');

            $ssr->whereHas('section_subject_teacher.section.level_enroll', function ($ssr) use ($session_id) {
                    $ssr->where(['session_id' => $session_id]);
                });
            $student_subject_results = $ssr->get();
        }
        else{
            
            $ssr = StudentSubjectResult::where(['student_id'=> $student_id, 'term_id' => $term_id])->with('section_subject_teacher.student_subject_term_mark');

            $ssr->whereHas('section_subject_teacher.section.level_enroll', function ($ssr) use ($session_id) {
                    $ssr->where(['session_id' => $session_id]);
                });

            $ssr->where(function($ssr) use ($teacher_id){
                $ssr->whereHas('section_subject_teacher', function ($ssr) use ($teacher_id){
                    $ssr->where(['teacher_id' => $teacher_id]);
                });
                $ssr->orWhereHas('section_subject_teacher.section', function ($ssr) use ($teacher_id){
                    $ssr->where(['teacher_id' => $teacher_id]);
                });
                
            });

            $student_subject_results = $ssr->get();
        
        }

        $section_subject_teacher_id = $student_subject_results
        ->pluck('section_subject_teacher_id', 'id');
        
        $array = $section_subject_teacher_id->toArray();
        $section_subject_teacher_id = array_unique($array);
        asort($section_subject_teacher_id);
        $section_student = SectionStudent::where('student_id', $student_id)->first();
        $section_id = $section_student->section_id;
        $section_student = SectionStudent::where('student_id', $student_id)
                                        ->where('section_id', $section_id)
                                        ->get()
                                        ->first();
        $section_student_id = $section_student->id;

        $check_final = FinalResult::where('section_id', $section_id)->count();

        if($check_final == 0){

            $old_tr = TermResult::where('section_student_id', $section_student_id)->where('term_id', $term_id);
            $old_tr->whereHas('section_subject_teacher.section.level_enroll', function ($old_tr) use ($session_id) {
                $old_tr->where(['session_id' => $session_id]);
            });
            $old_tr->delete();

            return view('admin.weekly_tests.generate_term_result', [
                'section_subject_teacher_ids' => $section_subject_teacher_id,
                'student' => $student, 'term_id' => $term_id,'session_id' => $session_id
                ]);
        }
        else{
            
            if($user->hasPermission('weeklyTests.generateTermResult')){
                $tr = TermResult::where('section_student_id', $section_student_id)->where('term_id', $term_id);
                $tr->whereHas('section_subject_teacher.section.level_enroll', function ($tr) use ($session_id) {
                    $tr->where(['session_id' => $session_id]);
                });
                $term_results = $tr->get();
            }
            else{
                $tr = TermResult::where('section_student_id', $section_student_id)->where('term_id', $term_id);
                $tr->whereHas('section_subject_teacher.section.level_enroll', function ($tr) use ($session_id) {
                    $tr->where(['session_id' => $session_id]);
                });

                $tr->where(function($tr) use ($teacher_id){
                    $tr->whereHas('section_subject_teacher', function ($tr) use ($teacher_id){
                        $tr->where(['teacher_id' => $teacher_id]);
                    });
                    $tr->orWhereHas('section_subject_teacher.section', function ($tr) use ($teacher_id){
                        $tr->where(['teacher_id' => $teacher_id]);
                    });

                });

                $term_results = $tr->get();
            }

            return view('admin.term_results.index', ['term_results' => $term_results,'session_id'=> $session_id])->with('message', 'This term result cannot be regenerated because final result is already generated');
        }
    }

    public function viewTermResult(Request $request) {
        $this_term_marks = [];
        $session_id = $request->session_id;
        $term_id = $request->term_id;
        $term_taken_mark = $request->set_term_marks;
        for ($i = 0; $i < count($request->section_subject_teacher_idRes); $i++) {
            $section_subject_teacher_id = $request->section_subject_teacher_idRes[$i];
            $this_term_marks[$i] = $request->term_marks[$section_subject_teacher_id];
            $marks_array = [];
            $sstm = SectionSubjectTermMark::where('section_subject_teacher_id', $section_subject_teacher_id)->first();
            $student_subject_result_id_array = [];
            $j=0;
            foreach ($request->student_subject_result_id[$section_subject_teacher_id] as $row) {
                $wt_convert_mark = ((isset($sstm) && $sstm->wt_convert_mark > 0) ? $sstm->wt_convert_mark:env('WT_CONVERT_MARK',30));
                $row['wt_mark'] = ($row['wt_mark'] > 0)?$row['wt_mark']:env('WT_MARK',15);
                $converted_weekly_marks = convert_marks($row['weekly_test_marks'], $row['wt_mark'], $wt_convert_mark , 0);
                $marks_array[$j++] = $converted_weekly_marks;
                $student_subject_result_id = $row['section_subject_result_id'];
                $student_subject_result_id_array[] = $student_subject_result_id;
            }

            $student_subject_result = StudentSubjectResult::find($student_subject_result_id);
            $student_id = $student_subject_result->student_id;
            $section_subject_teacher_id = $student_subject_result->section_subject_teacher_id;
            $section_subject_teacher = SectionSubjectTeacher::find($section_subject_teacher_id);
            $section_id = $section_subject_teacher->section_id;
            $section_student = SectionStudent::where('section_id', $section_id)
            ->where('student_id', $student_id)->get()->first();
            $section_student_id = $section_student->id;
            $average = array_sum($marks_array)/count($marks_array);
            $ht_convert_mark = ((isset($sstm) && $sstm->ht_convert_mark > 0) ? $sstm->ht_mark:env('HT_CONVERT_MARK',70));
            $term_adjusted = convert_marks($this_term_marks[$i], $term_taken_mark, $ht_convert_mark , 0);
            $term_total = $term_adjusted + $average;

            $data = [
                'term_marks' => $this_term_marks[$i],
                'weekly_avg' => $average, 
                'total_marks' => $term_total,
                'taken_term_marks' => $term_taken_mark,
                'section_student_id' => $section_student_id,
                'section_subject_teacher_id' => $section_subject_teacher_id, 
                'term_id' => $term_id
            ];

            $validation = Validator::make([
                'section_student_id' => $section_student_id, 
                'section_subject_teacher_id' => $section_subject_teacher_id,
                'term_id' => $term_id
                ], [], []
            );

            $validation->after(function ($validation) use($section_student_id, $section_subject_teacher_id, $term_id) {
            $checkCombination = TermResult::where('section_student_id', $section_student_id)
            ->where('section_subject_teacher_id', $section_subject_teacher_id)
            ->where('term_id', $term_id)
            ->get();

            if (count($checkCombination) > 0) {
                    $validation->errors()
                    ->add('section_student_id', 'Student result already exists')
                    ->add('section_subject_teacher_id', 'Subject already exists');
                }                                
            });

            if ($validation->fails()) {
                foreach ($validation->errors()->all() as $error) {
                    $message = $error;
                    $term_results = TermResult::where('section_student_id', $section_student_id)
                                                ->where('term_id', $term_id)
                                                ->get();
                    return view('admin.term_results.index', ['term_results' => $term_results,'session_id' => $session_id]);
                }
            
            }   
            else {
                $term_result = TermResult::create($data);
                for ($k = 0; $k < count($student_subject_result_id_array); $k++) {
                    $term_result_id = $term_result->id;
                    $student_subject_result_id = $student_subject_result_id_array[$k];
                    $selected_data = ['student_subject_result_id' => $student_subject_result_id, 
                    'term_result_id' => $term_result_id];
                    $selected_id = SelectedId::create($selected_data);
                }
            }
           
        }

        $term_results = TermResult::where('section_student_id', $section_student_id)
        ->where('term_id', $term_id)
        ->get();
        //dd($term_results);
        return view('admin.term_results.index', ['term_results' => $term_results,'session_id' => $session_id]);
    }

    public function viewTermReport(Request $request) {
        $term_result_ids = $request->term_result_id;
        //$term_result = TermResult::find($term_result_id);
        $term_results = TermResult::find($term_result_ids);
        //dd($term_results);
        return view('admin.term_results.index', ['term_results' => $term_results]);
    }

    public function downloadPDF() {
        $pdf = PDF::loadView('admin.term_results.index'); //load view page
        return $pdf->download('admin.term_results.index.pdf'); // download pdf file
    }

    public function download_wt_pdf($id){
        $ssr_result = StudentSubjectResult::with('section_subject_teacher.section.level_enroll.branch')->findOrFail($id);
        //dd($ssr_result);
        $section_subject_teacher_id = $ssr_result->section_subject_teacher_id;
        $term_id = $ssr_result->term_id;
        $term = Term::findOrFail($term_id);
        $weekly_test_number = $ssr_result->weekly_test_number;
        
        $student_subject_results = 
        StudentSubjectResult::where('section_subject_teacher_id', $section_subject_teacher_id)
        ->where('weekly_test_number', $weekly_test_number)
        ->where('term_id', $term_id)
        ->with('section_subject_teacher.subject')
        ->with('student')
        ->get();

        //dd($student_subject_results);
        $mpdf = new \Mpdf\Mpdf();
        $html = view('admin.report.weeklytest_pdf', ['student_subject_results' => $student_subject_results, 'weekly_test_number' => $weekly_test_number, 'term' => $term, 'sec_sub_teach_id' => $section_subject_teacher_id, 'ssr_result' => $ssr_result]);
        $mpdf->WriteHTML($html);
        $mpdf->output();
        }


        public function wt_report(){
            $sessions = Session::with('level_enroll.level', 'level_enroll.section','level_enroll.shift')->get();
            $levels = Level::with('level_enroll.section')->get();
            //dd($levels);
            $sections = Section::pluck('section_name', 'id');
            return view('admin.wt_reports.index', [
            'sections' => $sections, 'sessions' => $sessions, 'levels' => $levels]);
        }

        public function viewStudents(Request $request) {
            $session_id = $request->session_id;
            $section_id = $request->section_id;
            $level_id = $request->level_id;
            $user = User::with('teacher')->findOrFail(Auth::user()->id);
    
            $processor = $user->name;
            if(!($user->hasPermission('wt_reports.viewStudets'))){
             $section_students = SectionStudent::where('section_id', $section_id)
                                        ->with('section.level_enroll.level')
                                        ->with('section.level_enroll.session')
                                        ->with('student')
                                        ->get();
            }
          // dd($section_students);
            return view('admin.wt_reports.view_students', ['section_id' => $section_id,
            'section_students' => $section_students, 'session_id' => $session_id, 'level_id' => $level_id]);
          }

        public function view_wt_report(Request $request){
           //dd($request->all());
            $session_id = $request->session_id;
            $section_id = $request->section_id;
            $level_id = $request->level_id;
            $student_id = $request->student_id;
            $wt_results = DB::table('student_subject_results')
                            ->groupBy('student_subject_results.id')
                            ->where('student_subject_results.student_id', $student_id)
                            ->join('students', 'student_subject_results.student_id', '=', 'students.id')
                            ->join('section_subject_teachers', 'student_subject_results.section_subject_teacher_id', '=', 'section_subject_teachers.id')
                            ->join('terms', 'student_subject_results.term_id', '=', 'terms.id')
                            ->join('subjects', 'section_subject_teachers.subject_id', '=', 'subjects.id')
                            ->where('section_subject_teachers.section_id', $section_id)
                            ->join('sections', 'section_subject_teachers.section_id', '=', 'sections.id')
                            ->join('section_students', 'sections.id', '=', 'section_students.section_id')
                            ->join('level_enrolls', 'sections.level_enroll_id', '=', 'level_enrolls.id')
                            ->join('sessions', 'level_enrolls.session_id', '=', 'sessions.id')
                            ->join('branches', 'level_enrolls.branch_id', '=', 'branches.id')
                            ->where('level_enrolls.session_id', $session_id)
                            ->join('levels', 'level_enrolls.level_id', '=', 'levels.id')
                            ->where('level_enrolls.level_id', $level_id)
                            ->orderBy('student_subject_results.term_id', 'ASC')
                            ->orderBy('section_subject_teachers.subject_id', 'ASC')
                            ->orderBy('student_subject_results.weekly_test_number', 'ASC')
                            ->select('branches.name','branches.address','branches.contact_no','branches.email', 'students.name','subjects.subject_name','terms.term_name','section_students.roll', 'levels.class_name', 'sections.section_name', 'student_subject_results.*')
                            ->get();
         //  dd($wt_results);
            $all_terms = $wt_results->pluck('term_id');
            $old_term_id = '';
            foreach ($all_terms as $index => $val) {
                if($val !== $old_term_id)
                    $terms[] = $val;
                $old_term_id = $val;
            }

          //  dd($terms);
            if(count($wt_results) > 0){
                $mpdf = new \Mpdf\Mpdf();
                $mpdf->SetHTMLFooter('
                <div width="100%" style="float:left; font-size:10px; text-align:center;">
                   <i> powered by: Systech Digital Limited & email: info@systechdigital.com</i>
                </div>');
                $html = view('admin.report.wt_pdf_report', ['wt_results' => $wt_results, 'terms' => $terms ]);
               // exit($html);
                $mpdf->WriteHTML($html);
                $mpdf->output();

            }else{
                return redirect()->back()->with('danger', 'No weekly test record found for this student!!');
            }
        }
}
