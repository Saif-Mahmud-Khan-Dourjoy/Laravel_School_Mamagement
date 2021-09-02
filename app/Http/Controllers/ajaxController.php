<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Session;
use App\Section;
use App\FeesType;
use App\Level;
use App\FiscalYear;
use App\BusinessMonth;
use App\LevelEnroll;
use App\SectionStudent;
use App\Student;

use Auth;

use Validator;

class ajaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
       
    }
    public function data(Request $request){
        

        $session_id=$request->session_id;
        $l_e=LevelEnroll::where('session_id',$session_id)->pluck('level_id')->toArray();
        $class=Level::whereIn('id',$l_e)->get();

        $f_y=Session::where('id',$session_id)->pluck('fiscal_year_id')->first();
        $f_y_data=FiscalYear::where('id',$f_y)->first();
        $b_m=BusinessMonth::where('fiscal_year_id',$f_y)->get();

        $com=array(
              'class'=>$class,
              'business_months'=>$b_m,
              'f_y_data'=>$f_y_data
        );
        


        return json_encode($com);
    }

    public function get_section(Request $request){
        $class_id=$request->class_id;
        $session_id=$request->session_id;
        $l_e=LevelEnroll::where('level_id',$class_id)->where('session_id',$session_id)->pluck('id')->toArray();
        $section=Section::whereIn('level_enroll_id',$l_e)->get();

        return json_decode($section);



    }

    public function  get_student(Request $request){
        $section_id=$request->section_id;

        $s_e=SectionStudent::where('section_id',$section_id)->pluck('student_id')->toArray();
        $students=Student::whereIn('id',$s_e)->get();
        return json_decode($students);

    }
}
