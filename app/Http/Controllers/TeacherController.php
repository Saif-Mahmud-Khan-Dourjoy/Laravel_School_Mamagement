<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\User;
use App\BankAccount;
use App\MobileBankAccount;
use App\EducationalQualification;
use App\NtrcaInfo;
use App\PreviousSchoolInfo;
use App\ScaleChangingInfo;
use App\TrainingInfo;
use App\level;
use App\Branch;
use App\Shift;
use App\Attendancecard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
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
		//
		$teachers = Teacher::all();
		return view('admin.teachers.index', ['teachers'=>$teachers]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.teachers.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
	//	echo($request);
		$this->validate($request, [
			'teacher_name' => 'required',
			'teacher_name_bangla' => 'required',
			'teacher_global_id' => 'bail|required|unique:teachers,teacher_global_id',
			'fathers_name' => 'required',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6',
			'present_address' => 'required',
			'permanent_address' => 'required',
			'mothers_name' => 'required',
			'contact_no' => 'required|max:12',
			'marital_status' => 'required',
			'salary' => 'required',
			'religion' => 'required',
			'nationality' => 'required',
			'date_of_birth' => 'required',
			'designation' => 'required',
			'gender'=>'required',
			'teacher_joining_date' => 'required',
			'teacher_photo' => 'required|mimes:jpeg,jpg,bmp,png|unique:teachers',
			
		]);

		$bank_check=$request->bank_check;

		if ($bank_check=="on") {
			$this->validate($request, [
				'account_holder_name' => 'required',
				'bank_name' => 'required',
				'branch_name' => 'required',
				'account_number' => 'required',
				'account_type' => 'required',
				'routing_number' => 'required'
			]);
		}
		$mobile_check=$request->mobile_check;
		if ($mobile_check=="on") {
			$this->validate($request, [
				'mobile_account_holder_name' => 'required',
				'mobile_bank_name' => 'required',
				'mobile_account_number' => 'required',
				'mobile_account_type' => 'required',
			]);
		}

		$edu_check=$request->edu_check;
		if ($edu_check=="on") {
			$this->validate($request, [
				'degree_name.*' => 'required',
				'passing_year.*' => 'required',
				'result.*' => 'required',
				'edu_institute_name.*' => 'required',
				'edu_subject.*' => 'required',
				
			]);
		}


		$Training=$request->Training;
		if ($Training=="on") {
			$this->validate($request, [
				'training_institute_name.*' => 'required',
				'training_subject.*' => 'required',
				'training_place.*' => 'required',
				'starting_date.*' => 'required',
				'ending_date.*' => 'required',
				'expiration.*' => 'required',
			]);
		}

		$prev_school=$request->prev_school;
		if ($prev_school=="on") {
			$this->validate($request, [
				'prev_scl_institute_name.*' => 'required',
				'prev_scl_designation.*' => 'required',
				'prev_scl_joining_date.*' => 'required',
				'exemption_date.*' => 'required',
			]);
		}

	    $ntrca=$request->ntrca;
		if ($ntrca=="on") {
			$this->validate($request, [
				'registation_no.*' => 'required',
				'roll_no.*' => 'required',
				'ntrca_subject.*' => 'required',
				'ntrca_passing_year.*' => 'required',
				'ntrca_appoiment_date.*' => 'required',
				'ntrca_joining_date.*' => 'required',
			]);
		}

		$teacher_name = $request->input('teacher_name');
		$teacher_name_bangla = $request->input('teacher_name_bangla');
		$designation = $request->input('designation');
		$teacher_global_id = $request->input('teacher_global_id');
		$contact_no = $request->input('contact_no');
		$date_of_birth = $request->input('date_of_birth');
		$nationality = $request->input('nationality');
		$religion = $request->input('religion');
		$spouse_name = $request->input('spouse_name');
		$fathers_name = $request->input('fathers_name');
		$mothers_name = $request->input('mothers_name');
		$present_address = $request->input('present_address');
		$permanent_address = $request->input('permanent_address');
		$salary = $request->input('salary');
		$marital_status = $request->input('marital_status');

		$teacher_subject = $request->input('teacher_subject');	
		$teacher_comment = $request->input('teacher_comment');
		$nid_number = $request->input('nid_number');
		$gender = $request->input('gender');
		$teacher_joining_date = $request->input('teacher_joining_date');
		$blood_group = $request->input('blood_group');

		$image = $request->file('teacher_photo');
		$destinationPath = 'img/';
		$originalFile = $image->getClientOriginalName();
		$uniqueName = time().$originalFile;
		$image->move($destinationPath, $uniqueName);
		$originalPath = $destinationPath.$uniqueName;
		
		$user = new User;
		$user->name = $request->input('teacher_name');
		$user->email = $request->input('email');
		$user->password = bcrypt($request->input('password'));
		$user->status = 1;
		$user->save();

		//dd($user);
	

		$data = [
			'teacher_name' => $teacher_name,
			'teacher_name_bangla' => $teacher_name_bangla,
			'teacher_global_id' => $teacher_global_id,
			'fathers_name' => $fathers_name,
			'mothers_name' => $mothers_name,
			'marital_status' =>$marital_status,
			'spouse_name'=>$spouse_name,
			'religion'=>$religion,
			'nationality'=>$nationality,
			'contact_no'=>$contact_no,
			'date_of_birth'=>$date_of_birth,
			'teacher_photo' => $originalPath,
			'present_address'=>$present_address,
			'permanent_address'=>$permanent_address,
			'salary'=>$salary,

			'designation'=>$designation,
			'subject'=>$teacher_subject,
			'comment'=>$teacher_comment,
			'nid_number'=>$nid_number,
			'joining_date'=>$teacher_joining_date,
			'blood_group'=>$blood_group,
			'user_id'=> $user->id
		];
		// print_r($data);
		// exit();
		
		try{
			$teacher = Teacher::create($data);
			$teach = Teacher::find($teacher->id);
			$teach->subject = $teacher_subject;
			$teach->comment = $teacher_comment;
			$teach->nid_number = $nid_number;
			$teach->joining_date = $teacher_joining_date;
			$teach->blood_group = $blood_group;
			$teach->gender = $gender;

			$teach->save();

			// $teacher->cardno()->save(new Attendancecard(['card_no' => $request->card_no]));
		}catch(\Exception $e){
			redirect()->back()->withInput();
		}

		
		
		if ($bank_check=="on") {	
			$bankAccount= new BankAccount;
			$bankAccount->account_holder_name=$request->input('account_holder_name');
			$bankAccount->bank_name=$request->input('bank_name');
			$bankAccount->branch_name=$request->input('branch_name');
			$bankAccount->account_number=$request->input('account_number');
			$bankAccount->account_type=$request->input('account_type');
			$bankAccount->routing_number=$request->input('routing_number');
			$bankAccount->comment=$request->input('bank_comment');
			$bankAccount->teacher_id=$teacher->id;
			$bankAccount->save();

		}
		else{
			$bankAccount= new BankAccount;
			$bankAccount->account_holder_name=" ";
			$bankAccount->bank_name=" ";
			$bankAccount->branch_name= " ";
			$bankAccount->account_number=" ";
			$bankAccount->account_type=" ";
			$bankAccount->routing_number=" ";
			$bankAccount->comment=" ";
			$bankAccount->teacher_id=$teacher->id;
			$bankAccount->save();
		}
		
	
		if ($mobile_check=="on") {
			$mobileBankAccount= new MobileBankAccount;
			$mobileBankAccount->mobile_account_holder_name=$request->input('mobile_account_holder_name');
			$mobileBankAccount->mobile_bank_name=$request->input('mobile_bank_name');
			$mobileBankAccount->mobile_account_number=$request->input('mobile_account_number');
			$mobileBankAccount->mobile_account_type=$request->input('mobile_account_type');
			$mobileBankAccount->mobile_routing_number=$request->input('mobile_routing_number');
			$mobileBankAccount->mobile_comment=$request->input('mobile_comment');
			$mobileBankAccount->teacher_id=$teacher->id;
			$mobileBankAccount->save();
		}
		else{
			$mobileBankAccount= new MobileBankAccount;
			$mobileBankAccount->mobile_account_holder_name=" ";
			$mobileBankAccount->mobile_bank_name=" ";
			$mobileBankAccount->mobile_account_number=" ";
			$mobileBankAccount->mobile_account_type=" ";
			$mobileBankAccount->mobile_routing_number=" ";
			$mobileBankAccount->mobile_comment=" ";
			$mobileBankAccount->teacher_id=$teacher->id;
			$mobileBankAccount->save();

		}
		
		
		if ($edu_check=="on") {
			for($i=0;$i<count($request->input('degree_name'));$i++){
				$educationalQualification= new EducationalQualification;
				$educationalQualification->degree_name=$request->input('degree_name')[$i];
				$educationalQualification->passing_year=$request->input('passing_year')[$i];
				$educationalQualification->result=$request->input('result')[$i];
				$educationalQualification->institute_name=$request->input('edu_institute_name')[$i];
				$educationalQualification->subject=$request->input('edu_subject')[$i];
				$educationalQualification->education_board=$request->input('education_board')[$i];
				$educationalQualification->comment=$request->input('education_comment')[$i];
				$educationalQualification->teacher_id=$teacher->id;
				$educationalQualification->save();

			} 
		}
		
		
		if ($Training=="on") {
			for($i=0;$i<count($request->input('training_institute_name'));$i++){
				$trainingInfo= new TrainingInfo;
				$trainingInfo->institute_name=$request->input('training_institute_name')[$i];
				$trainingInfo->subject=$request->input('training_subject')[$i];
				$trainingInfo->training_place=$request->input('training_place')[$i];
				$trainingInfo->starting_date=$request->input('starting_date')[$i];
				$trainingInfo->ending_date=$request->input('ending_date')[$i];
				$trainingInfo->expiration=$request->input('expiration')[$i];
				$trainingInfo->comment=$request->input('training_comment')[$i];
				$trainingInfo->teacher_id=$teacher->id;
				$trainingInfo->save();
			}
		}
		
		
		if ($prev_school=="on") {
			for($i=0;$i<count($request->input('prev_scl_institute_name'));$i++){
				$previousSchoolInfo= new PreviousSchoolInfo;
				$previousSchoolInfo->institute_name=$request->input('prev_scl_institute_name')[$i];
				$previousSchoolInfo->designation=$request->input('prev_scl_designation')[$i];
				$previousSchoolInfo->appoiment_date=$request->input('prev_scl_appoiment_date')[$i];
				$previousSchoolInfo->joining_date=$request->input('prev_scl_joining_date')[$i];
				$previousSchoolInfo->mpo_date=$request->input('mpo_date')[$i];
				$previousSchoolInfo->exemption_date=$request->input('exemption_date')[$i];
				$previousSchoolInfo->comment=$request->input('previous_school_comment')[$i];
				$previousSchoolInfo->teacher_id=$teacher->id;
				$previousSchoolInfo->save();
			}
		}

		if ($ntrca=="on") {
			for($i=0;$i<count($request->input('registation_no'));$i++){
				$ntrcaInfo= new NtrcaInfo;
				$ntrcaInfo->registation_no=$request->input('registation_no')[$i];
				$ntrcaInfo->roll_no=$request->input('roll_no')[$i];
				$ntrcaInfo->subject=$request->input('ntrca_subject')[$i];
				$ntrcaInfo->passing_year=$request->input('ntrca_passing_year')[$i];
				$ntrcaInfo->appoiment_date=$request->input('ntrca_appoiment_date')[$i];
				$ntrcaInfo->joining_date=$request->input('ntrca_joining_date')[$i];
				$ntrcaInfo->comment=$request->input('ntrca_comment')[$i];
				$ntrcaInfo->teacher_id=$teacher->id;
				$ntrcaInfo->save();
			}
		}

		$scale_change=$request->scale_change;
		if ($scale_change=="on") {
			for($i=0;$i<count($request->input('salary_grade'));$i++){
				$scaleChangingInfo= new ScaleChangingInfo;
				$scaleChangingInfo->salary_grade=$request->input('salary_grade')[$i];
				$scaleChangingInfo->present_salary_scale=$request->input('present_salary_scale')[$i];
				$scaleChangingInfo->first_mpo_joining_date=$request->input('first_mpo_joining_date')[$i];
				$scaleChangingInfo->first_high_scale_date=$request->input('first_high_scale_date')[$i];
				$scaleChangingInfo->second_high_scale_date=$request->input('second_high_scale_date')[$i];
				$scaleChangingInfo->first_time_scale_date=$request->input('first_time_scale_date')[$i];
				$scaleChangingInfo->second_time_scale_date=$request->input('second_time_scale_date')[$i];
				$scaleChangingInfo->bed_scale_date=$request->input('bed_scale_date')[$i];
				$scaleChangingInfo->comment=$request->input('scale_comment')[$i];
				$scaleChangingInfo->teacher_id=$teacher->id;
				$scaleChangingInfo->save();
			}
		}



		return redirect('/teachers');



	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Teacher  $teacher
	 * @return \Illuminate\Http\Response
	 */
	public function show(Teacher $teacher)
	{
		return view ('admin.teachers.show', ['teacher' => $teacher]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Teacher  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$teacher = Teacher::with('user')->find($id);
		$gender=Teacher::find($id);
		return view ('admin.teachers.edit', ['teacher' => $teacher,'gender'=>$gender]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Teacher  $teacher
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Teacher $teacher)
	{
		$uniqueVal = [
			'bail',
			'nullable',
			'integer'
		];
		if($teacher->cardno){
			$uniqueVal[] = 'unique:attendancecards,card_no,'.$teacher->cardno->id;
		}else{
			$uniqueVal[] = 'unique:attendancecards,card_no';
		}
		
		$this->validate($request, [
			'teacher_name' => 'required',
			'teacher_name_bangla' => 'required',
			
			'fathers_name' => 'required',
			'email' => 'required|string|email|max:255|unique:users,email,'.$teacher->user_id,
			'present_address' => 'required',
			'permanent_address' => 'required',
			'mothers_name' => 'required',
			'contact_no' => 'required|max:12',
			'marital_status' => 'required',
			'salary' => 'required',
			'religion' => 'required',
			'nationality' => 'required',
			'date_of_birth' => 'required',
			'designation' => 'required',
			'gender'=>'required',
			// 'spouse_name' => 'required',

			
			// 'degree_name' => 'required',
			// 'passing_year' => 'required',
			// 'result' => 'required',
			// 'institute_name' => 'required',
			// 'subject' => 'required',
			


			// 'registation_no' => 'required',
			// 'roll_no' => 'required',
			// 'passing_year' => 'required',
			// // 'appoiment_date' => 'required',
			// 'joining_date' => 'required',


			// 'exemption_date' => 'required',


			// 'training_place' => 'required',
			// 'starting_date' => 'required',
			// 'ending_date' => 'required',
			// 'expiration' => 'required',


			// 'account_holder_name' => 'required',
			// 'bank_name' => 'required',
			// 'branch_name' => 'required',
			// 'account_number' => 'required',
			// 'account_type' => 'required',
			// 'routing_number' => 'required',


			// 'mobile_account_holder_name' => 'required',
			// 'mobile_bank_name' => 'required',
			// 'mobile_account_number' => 'required',
			// 'mobile_account_type' => 'required',
			// 'mobile_account_holder_name' => 'required',
			

			// 'teacher_photo' => 'required|mimes:jpeg,jpg,bmp,png|unique:teachers',
			//'card_no' => $uniqueVal,


			// 'teacher_name' => 'required|unique:teachers,teacher_name,'.$teacher->id,
			// 'teacher_name_bangla' => 'required',
			// 'teacher_global_id' => 'bail|required|unique:teachers,teacher_global_id,'.$teacher->id,
			// 'fathers_name' => 'required',
			// 'email' => 'required|string|email|max:255|unique:users,email,'.$teacher->user_id,
			// 'password' => 'nullable|string|min:6',
			// 'present_address' => 'required',
			// 'permanent_address' => 'required',
			// 'mothers_name' => 'required',
			// 'designation' => 'required',
			// 'card_no' => $uniqueVal
		]);

		// $teacher_name = $request->input('teacher_name');
		// $teacher_global_id = $request->input('teacher_global_id');
		// $contact_no = $request->input('contact_no');
		// $date_of_birth = $request->input('date_of_birth');
		// $nationality = $request->input('nationality');
		// $religion = $request->input('religion');
		// $spouse_name = $request->input('spouse_name');
		// $fathers_name = $request->input('fathers_name');
		// $mothers_name = $request->input('mothers_name');
		// $present_address = $request->input('present_address');
		// $permanent_address = $request->input('permanent_address');
		// $marital_status = $request->input('marital_status');
		// $salary = $request->input('salary');
		// $designation = $request->input('designation');
		$teacher_name = $request->input('teacher_name');
		$teacher_name_bangla = $request->input('teacher_name_bangla');
		$designation = $request->input('designation');
		$teacher_global_id = $request->input('teacher_global_id');
		$contact_no = $request->input('contact_no');
		$date_of_birth = $request->input('date_of_birth');
		$nationality = $request->input('nationality');
		$religion = $request->input('religion');
		$spouse_name = $request->input('spouse_name');
		$fathers_name = $request->input('fathers_name');
		$mothers_name = $request->input('mothers_name');
		$present_address = $request->input('present_address');
		$permanent_address = $request->input('permanent_address');
		$gender = $request->input('gender');
		$salary = $request->input('salary');
		$marital_status = $request->input('marital_status');	
		$image = $request->file('teacher_photo');

		if($teacher->user_id != NULL){
			$user = User::findOrfail($teacher->user_id);
			$user->name = $request->input('teacher_name');
			$user->email = $request->input('email');
			if($request->input('password')){
				$user->password = bcrypt($request->input('password'));
			}

			$user->update();
		}
		else{
			$user = new User;
			$user->name = $request->input('teacher_name');
			$user->email = $request->input('email');
			$user->password = bcrypt(($request->input('password')?:123456));
			$user->status = 1;
			$user->save();
		}


		$teacher->user_id = $user->id;
		$teacher->teacher_name = $teacher_name;
		$teacher->teacher_name_bangla = $teacher_name_bangla;
		$teacher->teacher_global_id = $teacher_global_id;
		$teacher->fathers_name = $fathers_name;
		$teacher->mothers_name = $mothers_name;
		$teacher->marital_status = $marital_status;
		$teacher->spouse_name = $spouse_name;
		$teacher->religion = $religion;
		$teacher->nationality = $nationality;
		$teacher->contact_no = $contact_no;
		$teacher->date_of_birth = $date_of_birth;
		$teacher->present_address = $present_address;
		$teacher->permanent_address = $permanent_address;
		$teacher->salary = $salary;
		$teacher ->designation = $designation;
		$teacher ->gender = $gender;


		if (!is_null($image)) {
			unlink($teacher->teacher_photo);
			$destinationPath = 'img/';
			$originalFile = $image->getClientOriginalName();
			$uniqueName = time().$originalFile;
			$image->move($destinationPath, $uniqueName);
			$originalPath = $destinationPath.$uniqueName;
			$teacher->teacher_photo = $originalPath;
		}
		
		try{
			// $teacher->update();
			// $teach = Teacher::find($teacher->id);
			// $teach->subject = $teacher_subject;
			// $teach->comment = $teacher_comment;
			// $teach->nid_number = $nid_number;
			// $teach->joining_date = $teacher_joining_date;
			// $teach->blood_group = $blood_group;
			// $teach->subject = $teacher_subject;
			// $teach->save();
			// if($teacher->cardno)
			// 	$teacher->cardno()->delete();
			// $teacher->cardno()->save(new Attendancecard(['card_no' => $request->card_no]));
		}catch(\Exception $e){
			return redirect('/teachers')->with('successMsg', "Updated successfully")->withInput();
		}

		return redirect('/teachers')->with('successMsg', "Updated successfully");  
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Teacher  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$teacher = Teacher::find($id);
		$user_id = $teacher->user_id;
		$user_info = User::find($user_id);
		try {
			$teacher->delete();
			$user_info->status = 0;
			$user_info->update();
		}
		catch (\Illuminate\Database\QueryException $e) {
			return redirect('/teachers')->with('message', 'This teacher cannot be removed');
		}
		
		return redirect('/teachers')->with('message', 'Teacher removed');

	}

	public function GetDataForDataTable(Request $request) {
		$teacher = new Teacher();
		return $teacher->GetListForDataTable(
			$request->input('length'),
			$request->input('start'),
			$request->input('search')['value'],
			$request->input('status')
		);
	}


//method for changing password
	public function changePassword(Request $request){
		//return $request->all();
		$this->validate($request, [
			'oldpassword' => 'required',
			'password' =>'required'

		]);

		$hashedPassword = Auth::user()->password;
	   // return $hashedPassword;
		if(Hash::check($request->oldpassword, $hashedPassword)){
			$user = User::find(Auth::id());
			$user->password = Hash::make($request->password);
			$user->save();
			Auth::logout();
			return redirect()->route('login')->with('successMsg', "Password changed successfully");
		}else{
			return redirect()->back()->with('errorMsg', "Can not change password");
		}
	}

	public function updateStatus(Request $request, $id){
		$teacher = Teacher::find($id);
		//dd($request->status);
		if($request->status == 0){
			$teacher->status = 0;
		}else if($request->status == 1){
			$teacher->status = 1;
		}
		return (($teacher->update()) ? 1 : 0);
	}

	public function updateBasicInfo(Request $request, $id){
		$this->validate($request, [
			'teacher_name' => 'required',
			'teacher_name_bangla' => 'required',
			
			'fathers_name' => 'required',
			'email' => 'required|string|email|max:255',
			'present_address' => 'required',
			'permanent_address' => 'required',
			'mothers_name' => 'required',
			'contact_no' => 'required|max:12',
			'marital_status' => 'required',
			'salary' => 'required',
			'religion' => 'required',
			'nationality' => 'required',
			'date_of_birth' => 'required',
			'designation' => 'required',
			'gender'=>'required',
			
		]);

		
		$teacher= Teacher::find($id);

		$teacher_name = $request->input('teacher_name');
		$teacher_name_bangla = $request->input('teacher_name_bangla');
		$designation = $request->input('designation');
		$teacher_global_id = $request->input('teacher_global_id');
		$contact_no = $request->input('contact_no');
		$date_of_birth = $request->input('date_of_birth');
		$nationality = $request->input('nationality');
		$religion = $request->input('religion');
		$spouse_name = $request->input('spouse_name');
		$fathers_name = $request->input('fathers_name');
		$mothers_name = $request->input('mothers_name');
		$present_address = $request->input('present_address');
		$permanent_address = $request->input('permanent_address');
		$salary = $request->input('salary');
		$marital_status = $request->input('marital_status');
		$gender = $request->input('gender');

		$teacher_subject = $request->input('teacher_subject');	
		$teacher_comment = $request->input('teacher_comment');
		$nid_number = $request->input('nid_number');
		$teacher_joining_date = $request->input('teacher_joining_date');
		$blood_group = $request->input('blood_group');

		$image = $request->file('teacher_photo');

		if($teacher->user_id != NULL){
			$user = User::findOrfail($teacher->user_id);
			$user->name = $request->input('teacher_name');
			$user->email = $request->input('email');
			if($request->input('password')){
				$user->password = bcrypt($request->input('password'));
			}

			$user->update();
		}
		else{
			$user = new User;
			$user->name = $request->input('teacher_name');
			$user->email = $request->input('email');
			$user->password = bcrypt(($request->input('password')?:123456));
			$user->status = 1;
			$user->save();
		}

		$teacher->user_id = $user->id;
		$teacher->teacher_name = $teacher_name;
		$teacher->teacher_name_bangla = $teacher_name_bangla;
		$teacher->teacher_global_id = $teacher_global_id;
		$teacher->fathers_name = $fathers_name;
		$teacher->mothers_name = $mothers_name;
		$teacher->marital_status = $marital_status;
		$teacher->spouse_name = $spouse_name;
		$teacher->religion = $religion;
		$teacher->nationality = $nationality;
		$teacher->contact_no = $contact_no;
		$teacher->date_of_birth = $date_of_birth;
		$teacher->present_address = $present_address;
		$teacher->permanent_address = $permanent_address;
		$teacher->salary = $salary;
		
		$teacher->subject = $teacher_subject;
		$teacher->comment = $teacher_comment;
		$teacher->nid_number = $nid_number;
		$teacher->joining_date = $teacher_joining_date;
		$teacher->blood_group = $blood_group;

		$teacher ->designation = $designation;
		$teacher ->gender = $gender;

		if (!is_null($image)) {
			unlink($teacher->teacher_photo);
			$destinationPath = 'img/';
			$originalFile = $image->getClientOriginalName();
			$uniqueName = time().$originalFile;
			$image->move($destinationPath, $uniqueName);
			$originalPath = $destinationPath.$uniqueName;
			$teacher->teacher_photo = $originalPath;
		}
		$teacher->update();

		return back()->with('successMsg', "Updated successfully"); 


	}

	public function updateBank_accInfo(Request $request, $id){

		$this->validate($request, [
			'account_holder_name' => 'required',
			'bank_name' => 'required',
			
			'branch_name' => 'required',
			'account_number' => 'required',
			'account_type' => 'required',
			'routing_number' => 'required',
		]);
		
		$bankAccount=BankAccount::find($id);
		$bankAccount->account_holder_name=$request->input('account_holder_name');
		$bankAccount->bank_name=$request->input('bank_name');
		$bankAccount->branch_name=$request->input('branch_name');
		$bankAccount->account_number=$request->input('account_number');
		$bankAccount->account_type=$request->input('account_type');
		$bankAccount->routing_number=$request->input('routing_number');
		$bankAccount->comment=$request->input('comment');
		$bankAccount->update();
		return back()->with('successMsg', "Updated successfully");
	}

	public function updateMbl_accInfo(Request $request, $id){

		$this->validate($request, [
			'mobile_account_holder_name' => 'required',
			'mobile_bank_name' => 'required',
			
			'mobile_account_number' => 'required',
			'mobile_account_type' => 'required',
			
			
		]);

		$mobileBankAccount=MobileBankAccount::find($id);
		$mobileBankAccount->mobile_account_holder_name=$request->input('mobile_account_holder_name');
		$mobileBankAccount->mobile_bank_name=$request->input('mobile_bank_name');
		$mobileBankAccount->mobile_account_number=$request->input('mobile_account_number');
		$mobileBankAccount->mobile_account_type=$request->input('mobile_account_type');
		$mobileBankAccount->mobile_routing_number=$request->input('mobile_routing_number');
		$mobileBankAccount->mobile_comment=$request->input('mobile_comment');
		$mobileBankAccount->update();
		return back()->with('successMsg', "Updated successfully");

	}

	public function updateEdu_info(Request $request, $id){
		$this->validate($request, [
			'degree_name' => 'required',
			'passing_year' => 'required',
			
			'result' => 'required',
			'institute_name' => 'required',
			'subject' => 'required',

		]);
		$educationalQualification=EducationalQualification::find($id);
		$educationalQualification->degree_name=$request->input('degree_name');
		$educationalQualification->passing_year=$request->input('passing_year');
		$educationalQualification->result=$request->input('result');
		$educationalQualification->institute_name=$request->input('institute_name');
		$educationalQualification->subject=$request->input('subject');
		$educationalQualification->education_board=$request->input('education_board');
		$educationalQualification->comment=$request->input('education_comment');
		$educationalQualification->update();
		return back()->with('successMsg', "Updated successfully"); 
	}

	public function del_edu_info($id){
		$educationalQualification=EducationalQualification::find($id);
		$educationalQualification->delete();
		return back()->with('danger', "Deleted successfully"); 
	}

	public function updateTraining_info(Request $request, $id){
		$this->validate($request, [
			'institute_name' => 'required',
			'subject' => 'required',
			
			'training_place' => 'required',
			'starting_date' => 'required',
			'ending_date' => 'required',
			'expiration' => 'required',

		]);

		$trainingInfo=TrainingInfo::find($id);
		$trainingInfo->institute_name=$request->input('institute_name');
		$trainingInfo->subject=$request->input('subject');
		$trainingInfo->training_place=$request->input('training_place');
		$trainingInfo->starting_date=$request->input('starting_date');
		$trainingInfo->ending_date=$request->input('ending_date');
		$trainingInfo->expiration=$request->input('expiration');
		$trainingInfo->comment=$request->input('comment');
		$trainingInfo->update();
		return back()->with('successMsg', "Updated successfully"); 
	}
	public function del_training_info($id){
		$training=TrainingInfo::find($id);
		$training->delete();
		return back()->with('danger', "Deleted successfully"); 
	}

	public function updatePrev_scl_info(Request $request, $id){
           $this->validate($request, [
			'institute_name' => 'required',
			'designation' => 'required',
			
			'joining_date' => 'required',
			'exemption_date' => 'required',

		]);
		$previousSchoolInfo=PreviousSchoolInfo::find($id);
		$previousSchoolInfo->institute_name=$request->input('institute_name');
		$previousSchoolInfo->designation=$request->input('designation');
		$previousSchoolInfo->appoiment_date=$request->input('appoiment_date');
		$previousSchoolInfo->joining_date=$request->input('joining_date');
		$previousSchoolInfo->mpo_date=$request->input('mpo_date');
		$previousSchoolInfo->exemption_date=$request->input('exemption_date');
		$previousSchoolInfo->comment=$request->input('comment');
		$previousSchoolInfo->update();
		return back()->with('successMsg', "Updated successfully");

	}

	public function del_prev_scl_info($id){
		$training=PreviousSchoolInfo::find($id);
		$training->delete();
		return back()->with('danger', "Deleted successfully"); 
	}

	public function updateNtrca_info(Request $request, $id){
		 $this->validate($request, [
			'registation_no' => 'required',
			'roll_no' => 'required',
			
			'subject' => 'required',
			'passing_year' => 'required',
			'appoiment_date' => 'required',
			'joining_date' => 'required',

		]);
		$ntrcaInfo=NtrcaInfo::find($id);
		$ntrcaInfo->registation_no=$request->input('registation_no');
		$ntrcaInfo->roll_no=$request->input('roll_no');
		$ntrcaInfo->subject=$request->input('subject');
		$ntrcaInfo->passing_year=$request->input('passing_year');
		$ntrcaInfo->appoiment_date=$request->input('appoiment_date');
		$ntrcaInfo->joining_date=$request->input('joining_date');
		$ntrcaInfo->comment=$request->input('comment');
		$ntrcaInfo->update();
		return back()->with('successMsg', "Updated successfully");

	}
	
	public function del_ntrca_info($id){
		$training=NtrcaInfo::find($id);
		$training->delete();
		return back()->with('danger', "Deleted successfully"); 
	}

	public function updateScale_chng_info(Request $request, $id){

		$scaleChangingInfo=ScaleChangingInfo::find($id);
		$scaleChangingInfo->salary_grade=$request->input('salary_grade');
		$scaleChangingInfo->present_salary_scale=$request->input('present_salary_scale');
		$scaleChangingInfo->first_mpo_joining_date=$request->input('first_mpo_joining_date');
		$scaleChangingInfo->first_high_scale_date=$request->input('first_high_scale_date');
		$scaleChangingInfo->second_high_scale_date=$request->input('second_high_scale_date');
		$scaleChangingInfo->first_time_scale_date=$request->input('first_time_scale_date');
		$scaleChangingInfo->second_time_scale_date=$request->input('second_time_scale_date');
		$scaleChangingInfo->bed_scale_date=$request->input('bed_scale_date');
		$scaleChangingInfo->comment=$request->input('comment');
		$scaleChangingInfo->update();
		return back()->with('successMsg', "Updated successfully");

	}
	public function del_scale_changing_info($id){
		$training=ScaleChangingInfo::find($id);
		$training->delete();
		return back()->with('danger', "Deleted successfully"); 
	}

	public function more_edu_info(Request $request, $tid){
		$this->validate($request, [
			'degree_name' => 'required',
			'passing_year' => 'required',
			
			'result' => 'required',
			'edu_institute_name' => 'required',
			'edu_subject' => 'required',

		]);
		$educationalQualification= new EducationalQualification;
		$educationalQualification->degree_name=$request->input('degree_name');
		$educationalQualification->passing_year=$request->input('passing_year');
		$educationalQualification->result=$request->input('result');
		$educationalQualification->institute_name=$request->input('edu_institute_name');
		$educationalQualification->subject=$request->input('edu_subject');
		$educationalQualification->education_board=$request->input('education_board');
		$educationalQualification->comment=$request->input('education_comment');
		$educationalQualification->teacher_id=$tid;
		$educationalQualification->save();
		return back()->with('success', "Added successfully");
	}

	public function more_training_info(Request $request, $tid){
		$this->validate($request, [
			'training_institute_name' => 'required',
			'training_subject' => 'required',
			
			'training_place' => 'required',
			'starting_date' => 'required',
			'ending_date' => 'required',
			'expiration' => 'required',

		]);

		$trainingInfo= new TrainingInfo;
		$trainingInfo->institute_name=$request->input('training_institute_name');
		$trainingInfo->subject=$request->input('training_subject');
		$trainingInfo->training_place=$request->input('training_place');
		$trainingInfo->starting_date=$request->input('starting_date');
		$trainingInfo->ending_date=$request->input('ending_date');
		$trainingInfo->expiration=$request->input('expiration');
		$trainingInfo->comment=$request->input('training_comment');
		$trainingInfo->teacher_id=$tid;
		$trainingInfo->save();
		return back()->with('success', "Added successfully");
	}

	public function more_prev_scl_info(Request $request, $tid){
			$this->validate($request, [
			'prev_scl_institute_name' => 'required',
			'prev_scl_designation' => 'required',
			
			'prev_scl_joining_date' => 'required',
			'exemption_date' => 'required',

		]);
		$previousSchoolInfo= new PreviousSchoolInfo;
		$previousSchoolInfo->institute_name=$request->input('prev_scl_institute_name');
		$previousSchoolInfo->designation=$request->input('prev_scl_designation');
		$previousSchoolInfo->appoiment_date=$request->input('prev_scl_appoiment_date');
		$previousSchoolInfo->joining_date=$request->input('prev_scl_joining_date');
		$previousSchoolInfo->mpo_date=$request->input('mpo_date');
		$previousSchoolInfo->exemption_date=$request->input('exemption_date');
		$previousSchoolInfo->comment=$request->input('previous_school_comment');
		$previousSchoolInfo->teacher_id=$tid;
		$previousSchoolInfo->save();
		return back()->with('success', "Added successfully");

	}

	public function more_ntrca_info(Request $request, $tid){
		$this->validate($request, [
			'registation_no' => 'required',
			'roll_no' => 'required',
			
			'ntrca_subject' => 'required',
			'ntrca_passing_year' => 'required',
			'ntrca_appoiment_date' => 'required',
			'ntrca_joining_date' => 'required',

		]);
		$ntrcaInfo= new NtrcaInfo;
		$ntrcaInfo->registation_no=$request->input('registation_no');
		$ntrcaInfo->roll_no=$request->input('roll_no');
		$ntrcaInfo->subject=$request->input('ntrca_subject');
		$ntrcaInfo->passing_year=$request->input('ntrca_passing_year');
		$ntrcaInfo->appoiment_date=$request->input('ntrca_appoiment_date');
		$ntrcaInfo->joining_date=$request->input('ntrca_joining_date');
		$ntrcaInfo->comment=$request->input('ntrca_comment');
		$ntrcaInfo->teacher_id=$tid;
		$ntrcaInfo->save();
		return back()->with('success', "Added successfully");
	}
	public function more_scale_change_info(Request $request, $tid){
		$scaleChangingInfo= new ScaleChangingInfo;
		$scaleChangingInfo->salary_grade=$request->input('salary_grade');
		$scaleChangingInfo->present_salary_scale=$request->input('present_salary_scale');
		$scaleChangingInfo->first_mpo_joining_date=$request->input('first_mpo_joining_date');
		$scaleChangingInfo->first_high_scale_date=$request->input('first_high_scale_date');
		$scaleChangingInfo->second_high_scale_date=$request->input('second_high_scale_date');
		$scaleChangingInfo->first_time_scale_date=$request->input('first_time_scale_date');
		$scaleChangingInfo->second_time_scale_date=$request->input('second_time_scale_date');
		$scaleChangingInfo->bed_scale_date=$request->input('bed_scale_date');
		$scaleChangingInfo->comment=$request->input('scale_comment');
		$scaleChangingInfo->teacher_id=$tid;
		$scaleChangingInfo->save();
		return back()->with('success', "Added successfully");
	}

	public  function updatePassword(Request $request) {
			$this->validate($request, [
			'oldpassword' => 'required',
			'password' =>'required'

		]);
         
		$hashedPassword = Auth::user()->password;
	   // return $hashedPassword;
		if(Hash::check($request->oldpassword, $hashedPassword)){
			$user = User::find(Auth::id());
			$user->password = Hash::make($request->password);
			$user->save();
			
			return redirect()->back()->with('successMsg', "Password changed successfully");
		}else{
			return redirect()->back()->with('errorMsg', "User or Old Password does not match");
		}
	}



}
