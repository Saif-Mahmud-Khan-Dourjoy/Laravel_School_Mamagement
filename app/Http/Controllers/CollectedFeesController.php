<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GeneralSetting;
use App\CollectedFees;
use Carbon\Carbon;
use App\Student;
use App\PaymentMethod;
use App\SectionStudent;
use App\Session;
use App\Section;
use App\FeesType;
use App\Level;
use App\Prefix;
use App\BusinessMonth;
use App\SectionWiseFees;
use App\LevelEnroll;
use App\User;
use NumberToWords\NumberToWords;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use DB;
use App\Imports\MemberImport;
use App\SmsLog;
use Excel;

class CollectedFeesController extends Controller
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
    
    public function index()
    {
                //dd($_REQUEST);
        $collected_fees =  CollectedFees::all();
        return view('admin.collected_fees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {


        // $sessions = Session::with('level_enroll.level', 'level_enroll.section')->get();
        // $sessions = Session::with('level_enroll.level', 'level_enroll.section','level_enroll.shift','level_enroll.branch.fiscal_year_current.business_month')->get();        
        // //dd($sessions);
        // $section_wise_fees = Level::with('level_enroll.section')->get();
        // $levels = Level::with('level_enroll.section')->get();
        // $sections = Section::pluck('section_name', 'id');
        // $fees_types = SectionWiseFees::with('fees_type')->get();
        // $business_months = BusinessMonth::pluck('month_name', 'id');
        // $students = SectionStudent::with('student')->get();
        // $payment_methods = PaymentMethod::pluck('method_name', 'id');
        // $business_months = BusinessMonth::pluck('month_name', 'id');

        // return view('admin.collected_fees.create', ['sessions' => $sessions,
        // 'levels' => $levels, 'sections' => $sections, 
        // 'fees_types' => $fees_types, 'business_months' => $business_months, 'students' => $students, 'payment_methods' => $payment_methods]);

         $sessions = Session::with('level_enroll.level', 'level_enroll.section','level_enroll.shift','level_enroll.branch.fiscal_year_current.business_month')->get();
        // return response()->json($sessions);
        // exit();
        $se=Session::all();        
        $levels = Level::with('level_enroll.section')->get();        
        $sections = Section::pluck('section_name', 'id');
        // $fees_types = FeesType::pluck('fees_type_name', 'id');
        $fees_types = FeesType::get();
        $business_months = BusinessMonth::pluck('month_name', 'id');
        return view('admin.collected_fees.create', ['sessions' => $sessions,
            'levels' => $levels, 'sections' => $sections, 
            'fees_types' => $fees_types, 'business_months' => $business_months,'se'=>$se]);

    }

    /**
     * Store a newly created fees and adjust previous.
     * version 1.0 (2019)
     * Author: Md Abdullah (Systech Digital Limited)
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['student_id' => 'required',
                                   'payment_method_id' => 'required',
                                   'fees_book_leaf_number' => 'required',
                                   'total_collected' => 'required',
                                   'total_due' => 'required',
                                   'fees_book_leaf_prefix' => 'required',
                                   'total_advanced' => 'required',
                                   'collector_id' => 'required',
                                   'collection_date' => 'required',
                                   'business_month_id' => 'required',
                                   ]);

        /*setting up fees types*/
        $fees_types = ($request->input('fees_type'))?$request->input('fees_type') : [];
        $section_wise_fees_ids = '';
        $numItems = count($fees_types);
        $i = 0;
        foreach ($fees_types as $value) {
            if(++$i === $numItems) {
                $arr = explode("-", $value);
                $section_wise_fees_ids .= $arr[0];  
            }
            else{
                $arr = explode("-", $value);
                $section_wise_fees_ids .= $arr[0].',';  
            }
        }
        
        $cf =  new CollectedFees();
        $cf->collector_id = $request->input('collector_id');
        $cf->student_id = $request->input('student_id');
        $section_student = SectionStudent::where('student_id', $request->input('student_id'))->where('section_id', $request->input('section_id'))->get()->first();
        $cf->section_student_id = $section_student->id;
        $cf->payment_method_id = $request->input('payment_method_id');
        $cf->prefix_id = $request->input('fees_book_leaf_prefix');
        $cf->fees_book_leaf_number = $request->input('fees_book_leaf_number');
        $cf->collection_date = $request->input('collection_date');
        $cf->total_collected = $request->input('total_collected');
        $cf->discount_amount = ($request->input('discount_amount'))?$request->input('discount_amount'):0;
        $cf->total_due = $request->input('total_due');
        $cf->total_advanced = $request->input('total_advanced');
        $cf->business_month_id = $request->input('business_month_id');
        $cf->section_wise_fees_ids = $section_wise_fees_ids;
        $year = Carbon::now()->format('y');
        $invoice_id = IdGenerator::generate(['table' => 'collected_fees', 'length' => 6, 'prefix' => $year]);
        $cf->invoice_id = $invoice_id;
        $cf->save();

        return redirect('collected_fees')->with('success', '<a target="_blank" href="'.url('collected_fee/invoice/'.$cf->id).'"> Successfully add fees. Please download invoice from here</a>');

    }

    /**
     * Generate Pdf for specific fees 
     * version 1.0 (2019)
     * Author: Md. Abdullah (Systech Digital Limited)
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pdfInvoice($id)
    {
        /*Getting data for pdf invoice*/
        $cf = CollectedFees::findOrFail($id);
        $collected = $cf;
          
        $f = new NumberToWords();
        $numberTransformer = $f->getNumberTransformer('en');
        $collected->total_collected_word = ucwords($numberTransformer->toWords($cf->total_collected));
        
        $payment_method = PaymentMethod::findOrFail($cf->payment_method_id);
        $business_month = BusinessMonth::findOrFail($cf->business_month_id)->month_name;
        $section_student = SectionStudent::where('student_id',  $cf->student_id)->where('section_id', $cf->section_student->section_id)->with('student')->with('section')->with('section.level_enroll.level')->with('section.level_enroll.branch')->with('section.level_enroll.level')->with('section.level_enroll.shift')->with('section.level_enroll.branch')->first();
        $section_wise_fees = SectionWiseFees::whereIn('id',explode(',',$cf->section_wise_fees_ids))->with('fees_type')->get();
        $mpdf = new \Mpdf\Mpdf();
        $settings = GeneralSetting::first();
        //dd($section_student);
        $html = view('admin.collected_fees.invoice_pdf', compact('collected','payment_method', 'business_month', 'section_student', 'section_wise_fees', 'settings'));
      // exit($html);
        $mpdf->AddPage('L');
        $mpdf->SetFooter('');
        // $mpdf->SetHTMLFooter('
        //     <div width="50%" style="float:left; font-size:12px; text-align:center;">
        //         <div style="text-align: center">
        //             <h4 style="padding:0p; margin-top: 5px;margin-bottom: 0px;">Students Copy</h4>
        //         </div>
        //     </div>
        //     <div width="50%" style="float:left; font-size:12px; text-align:center;">
        //         <div style="text-align: center">
        //             <h4 style="padding:0px; margin-top: 5px;margin-bottom: 0px;">Office Copy</h4>
        //         </div>
        //     </div>');
        $mpdf->SetTitle('Invoice of Fees');
        $mpdf->WriteHTML($html);
        $mpdf->Output($cf->student_id.'-'.$cf->section_student->student->name.'-'.$cf->business_month->month_name.'-'.date('Ymdhis').'-fees.pdf','I');
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
        $collected_fees = CollectedFees::find($id);
        $student = Student::find($collected_fees->student_id);
        $section_student = SectionStudent::where('student_id', $student->id)->where('section_id', $collected_fees->section_student->section_id)->get()->first();
        $section = Section::find($section_student->section_id);
        $level_enroll = LevelEnroll::find($section->level_enroll_id);
        $level = Level::find($level_enroll->level_id);
        $business_month = BusinessMonth::find($collected_fees->business_month_id);
        $prefix = Prefix::find($collected_fees->prefix_id);
        $user = User::find($collected_fees->collector_id);
       //dd($user);
        return view('admin.collected_fees.show', ['collected_fees' => $collected_fees,
            'student' => $student, 'section_student' => $section_student, 'section' => $section, 
            'level' => $level, 'business_month' => $business_month, 'prefix' => $prefix, 'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $collected_fees = CollectedFees::with('business_month','section_student.section.level_enroll.session','section_student.section.level_enroll.level')->find($id);

        $old_fees_ids = CollectedFees::where('section_student_id', $collected_fees->section_student_id)->where('business_month_id', $collected_fees->business_month_id)->where('id', '!=', $id)->select(DB::raw('group_concat(section_wise_fees_ids) as ids'))->get();
        
        $old_fees = CollectedFees::where('student_id', $collected_fees->student_id)->where('id', '<', $id)->orderBy('id', 'desc')->first();

        $leaf_prefix = Prefix::pluck('prefix','id');

        $section_wise_fees = SectionWiseFees::where([['session_id', $collected_fees->section_student->section->level_enroll->session_id], ['section_id', $collected_fees->section_student->section_id], ['business_month_id', $collected_fees->business_month_id]])->with('fees_type')->get();

        $payment_methods = PaymentMethod::pluck('method_name', 'id');
        //dd($collected_fees);
        return view('admin.collected_fees.edit', compact('collected_fees', 'payment_methods', 'section_wise_fees', 'old_fees','old_fees_ids','leaf_prefix'));

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

        $cf = CollectedFees::find($id);
        $old_due = $cf->total_due;
        $old_advanced = $cf->total_advanced;
        //dd($old_advanced);
        $this->validate($request, ['student_id' => 'required',
                                   'payment_method_id' => 'required',
                                   'fees_book_leaf_number' => 'required',
                                   'total_collected' => 'required',
                                   'total_due' => 'required',
                                   'total_advanced' => 'required',
                                   'collector_id' => 'required'
                                   ]);
         /*setting up fees types*/
        $fees_types = ($request->input('fees_type'))?$request->input('fees_type') : [];
        $section_wise_fees_ids = '';
        $numItems = count($fees_types);
        $i = 0;
        foreach ($fees_types as $value) {
            if(++$i === $numItems) {
                $arr = explode("-", $value);
                $section_wise_fees_ids .= $arr[0];  
            }
            else{
                $arr = explode("-", $value);
                $section_wise_fees_ids .= $arr[0].',';  
            }
        }

        $cf->payment_method_id = $request->input('payment_method_id');
        $cf->prefix_id = $request->input('fees_book_leaf_prefix');
        $cf->fees_book_leaf_number = $request->input('fees_book_leaf_number');
        $cf->collection_date = $request->input('collection_date');
        $cf->total_collected = $request->input('total_collected');
        $cf->discount_amount = ($request->input('discount_amount'))?$request->input('discount_amount'):0;
        $cf->total_due = $request->input('total_due');
        $cf->total_advanced = $request->input('total_advanced');
        $cf->business_month_id = $request->input('business_month_id');
        $cf->section_wise_fees_ids = $section_wise_fees_ids;

        $cf->update();

        $new_due = $cf->total_due;
        $new_advanced = $cf->total_advanced;
        if(($old_due != $new_due) || ($old_advanced != $new_advanced)){
            $old_cf = CollectedFees::where('student_id', $cf->student_id)->where('id', '>', $cf->id)->get();

            foreach ($old_cf as $row) {
                $old_due_1 = $row->total_due;
                $old_advanced_1 = $row->total_advanced;
                if($new_due > 0){
                    $adjust_due = $new_due - $old_due;
                    //if($adjust_due > 0){
                        if($row->total_advanced > 0){
                            $adjust_amount = $row->total_advanced - $adjust_due;
                            if($adjust_amount < 0){
                                $row->total_due += abs($adjust_amount);
                                $row->total_advanced = 0;
                            }
                            else{
                                $row->total_advanced -= $adjust_amount;
                                $row->total_due = 0;
                            }

                        }else{
                            $row->total_due += abs($adjust_due);
                            $row->total_advanced = 0;
                            //dd([$old_due , $new_due, $adjust_due, $row]);
                        }
                    //}else{
                       // $row->total_advanced += abs($adjust_due);
                       // $row->total_due = 0;
                   // }
                }else{
                    $adjust_advanced = $new_advanced - $old_advanced;
                   // if($adjust_advanced > 0){
                        if($row->total_due > 0){
                            $adjust_amount = $row->total_due - $adjust_advanced;
                            if($adjust_amount < 0){
                                $row->total_advanced += abs($adjust_amount);
                                $row->total_due = 0;
                            }
                            else{
                                $row->total_due -= $adjust_advanced;
                                $row->total_advanced = 0;
                            }

                        }else{
                            $row->total_advanced += $adjust_advanced;
                            $row->total_due = 0;
                        }
                    /*}else{
                        $row->total_due += abs($adjust_advanced);
                        $row->total_advanced = 0;
                    }*/
                              //dd([$old_advanced , $new_advanced, $adjust_advanced, $row]);
                }

                $row->updated_at = $row->updated_at;
                $row->update();

                $new_due = $row->total_due;
                $new_advanced = $row->total_advanced;
                $old_due = $old_due_1;
                $old_advanced = $old_advanced_1;
            }
        }

        return redirect('collected_fees')->with('success', '<a target="_blank" href="'.url('collected_fee/invoice/'.$cf->id).'"> Successfully updated. Please download invoice from here</a>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collected_fees = CollectedFees::find($id);
        $collected_fees->delete();
        return redirect('/collected_fees')->with('message', 'Data Deleted!');
    }

    /**
     * get old fees data and get data in second form for fees collection and calcuation
     * Version : 1.0 (2019)
     * Author: Md. Abdullah (Systech Digital Limited)
     * @param Request $input
     * @return \Illuminate\Http\Response
     */
    public function calculateFees(Request $request)
    {
        $this->validate($request, ['student_id' => 'required|numeric',
            'session_id' => 'required|numeric',
            'section_id' => 'required|numeric',
            'level_id' => 'required|numeric',
            'business_month_id' => 'required|numeric'
        ]);
        $session_id = $request->input('session_id');
        $student_id = $request->input('student_id');
        $section_id = $request->input('section_id');
       
        $business_month_id = $request->input('business_month_id');
        $section_student_data = SectionStudent::where('student_id', $student_id)->where('section_id', $section_id)->first();
        $section_student_id =$section_student_data->id;
        echo $section_student_id;
        // exit();
        $session = Session::findOrFail($session_id)->pluck('name', 'id')->first();
        $business_month = BusinessMonth::findOrFail($business_month_id)->month_name;
        $section_student = SectionStudent::where('student_id', $student_id)->where('section_id', $section_id)->with('student')->with('section')->with('section.level_enroll.level')->first();

        $old_fees_ids = CollectedFees::where('section_student_id', $section_student_id)->where('business_month_id', $business_month_id)->select(DB::raw('group_concat(section_wise_fees_ids) as ids'))->get();
        if(isset($id))
            $old_fees = CollectedFees::where('student_id', $student_id)->where('id', '<', $id)->orderBy('id', 'desc')->first();
        else
            $old_fees = null;

        $leaf_prefix = Prefix::pluck('prefix','id');

        $section_wise_fees = SectionWiseFees::where([['session_id', $session_id], ['section_id', $section_id], ['business_month_id', $business_month_id]])->with('fees_type')->get();

        $payment_methods = PaymentMethod::pluck('method_name', 'id');
        // dd($section_student);
        return view('admin.collected_fees.form2', compact('payment_methods', 'section_wise_fees', 'section_student', 'business_month', 'session', 'old_fees','leaf_prefix', 'student_id', 'business_month_id'));
    }


    public function GetDataForDataTable(Request $request) {
        $collected_fees = new CollectedFees();
        return $collected_fees->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }

    public function import(Request $request){
        return view('admin.collected_fees.import');
    }

    public function importFile(Request $request){
        $request->validate([
            'importFile' => 'bail|required|file|mimes:xlsx,xls,csv,txt',            
        ]);        
        $collectedFeesList = CollectedFees::with('section_student.section.level_enroll')->get();
        $levelEnrollList = LevelEnroll::get();
        $sectionList = Section::get();
        $sectionStudentList = SectionStudent::get();
        $collection = Excel::toCollection(null, $request->file('importFile'));
        $userFactoryData = null;
        $session=[
            '3' => 6,
            '4' => 5,
        ];
        
        foreach ($collection as $key => $sheet) {
            foreach ($sheet as $keyR => $row) {
                if($keyR == 0 || $row[9] != 1){
                    continue;
                }
                $collectedFees = $collectedFeesList->where('fees_book_leaf_number',$row[8])->first();
                try{
                    if($collectedFees != null){
                        $level_enroll = $collectedFees->section_student->section->level_enroll;
                        if($level_enroll->session_id == 5 || $level_enroll->session_id == 6)
                            continue;
                        $levelEnroll = $levelEnrollList->where('session_id',$session[$level_enroll->session_id])
                                                    ->where('branch_id',$level_enroll->branch_id)                                                    
                                                    ->where('level_id',$level_enroll->level_id + 1)
                                                    ->first();
                        $section = $sectionList->where('level_enroll_id',$levelEnroll->id)->first();
                        $sectionStudent = $sectionStudentList->where('section_id',$section->id)->where('student_id',$collectedFees->student_id)->first();
                        if($sectionStudent != null){
                            $collectedFees->section_student_id = $sectionStudent->id;
                            $collectedFees->update();
                        }                        
                    }                
                }catch(\Exception $e){
                    echo 'Leafe no '.$collectedFees->fees_book_leaf_number.'<br>';
                }

            }
        }
        

        echo "Done :)";
    }
}
