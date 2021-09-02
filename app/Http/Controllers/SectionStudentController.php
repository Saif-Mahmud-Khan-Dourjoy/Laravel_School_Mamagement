<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use App\SectionStudent;
use App\Attendance;
use App\Student;
use App\Session;
use App\Branch;
use App\Level;
use App\Section;
use App\LevelEnroll;
use NumberToWords\NumberToWords;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
class SectionStudentController extends Controller
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
        $section_students = SectionStudent::all();
        
        return view('admin.section_students.index', ['section_students' => $section_students]);
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
        //dd($id);
        $section_id = $id;
        $section_student = SectionStudent::where('section_id', $id)->get();
        return view('admin.section_students.section_wises_students', ['section_student' => $section_student, 'section_id' => $section_id]);
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
    public function destroy($id, Request $request)
    {
        $section_students = SectionStudent::find($id);
        try{
            $section_students->delete();
        }
        catch (\Illuminate\Database\QueryException $e){
            $request->session()->flash('danger', 'Unable to delete student');
            return redirect()->back()->with('message', 'Student cannot be deleted from this section !!');
        }
        return redirect()->back()->with('message', 'Successfully deleted student from section.');
    }

    public function GetDataForDataTable(Request $request) {
        $section_student = new SectionStudent();
        return $section_student->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }

    public function viewAttendance($section_id, Request $request){
        $id = $section_id;
        $filtered_section_id = $request->section_id;
        $filter_type = $request->filter_value;
        $today = Carbon::today()->format('Y-m-d');
        $check_student = DB::table('section_students')
                            ->where('section_id' , $id)
                            ->leftJoin('sections', 'section_students.section_id', '=', 'sections.id')
                            ->get();
        if($check_student->isEmpty() == true){
            return redirect('/sections')->with('message', 'No student is availabe in this section !!');
        }else{
            $section_student_attendance = DB::table('section_students')
                                    ->where('section_id' , $id)
                                    ->leftJoin('sections', 'section_students.section_id', '=', 'sections.id')
                                    ->leftJoin('level_enrolls', 'sections.level_enroll_id', '=', 'level_enrolls.id')
                                    ->leftJoin('levels', 'level_enrolls.level_id', '=', 'levels.id')
                                    ->leftJoin('students', 'section_students.student_id', '=', 'students.id')
                                    ->leftJoin('attendances', function ($leftJoin) use($today){
                                        $leftJoin->on('section_students.student_id', '=', 'attendances.attendanceable_id')
                                            ->where('attendances.attendanceable_type', '=', 'App\Student')
                                            ->where('attendances.date', '=', $today);
                                    })
                                   ->select('students.name', 'students.mothers_name', 'students.fathers_name', 'students.mothers_cell', 'students.fathers_cell', 'level_enrolls.level_id', 'levels.class_name', 'section_students.id', 'section_students.section_id', 'section_students.student_id', 'teacher_id', 'roll', 'sections.section_name','attendances.date','attendances.in_time', 'attendances.out_time')
                                   ->get();
            $section_student_attendance = $section_student_attendance->sortBy('roll');
            return view('admin.attendance.view_student_attendance', ['section_student_attendance' => $section_student_attendance, 'today' => $today, 'filtered_section_id' => $filtered_section_id, 'filter_type' => $filter_type]);
        }
    }

    public function searchAttendanceIndex(){
        $sessions = Session::with('level_enroll.level', 'level_enroll.section', 'level_enroll.branch')->get();
        $levels = Level::with('level_enroll.section')->get();
        return view('admin.attendance.search_attendance_index', ['sessions' => $sessions, 'levels' => $levels]);
    }

    public function searchedAttendanceView(Request $request){
        $today = Carbon::now()->format('Y-m-d l h:i:s A');
        $rules = [
            'session_id'=> 'required',
            'level_id'=> 'required',
            'section_id'=> 'required',
            'attendance_date'=> 'required|before:tomorrow',
        ];
        $customMsg = [
            'session_id.required' => 'Select Specific Session',
            'level_id.required' => 'Select Specific Class',
            'section_id.required' => 'Select Specific Section',
            'attendance_date.required' => 'Select Attendance Date',
            'attendance_date.before' => 'Can not Select Tomorrow Date',
        ];
        $this->validate($request, $rules, $customMsg);
        $s_id = $request->session_id;
        $l_id = $request->level_id;
        $sec_id = $request->section_id;
        $date = $request->attendance_date;
        $type = $request->collection_type;
        $section_student_attendance = DB::table('section_students')
        ->where('section_students.section_id', $sec_id)
        ->leftJoin('sections', 'section_students.section_id', '=', 'sections.id')
        ->leftJoin('students', 'section_students.student_id', '=', 'students.id')
        ->leftJoin('level_enrolls', 'sections.level_enroll_id', '=', 'level_enrolls.id')
        ->where('level_enrolls.session_id', $s_id)
        ->leftJoin('sessions', 'level_enrolls.session_id', '=', 'sessions.id')
        ->leftJoin('branches', 'level_enrolls.branch_id', '=', 'branches.id')
        ->leftJoin('levels', 'level_enrolls.level_id', '=', 'levels.id')
        ->leftJoin('attendances', function ($leftJoin) use($date){
            $leftJoin->on('section_students.student_id', '=', 'attendances.attendanceable_id')
                ->where('attendances.attendanceable_type', '=', 'App\Student')
                ->where('attendances.date', '=', $date);
         })
        ->select('branches.id as branchId', 'branches.name as branchName','sessions.id as sessionId', 'sessions.name as sessionName', 'level_enrolls.level_id', 'levels.class_name','sections.section_name', 'section_students.section_id', 'attendances.date','attendances.in_time', 'attendances.out_time','section_students.roll', 'students.name as studentName', 'students.mothers_name', 'students.fathers_name', 'students.mothers_cell', 'students.fathers_cell','section_students.id as sectionStudentId','section_students.student_id', 'sections.teacher_id', 'sections.section_name')
        ->get();
        $section_student_attendance = $section_student_attendance->sortBy('roll');
        $total_std = 0;
        $present_std = 0;
        $absent_std = 0;
        foreach($section_student_attendance as $ssa){
            $total_std++;
            if($ssa->in_time != null){
                $present_std++;
            }
            if($ssa->in_time == null){
                $absent_std++;
            }
        }
        $f = new NumberToWords();
        $numberTransformer = $f->getNumberTransformer('en');
        $total_std_number = $total_std;
        $present_std_number = $present_std;
        $absent_std_number = $absent_std;
        $total_std_word = ucwords($numberTransformer->toWords($total_std));
        $present_std_word = ucwords($numberTransformer->toWords($present_std));
        $absent_std_word = ucwords($numberTransformer->toWords($absent_std));
        echo view('admin.attendance.attendance_list', ['section_student_attendance'=> $section_student_attendance, 'today'=> $today, 'total_std_word' => $total_std_word, 'date' => $date, 'total_std' => $total_std, 's_id' => $s_id, 'present_std' => $present_std, 'absent_std' => $absent_std,'present_std_word' => $present_std_word, 'absent_std_word' => $absent_std_word,'type'=> $type]);
    }
}
