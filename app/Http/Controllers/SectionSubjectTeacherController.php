<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Term;
use App\Teacher;
use App\SectionSubjectTeacher;
use App\SectionSubjectTermMark;
use App\SectionSubjectDistribution;
use Validator;
use Illuminate\Http\Request;

class SectionSubjectTeacherController extends Controller
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
        $section_subject_teacher = SectionSubjectTeacher::all();
        return view('admin.section_subject_teachers.index', ['section_subject_teachers' => $section_subject_teacher]);
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
        $subjects = Subject::all();
        $teachers = Teacher::all();
        $term_mark = SectionSubjectTeacher::findOrFail($id);
        $terms = Term::all();
        $section_subject_term_marks = SectionSubjectTermMark::where('section_subject_teacher_id', $id)->get();
       // dd($section_subject_term_marks);

        return view('admin.section_subject_teachers.edit_term_marks', ['subjects' => $subjects, 'terms' => $terms, 'section_subject_term_marks' => $section_subject_term_marks, 'teachers' => $teachers,  'term_mark' => $term_mark]);
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
        $section_subject_teacher = SectionSubjectTeacher::findOrFail($id);
        $subject_id = $request->input('subject_id');
        $teacher_id = $request->input('teacher_id');
        $section_id =  $section_subject_teacher->section_id;
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

            if (count($checkCombination) > 1) {
                $validation->errors()->add('subject_id', 'Subject result already exists')
                ->add('teacher_id', 'Teacher already exists')
                ->add('section_id', 'Section already exists');
            }                                
        });

        if ($validation->fails()) {
            foreach ($validation->errors()->all() as $error) {
                $message = $error;
                return redirect('/sectionSubjectTeachers')->with('message', 'Subject already exists');
            }
            
        }   
        else {
            $section_subject_teacher->subject_id = $subject_id;
            $section_subject_teacher->teacher_id = $teacher_id;
            $section_subject_teacher->section_id = $section_id;
            $section_subject_teacher->update();

           //sectionSubjectDistribution
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
            $counter = SectionSubjectDistribution::where('section_subject_teacher_id',$section_subject_teacher->id)->count();

            if($counter>0){
                $sectionSubjectDistribution = SectionSubjectDistribution::where('section_subject_teacher_id',$section_subject_teacher->id)->first();
                $sectionSubjectDistribution->written_total = $written_total;
                $sectionSubjectDistribution->written_permission = $written_permission;
                $sectionSubjectDistribution->mcq_total = $mcq_total;
                $sectionSubjectDistribution->mcq_permission = $mcq_permission;
                $sectionSubjectDistribution->pactical_total = $pactical_total;
                $sectionSubjectDistribution->pactical_permission = $pactical_permission;
                $sectionSubjectDistribution->update();
            }
            else{
                $sectionSubjectDistribution = new SectionSubjectDistribution;
                $sectionSubjectDistribution->section_subject_teacher_id = $section_subject_teacher->id;
                $sectionSubjectDistribution->written_total = $written_total;
                $sectionSubjectDistribution->written_permission = $written_permission;
                $sectionSubjectDistribution->mcq_total = $mcq_total;
                $sectionSubjectDistribution->mcq_permission = $mcq_permission;
                $sectionSubjectDistribution->pactical_total = $pactical_total;
                $sectionSubjectDistribution->pactical_permission = $pactical_permission;
                $sectionSubjectDistribution->save();
            }

            SectionSubjectTermMark::where('section_subject_teacher_id', $section_subject_teacher->id)->delete();
            



            $values = array();
            foreach($rows as $row)
            {
                $values[] = [
                    'section_subject_teacher_id' => $section_subject_teacher->id,
                    'term_id' => $row['term_id'],
                    'total_mark' => $row['total_mark'],
                    'pass_mark' => $row['pass_mark'],
                    'wt_mark' =>0,
                    'ht_mark' => $row['ht_mark'],
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section_subject_teacher = SectionSubjectTeacher::find($id);
        try {
            $section_subject_teacher->delete();
        }
        catch (\Illuminate\Database\QueryException $e) {
            return redirect('/sectionSubjectTeachers')->with('message', 'This subject cannot be deleted');
        }
        
        return redirect('/sectionSubjectTeachers')->with('message', 'Subject deleted');
    }

    public function GetDataForDataTable(Request $request) {
        $section_subject_teacher = new SectionSubjectTeacher();
        return $section_subject_teacher->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
