<?php

namespace App\Http\Controllers;

use App\Term;
use App\Level;
use App\Section;
use App\Session;
use App\LevelEnroll;
use App\Teacher;
use App\Student;
use App\SectionStudent;
use App\Subject;
use App\SectionSubjectTeacher;
use App\SectionSubjectTermMark;
use App\SectionSubjectDistribution;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;

class SectionController extends Controller
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
    public function index()
    {
        $sections = Section::with('level_enroll', 'teacher');
        return view ('admin.sections.index', ['sections' => $sections]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $level_enroll = Session::with('level_enroll.level')->get();
        $teachers = Teacher::all();
        $classes = LevelEnroll::with('level')->get();
        return view ('admin.sections.create', ['levels' => $level_enroll, 'teachers' => $teachers, 'classes' => $classes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['section_name' => 'required', 'level_enroll_id' => 'required', 'teacher_id' => 'required|numeric', 'session_id'=>'required|numeric']);
        $data = $request->only('section_name', 'teacher_id', 'level_enroll_id');
        //dd($data);
        $section = Section::create($data);
        return redirect('/sections')->with('message', 'New Section Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)

    {

        $level = Level::find(LevelEnroll::find($section->level_enroll_id)->level_id);
        //dd($level);
        $teacher = Teacher::find($section->teacher_id);
        $student = SectionStudent::where('section_id',$section->id)->count();
        //dd($student);
        return view('admin.sections.show', ['section' => $section, 'level'=>$level,'teacher'=>$teacher,'student'=>$student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $section = Section::where('id', $id)->with('level_enroll.level', 'teacher')->first();
        $terms = Term::all();
        $level_enroll = Session::with('level_enroll.level')->get();
        $teachers = Teacher::all();
        $classes = LevelEnroll::with('level')->get();
        return view('admin.sections.edit', ['section' => $section, 'level_enroll' => $level_enroll, 'teachers' => $teachers, 'terms' => $terms, 'classes' => $classes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        $data = $request->only('section_name', 'teacher_id');
        $section->update($data);
        return redirect('/sections')->with('message', 'Section updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = Section::find($id);
        try{
            $section->delete();
        }
        catch (\Illuminate\Database\QueryException $e) {
            return redirect('/sections')->with('message', 'This section cannot be deleted');
        }
        
        return redirect('/sections')->with('message', 'Section deleted');
    }

    public function assignStudent($id) {
        $section = Section::find($id);
        $students = Student::select('id',DB::raw('CONCAT(name,"-",roll_no) as name'))->get()->pluck('name', 'id');
        return view('admin.sections.add_student', ['students' => $students, 'section' => $section]);
    }

    public function saveStudents(Request $request) {
        /*$data = $request->student_id;
        $section_id = $request->section_id;*/
        //dd($request);
        try{
            DB::beginTransaction();
            $this->validate($request, [
                "student_id"    => "required|array",
                'student_id.*' => 'required|integer',
                "roll"    => "required|array",
                'roll.*' => 'required|string',
                'section_id' => 'required'
            ]);
            for ($i = 0; $i < count($request->student_id); $i++) {
                $student_id = $request->student_id[$i];
                $section_id = $request->section_id;
                $roll = $request->roll[$i];
                $data = ['student_id' => $student_id, 'section_id' => $section_id, 'roll' => $roll];
                //dd($data);
                $section_student = SectionStudent::create($data);
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            $eMsg = "";
            if($e->getCode() == 23000){
                $eMsg = "Duplicate entry";
            }else{
                $eMsg = $e->getMessage();
            }
            // $errorData['myData'] = $request->all();
            $errorData['errors'] = collect([$eMsg]);
            // dd($errorData);
            return Redirect::back()->with($errorData)->withInput($request->all());
        }
        return redirect('/sectionStudents');
    }

    public function assignSubject($id) {
        $terms = Term::all();
        $section = Section::find($id);
        $subjects = Subject::pluck('subject_name', 'id');
        $teachers = Teacher::pluck('teacher_name', 'id');
        return view('admin.sections.add_subject', ['subjects' => $subjects, 'section' => $section,
            'teachers' => $teachers, 'terms' => $terms]);
    }

    public function saveSubject(Request $request) {
        $subject_id = $request->input('subject_id');
        $teacher_id = $request->input('teacher_id');
        $section_id = $request->input('section_id');
        $rows = $request->input('rows');

        
        $validation = Validator::make([
            'subject_id' => $subject_id, 
            'teacher_id' => $teacher_id,
            'section_id' => $section_id
        ], [], []);
        $validation->after(function ($validation) use($subject_id, $teacher_id, $section_id) {
            $checkCombination = SectionSubjectTeacher::where('subject_id', $subject_id)
            ->where('teacher_id', $teacher_id)
            ->where('section_id', $section_id)
            ->get();

            if (count($checkCombination) > 0) {
                $validation->errors()->add('subject_id', 'Subject result already exists')
                ->add('teacher_id', 'Teacher already exists')
                ->add('section_id', 'Section already exists');
            }                                
        });

        if ($validation->fails()) {
            foreach ($validation->errors()->all() as $error) {
                    //dd($error);
                $message = $error;
                return redirect('/sectionSubjectTeachers')->with('message', 'Subject already exists');
            }
            
        }   
        else {
            $section_subject_teacher = new SectionSubjectTeacher();
            $section_subject_teacher->subject_id = $subject_id;
            $section_subject_teacher->teacher_id = $teacher_id;
            $section_subject_teacher->section_id = $section_id;
            $section_subject_teacher->save();

            //SectionSubjectDistibution code will be here

            if($request->written_permission=="Yes"){
                $written_permission ="Yes";
                $written_total = $request->written_total;
            }
            else{
                $written_permission ="No";
                $written_total = 0;
            }

            if($request->mcq_permission=="Yes"){
                $mcq_permission ="Yes";
                $mcq_total = $request->mcq_total;
            }
            else{
                $mcq_permission ="No";
                $mcq_total = 0;
            }

            if($request->pactical_permission=="Yes"){
                $pactical_permission ="Yes";
                $pactical_total = $request->pactical_total;
            }
            else{
                $pactical_permission ="No";
                $pactical_total = 0;
            }

            $sectionSubjectDistribution = new SectionSubjectDistribution;
            $sectionSubjectDistribution->section_subject_teacher_id = $section_subject_teacher->id;
            $sectionSubjectDistribution->written_total = $written_total;
            $sectionSubjectDistribution->written_permission = $written_permission;
            $sectionSubjectDistribution->mcq_total = $mcq_total;
            $sectionSubjectDistribution->mcq_permission = $mcq_permission;
            $sectionSubjectDistribution->pactical_total = $pactical_total;
            $sectionSubjectDistribution->pactical_permission = $pactical_permission;
            $sectionSubjectDistribution->save();


            

            
            $values = array();
            foreach($rows as $row)
            {
             $values[] = [
                'section_subject_teacher_id' => $section_subject_teacher->id,
                'term_id' => $row['term_id'],
                'total_mark' => $row['total_mark'],
                'pass_mark' => $row['pass_mark'],
               // 'wt_mark' => $row['wt_mark'],
                'wt_mark' => 0,
                'ht_mark' => $row['ht_mark'],
                //'wt_convert_in' => $row['wt_convert_in'],
                'wt_convert_in' => 0,
                'ht_convert_in' => $row['ht_convert_in'],
                'created_at' => $date = date('Y-m-d h:i:s'),
                'updated_at' => $date
            ];
        }
        
        $term_exam_marks = SectionSubjectTermMark::insert($values);
        return redirect('/sectionSubjectTeachers');
    }
}

public function GetDataForDataTable(Request $request) {
    $section = new Section();
    return $section->GetListForDataTable(
        $request->input('length'),
        $request->input('start'),
        $request->input('search')['value'],
        $request->input('status')
    );
}

}
