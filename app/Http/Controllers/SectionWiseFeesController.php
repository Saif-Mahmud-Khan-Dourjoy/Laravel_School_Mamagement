<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SectionWiseFees;
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

class SectionWiseFeesController extends Controller
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
        $section_wise_fees = SectionWiseFees::all();        
        return view('admin.section_wise_fees.index', ['section_wise_fees' => $section_wise_fees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sessions = Session::with('level_enroll.level', 'level_enroll.section','level_enroll.shift','level_enroll.branch.fiscal_year_current.business_month')->get();
        // return response()->json($sessions);
        // exit();
        $se=Session::all();        
        $levels = Level::with('level_enroll.section')->get();        
        $sections = Section::pluck('section_name', 'id');
        // $fees_types = FeesType::pluck('fees_type_name', 'id');
        $fees_types = FeesType::get();
        $business_months = BusinessMonth::pluck('month_name', 'id');
        return view('admin.section_wise_fees.create', ['sessions' => $sessions,
            'levels' => $levels, 'sections' => $sections, 
            'fees_types' => $fees_types, 'business_months' => $business_months,'se'=>$se]);
    }

    // public function getClass(Request $request){

    //     $session=$request->$session;

    //     echo json_encode($session);

    // }

    // public function test(Request $request){
    //     return json_encode($request->session);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['session_id' => 'required|numeric',
        'section_id' => 'required|numeric',
        'fees_type_id' => 'required|numeric',
        'business_month_id' => 'required|numeric',
        'level_id' => 'required|numeric',
        'amount' => 'required|numeric'
		]);

        // echo "done";
        // exit();
        //dd($request);
        $session_id = $request->session_id;
        //$level_id = $request->level_id;
        $section_id = $request->section_id;
        $fees_type_id = $request->fees_type_id;
        $business_month_id = $request->business_month_id;
        $amount = $request->amount;
        $user_id = Auth::user()->id;

        $data = ['session_id' => $session_id,
        'section_id' => $section_id,
        'fees_type_id' => $fees_type_id,
        'business_month_id' => $business_month_id,
        'amount' => $amount,
        'user_id' => $user_id
    ];
        //dd($data);
    $validation = Validator::make([$session_id = $request->session_id,
        $section_id = $request->section_id,
        $fees_type_id = $request->fees_type_id,
        $business_month_id = $request->business_month_id,
        $amount = $request->amount,
        $user_id = $request->user_id
    ], [], []);
        //dd($validation);
    $validation->after(function ($validation)
        use ($session_id, $section_id, $fees_type_id, $business_month_id, 
            $amount, $user_id) {
            $checkCombination = SectionWiseFees::where('session_id', $session_id)
            ->where('section_id', $section_id)
            ->where('fees_type_id', $fees_type_id)
            ->where('business_month_id', $business_month_id)
            ->get();
            //dd(count($checkCombination));
            if(count($checkCombination) > 0) {
                $validation->errors()->add('session_id', 'Data already exists');
            }

        });

    if ($validation->fails()) {


        foreach ($validation->errors()->all() as $error) {
                    //dd($error);
            $message = $error;
        }

    }   
    else {
                //dd($data);
        $section_wise_fees = SectionWiseFees::create($data);
        return redirect('/section_wise_fees')->with('message', 'Fee details added'); 
    }

    return redirect('/section_wise_fees')->with('message', 'Fee details could not be added!');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section_wise_fees = SectionWiseFees::find($id);
        return view('admin.section_wise_fees.show', ['section_wise_fees' => $section_wise_fees]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $section_wise_fees = SectionWiseFees::with('section.level_enroll.level','session','section.level_enroll.shift')->find($id);
        // $sessions = Session::with('level_enroll.level', 'level_enroll.section')->get();
        $sessions = Session::with('level_enroll.level', 'level_enroll.section','level_enroll.shift','level_enroll.branch.fiscal_year_current.business_month')->get();        
        // dd($section_wise_fees);
        $levels = Level::with('level_enroll.section')->get();
        $sections = Section::pluck('section_name', 'id');
        $fees_types = FeesType::pluck('fees_type_name', 'id');
        $business_months = BusinessMonth::pluck('month_name', 'id');
        return view('admin.section_wise_fees.edit', ['section_wise_fees' => $section_wise_fees,
            'sessions' => $sessions,
            'levels' => $levels, 'sections' => $sections, 
            'fees_types' => $fees_types, 'business_months' => $business_months]);

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
        $this->validate($request, ['session_id' => 'required|numeric',
        'section_id' => 'required|numeric',
        'fees_type_id' => 'required|numeric',
        'level_id' => 'required|numeric',
        'business_month_id' => 'required|numeric',
        'amount' => 'required|numeric'
		]);
        $section_wise_fees = SectionWiseFees::find($id);
        $session_id = $request->session_id;
        //$level_id = $request->level_id;
        $section_id = $request->section_id;
        $fees_type_id = $request->fees_type_id;
        $business_month_id = $request->business_month_id;
        $amount = $request->amount;
        $user_id = $request->user_id;

        $data = ['session_id' => $request->session_id,
        'section_id' => $request->section_id,
        'fees_type_id' => $request->fees_type_id,
        'business_month_id' => $request->business_month_id,
        'amount' => $request->amount,
        'user_id' => $request->user_id
    ];
        // dd($data);

    $validation = Validator::make([$session_id = $request->session_id,
        $section_id = $request->section_id,
        $fees_type_id = $request->fees_type_id,
        $business_month_id = $request->business_month_id,
        $amount = $request->amount,
        $user_id = $request->user_id
    ], [], []);

    $validation->after(function ($validation)
        use ($session_id, $section_id, $fees_type_id, $business_month_id, 
            $amount, $user_id, $section_wise_fees) {
            $checkCombination = SectionWiseFees::where('session_id', $session_id)
            ->where('section_id', $section_id)
            ->where('id','!=' ,$section_wise_fees->id)
            ->where('fees_type_id', $fees_type_id)
            ->where('business_month_id', $business_month_id)
            ->get();
            if(count($checkCombination) > 0) {
                $validation->errors()->add('session_id', 'Data already exists');
            }

        });

    $message = [];
    if($validation->fails()) {
        foreach ($validation->errors()->all() as $error) {
                //dd($error);
            $message[] = $error;
        }       
    }   
    else {
        $section_wise_fees->update($data);
        return redirect('/section_wise_fees')->with('message', 'Fee details updated'); 
    }

    return redirect('/section_wise_fees')->with('message', 'Fee details could not be updated! '.implode(',', $message));
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section_wise_fees = SectionWiseFees::find($id);
        try{
            $section_wise_fees->delete();
        }
        catch (\Illuminate\Database\QueryException $e){
            $request->session()->flash('danger', 'Unable to delete this year');
            return redirect('/section_wise_fees')->with('message', 'This data cannot be deleted');
        }
        return redirect('/section_wise_fees')->with('message', 'Data deleted');
    }

    public function GetDataForDataTable(Request $request) {
        $section_wise_fees = new SectionWiseFees();
        return $section_wise_fees->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
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
