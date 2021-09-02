<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Level;
use App\Result;
use App\Section;
use App\Student;
use App\Attendancecard;
use Redirect;
use App\Subject;
use App\Shift;
use App\Branch;
use App\PublicExam;
use App\PresentAddress;
use App\PermanentAddress;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Rule;

class StudentController extends Controller
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
		
		$students = [];//Student::with('section_student_current.section.level_enroll.session','section_student_current.section.level_enroll.branch','section_student_current.section.level_enroll.level')->get();
		// $students = Student::all();
		// dd($students[0]);
		return view('admin.students.index', ['students' => $students]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		/*$levels = Level::with('section')->get();
		$sections = Section::pluck('section_name', 'id');*/
		return view('admin.students.create');
	}
	public function create_old()
	{

		return view('admin.students.create_old');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, ['name' => 'required',
			'name_bangla' => 'required',
			//  'roll_no' => 'bail|required|unique:students,roll_no',
			'fathers_name' => 'required',
			'fathers_name_bangla' => 'required',
			'mothers_name' => 'required',
			'mothers_name_bangla' => 'required',
			'date_of_birth' => 'required',
			'birth_place' => 'required',
			'admission_date' => 'required',
			'admission_class' => 'required|numeric',
			'admission_type' => 'required',
			'nationality' => 'required',
			'religion' => 'required',
			'birth_certificate_number' => 'required',
			'previous_school_name' => 'required',
			'previous_school_address' => 'required',

			'contact_no' => 'required|numeric',
			// 'card_no' => 'bail|nullable|integer|unique:attendancecards,card_no',
			'student_photo' => 'required|mimes:jpeg,bmp,png,jpg|unique:students',
			'birth_certificate_image'=>'mimes:jpeg,bmp,png,jpg|unique:students' 
		]);
		//Multydata Validation
		$check = $request->public_exam_check;
		if($check=="on"){
			$this->validate($request, ['exam_name' => 'required',
				'year' => 'required',
			]);
		}

		//set input value in a variable
		$name = $request->input('name');
	//	$roll_no = $request->input('roll_no');
		$date_of_birth = $request->input('date_of_birth');
		$admission_date = $request->input('admission_date');
		$nationality = $request->input('nationality');
		$religion = $request->input('religion');
		$gender = $request->input('gender');
		$fathers_name = $request->input('fathers_name');
		$mothers_name = $request->input('mothers_name');
		$present_address = "-";
		$permanent_address = "-";
		
		$contact_no = $request->input('contact_no');
		$fathers_cell = $request->input('fathers_cell');
		$mothers_cell = $request->input('mothers_cell');
		$birth_place = $request->input('birth_place');

		$name_bangla =  $request->input('name_bangla');
		$fathers_name_bangla =  $request->input('fathers_name_bangla');
		$mothers_name_bangla =  $request->input('mothers_name_bangla');
		$local_guardian_name =  $request->input('local_guardian_name');
		$local_guardian_address =  $request->input('local_guardian_address');
		$student_guardian_relationship =  $request->input('student_guardian_relationship');
		$birth_certificate_number =  $request->input('birth_certificate_number');
		$local_guardian_cell =  $request->input('local_guardian_cell');
		$previous_school_name =  $request->input('previous_school_name');
		$previous_school_address =  $request->input('previous_school_address');
		$admission_class =  $request->input('admission_class');
		$admission_department =  $request->input('admission_department');
		$admission_type =  $request->input('admission_type');
		$blood_group =  $request->input('blood_group');

		$scholarship =  $request->input('scholarship');
		$mother_nid =  $request->input('mother_nid');
		$father_nid =  $request->input('father_nid');
		$gvt_unique_id =  $request->input('gvt_unique_id');
		$father_profession =  $request->input('father_profession');
		$mother_profession =  $request->input('mother_profession');
		$previous_school_class =  $request->input('previous_school_class');
		$previous_school_testimonial_number =  $request->input('previous_school_testimonial_number');
		$previous_school_testimonial_date =  $request->input('previous_school_testimonial_date');
		$tc_number =  $request->input('tc_number');
		$tc_date =  $request->input('tc_date');

		$status = $request->input('status');
		$added_by =  Auth::user()->name;


		//Generate unique roll_no format
		$year = date('Y') % 100;
		$c1 = $admission_class / 10;
		$c2 = $admission_class % 10;
		$c1 = (int)$c1;
		$class = (string)$c1 . (string)$c2;
		
		$j=0;
		for($j=0; ;$j++){
			$roll_no = (string)$year . $class . rand(100,999);
			$count = DB::table('students')->where('roll_no',$roll_no)->count();
			if($count == 0){
				break;
			}
		}

		$certificate_image=$request->file('birth_certificate_image');

		/*******/

		$image = $request->file('student_photo');
		$destinationPath = 'img/';
		$originalFile = $image->getClientOriginalName();
		$uniqueName = date("Y-m-d").$originalFile;
		$image->move($destinationPath, $uniqueName);
		$originalPath = $destinationPath.$uniqueName;

		
		if(!is_null($certificate_image)){

			$destinationPath1 = 'img/';
			$originalFile1 = $certificate_image->getClientOriginalName();
			$uniqueName1 = date("Y-m-d").$originalFile1;
			$certificate_image->move($destinationPath1, $uniqueName1);
			$originalPath1 = $destinationPath1.$uniqueName1;
			// echo $originalPath1;
			$data = [
				'name' => $name, 
				'name_bangla' => $name_bangla,
				'roll_no' => $roll_no, 
				'fathers_name' => $fathers_name, 
				'fathers_name_bangla' => $fathers_name_bangla, 
				'mothers_name' => $mothers_name, 
				'mothers_name_bangla' => $mothers_name_bangla,
				'local_guardian_name' => $local_guardian_name,
				'date_of_birth' => $date_of_birth, 
				'admission_date' => $admission_date,
				'nationality' => $nationality, 
				'religion' => $religion, 
				'gender' => $gender, 
				'present_address' => $present_address, 
				'permanent_address' => $permanent_address,
				'local_guardian_address' => $local_guardian_address,
				'student_guardian_relationship' => $student_guardian_relationship,
				'mothers_cell' => $mothers_cell,
				'birth_place' => $birth_place,
				'birth_certificate_number' => $birth_certificate_number,
				'contact_no' => $contact_no, 
				'fathers_cell' => $fathers_cell, 
				'local_guardian_cell' => $local_guardian_cell,
				'previous_school_name' => $previous_school_name,
				'previous_school_address' => $previous_school_address,
				'admission_class' => $admission_class,
				'admission_department' => $admission_department,
				'admission_type' => $admission_type,
				'status' => $status,
				'added_by' => $added_by,
				'student_photo' => $originalPath,

			];
			$student = Student::create($data);
			$id= $student->id;
			$stu=Student::find($id);
			$stu->birth_certificate_image=$originalPath1;
			$stu->blood_group=$blood_group;
			$stu->father_nid_num=$father_nid;
			$stu->mother_nid_num=$mother_nid;
			$stu->scholarship=$scholarship;
			$stu->gvt_unique_id=$gvt_unique_id;
			$stu->father_profession=$father_profession;
			$stu->mother_profession=$mother_profession;
			$stu->previous_school_class=$previous_school_class;
			$stu->previous_school_testimonial_number=$previous_school_testimonial_number;
			$stu->previous_school_testimonial_date=$previous_school_testimonial_date;
			$stu->tc_number=$tc_number;
			$stu->tc_date=$tc_date;
			$stu->save();

		}

		else{
			$data = [
				'name' => $name, 
				'name_bangla' => $name_bangla,
				'roll_no' => $roll_no, 
				'fathers_name' => $fathers_name, 
				'fathers_name_bangla' => $fathers_name_bangla, 
				'mothers_name' => $mothers_name, 
				'mothers_name_bangla' => $mothers_name_bangla,
				'local_guardian_name' => $local_guardian_name,
				'date_of_birth' => $date_of_birth, 
				'admission_date' => $admission_date,
				'nationality' => $nationality, 
				'religion' => $religion, 
				'gender' => $gender, 
				'present_address' => $present_address, 
				'permanent_address' => $permanent_address,
				'local_guardian_address' => $local_guardian_address,
				'student_guardian_relationship' => $student_guardian_relationship,
				'mothers_cell' => $mothers_cell,
				'birth_place' => $birth_place,
				'birth_certificate_number' => $birth_certificate_number,
				'contact_no' => $contact_no, 
				'fathers_cell' => $fathers_cell, 
				'local_guardian_cell' => $local_guardian_cell,
				'previous_school_name' => $previous_school_name,
				'previous_school_address' => $previous_school_address,
				'admission_class' => $admission_class,
				'admission_department' => $admission_department,
				'admission_type' => $admission_type,
				'status' => $status,
				'added_by' => $added_by,
				'student_photo' => $originalPath
			];
			$student = Student::create($data);
			$id= $student->id;
			$stu=Student::find($id);
			$stu->blood_group=$blood_group;
			$stu->father_nid_num=$father_nid;
			$stu->mother_nid_num=$mother_nid;
			$stu->scholarship=$scholarship;
			$stu->gvt_unique_id=$gvt_unique_id;
			$stu->father_profession=$father_profession;
			$stu->mother_profession=$mother_profession;
			$stu->previous_school_class=$previous_school_class;
			$stu->previous_school_testimonial_number=$previous_school_testimonial_number;
			$stu->previous_school_testimonial_date=$previous_school_testimonial_date;
			$stu->tc_number=$tc_number;
			$stu->tc_date=$tc_date;
			$stu->save();

		}

		//present Address data store
		$PresentAddress = new PresentAddress;
		$PresentAddress->student_id = $student->id;
		$PresentAddress->village = $request->village;
		$PresentAddress->post_office = $request->post_office;
		$PresentAddress->upazila = $request->upazila;
		$PresentAddress->district = $request->district;
		$PresentAddress->save();

		//permanent Address data store
		$PermanentAddress = new PermanentAddress;
		$PermanentAddress->student_id = $student->id;
		$PermanentAddress->village = $request->village_name;
		$PermanentAddress->post_office = $request->post_office_name;
		$PermanentAddress->upazila = $request->upazila_name;
		$PermanentAddress->district = $request->district_name;
		$PermanentAddress->save();

		//public_exam data store
		$check = $request->public_exam_check;
		if($check=="on"){
			$i=0;
			if (count($request->exam_name) > 0) {
				foreach ($request->exam_name as $e_name) {
					$PublicExam= new PublicExam;
					$PublicExam->student_id = $student->id;
					$PublicExam->exam_name = $e_name;
					$PublicExam->year = $request->year[$i];
					$PublicExam->roll_no = $request->public_roll_no[$i];
					$PublicExam->reg_no = $request->reg_no[$i];
					$PublicExam->board = $request->board[$i];
					$PublicExam->department = $request->department[$i];
					$PublicExam->result = $request->result[$i];
					$PublicExam->save();
					$i++;
				}	
			}
		}

		
		

		// try{
		// 	$student = Student::create($data);
		// 	// echo $student;
		// 	// exit();
		// 	$student->cardno()->save(new Attendancecard(['card_no' => $request->card_no]));
		// }catch(\Exception $e){
		// 	redirect()->back()->withInput();
		// }
		return redirect('/students')->with('message', 'New Student Added');
	}


	public function store_old(Request $request)
	{
		$this->validate($request, ['name' => 'required',
			'name_bangla' => 'required',
			'roll_no' => 'required|unique:students',
			'fathers_name' => 'required',
			'fathers_name_bangla' => 'required',
			'mothers_name' => 'required',
			'mothers_name_bangla' => 'required',
			'date_of_birth' => 'required',
			'birth_place' => 'required',
			'admission_date' => 'required',
			'admission_class' => 'required|numeric',
			'nationality' => 'required',
			'religion' => 'required',
			'admission_type' => 'required',

			'birth_certificate_number' => 'required',
			'previous_school_name' => 'required',
			'previous_school_address' => 'required',

			'contact_no' => 'required|numeric',
			 // 'card_no' => 'bail|nullable|integer|unique:attendancecards,card_no',
			'student_photo' => 'required|mimes:jpeg,bmp,png,jpg|unique:students'   
		]);
		
		$check = $request->public_exam_check;
		if($check=="on"){
			$this->validate($request, ['exam_name' => 'required',
				'year' => 'required',
			]);
		}

		//set input value in a variable
		$name = $request->input('name');
		$roll_no = $request->input('roll_no');
		$date_of_birth = $request->input('date_of_birth');
		$admission_date = $request->input('admission_date');
		$nationality = $request->input('nationality');
		$religion = $request->input('religion');
		$gender = $request->input('gender');
		$fathers_name = $request->input('fathers_name');
		$mothers_name = $request->input('mothers_name');
		$present_address = "-";
		$permanent_address = "-";
		
		$contact_no = $request->input('contact_no');
		$fathers_cell = $request->input('fathers_cell');
		$mothers_cell = $request->input('mothers_cell');
		$birth_place = $request->input('birth_place');

		$father_profession =  $request->input('father_profession');
		$mother_profession =  $request->input('mother_profession');
		$previous_school_class =  $request->input('previous_school_class');
		$previous_school_testimonial_number =  $request->input('previous_school_testimonial_number');
		$previous_school_testimonial_date =  $request->input('previous_school_testimonial_date');
		$tc_number =  $request->input('tc_number');
		$tc_date =  $request->input('tc_date');

		$blood_group =  $request->input('blood_group');
		$scholarship =  $request->input('scholarship');
		$mother_nid =  $request->input('mother_nid');
		$father_nid =  $request->input('father_nid');
		$gvt_unique_id =  $request->input('gvt_unique_id');

		$name_bangla =  $request->input('name_bangla');
		$fathers_name_bangla =  $request->input('fathers_name_bangla');
		$mothers_name_bangla =  $request->input('mothers_name_bangla');
		$local_guardian_name =  $request->input('local_guardian_name');
		$local_guardian_address =  $request->input('local_guardian_address');
		$student_guardian_relationship =  $request->input('student_guardian_relationship');
		$birth_certificate_number =  $request->input('birth_certificate_number');
		$local_guardian_cell =  $request->input('local_guardian_cell');
		$previous_school_name =  $request->input('previous_school_name');
		$previous_school_address =  $request->input('previous_school_address');
		$admission_class =  $request->input('admission_class');
		$admission_department =  $request->input('admission_department');
		$admission_type =  $request->input('admission_type');
		$status = $request->input('status');

		$certificate_image=$request->file('birth_certificate_image');

		$added_by =  Auth::user()->name;


		

		/*******/
		$image = $request->file('student_photo');
		$destinationPath = 'img/';
		$originalFile = $image->getClientOriginalName();
		$uniqueName = date("Y-m-d").$originalFile;
		$image->move($destinationPath, $uniqueName);
		$originalPath = $destinationPath.$uniqueName;
		$data = [
			'name' => $name, 
			'name_bangla' => $name_bangla,
			'roll_no' => $roll_no, 
			'fathers_name' => $fathers_name, 
			'fathers_name_bangla' => $fathers_name_bangla, 
			'mothers_name' => $mothers_name, 
			'mothers_name_bangla' => $mothers_name_bangla,
			'local_guardian_name' => $local_guardian_name,
			'date_of_birth' => $date_of_birth, 
			'admission_date' => $admission_date,
			'nationality' => $nationality, 
			'religion' => $religion, 
			'gender' => $gender, 
			'present_address' => $present_address, 
			'permanent_address' => $permanent_address,
			'local_guardian_address' => $local_guardian_address,
			'student_guardian_relationship' => $student_guardian_relationship,
			'mothers_cell' => $mothers_cell,
			'birth_place' => $birth_place,
			'birth_certificate_number' => $birth_certificate_number,
			'contact_no' => $contact_no, 
			'fathers_cell' => $fathers_cell, 
			'local_guardian_cell' => $local_guardian_cell,
			'previous_school_name' => $previous_school_name,
			'previous_school_address' => $previous_school_address,
			'admission_class' => $admission_class,
			'admission_department' => $admission_department,
			'admission_type' => $admission_type,
			'status' => $status,
			'added_by' => $added_by,
			'student_photo' => $originalPath
		];

		
		$student = Student::create($data);
		$id= $student->id;
		$stu=Student::find($id);
		$stu->blood_group=$blood_group;
		$stu->father_nid_num=$father_nid;
		$stu->mother_nid_num=$mother_nid;
		$stu->scholarship=$scholarship;
		$stu->gvt_unique_id=$gvt_unique_id;
		$stu->father_profession=$father_profession;
		$stu->mother_profession=$mother_profession;
		$stu->previous_school_class=$previous_school_class;
		$stu->previous_school_testimonial_number=$previous_school_testimonial_number;
		$stu->previous_school_testimonial_date=$previous_school_testimonial_date;
		$stu->tc_number=$tc_number;
		$stu->tc_date=$tc_date;

		if(!is_null($certificate_image)){


			$destinationPath1 = 'img/';
			$originalFile1 = $certificate_image->getClientOriginalName();
			$uniqueName1 = date("Y-m-d").$originalFile1;
			$certificate_image->move($destinationPath1, $uniqueName1);
			$originalPath1 = $destinationPath1.$uniqueName1;
			$stu->birth_certificate_image=$originalPath1;

			

		}

		$stu->save();



		//present Address data store
		$PresentAddress = new PresentAddress;
		$PresentAddress->student_id = $student->id;
		$PresentAddress->village = $request->village;
		$PresentAddress->post_office = $request->post_office;
		$PresentAddress->upazila = $request->upazila;
		$PresentAddress->district = $request->district;
		$PresentAddress->save();

		//permanent Address data store
		$PermanentAddress = new PermanentAddress;
		$PermanentAddress->student_id = $student->id;
		$PermanentAddress->village = $request->village_name;
		$PermanentAddress->post_office = $request->post_office_name;
		$PermanentAddress->upazila = $request->upazila_name;
		$PermanentAddress->district = $request->district_name;
		$PermanentAddress->save();

		//public_exam data store
		$check = $request->public_exam_check;
		if($check=="on"){
			$i=0;
			if (count($request->exam_name) > 0) {
				foreach ($request->exam_name as $e_name) {
					$PublicExam= new PublicExam;
					$PublicExam->student_id = $student->id;
					$PublicExam->exam_name = $e_name;
					$PublicExam->year = $request->year[$i];
					$PublicExam->roll_no = $request->public_roll_no[$i];
					$PublicExam->reg_no = $request->reg_no[$i];
					$PublicExam->board = $request->board[$i];
					$PublicExam->department = $request->department[$i];
					$PublicExam->result = $request->result[$i];
					$PublicExam->save();
					$i++;
				}	
			}
		}

		
		

		// try{
		// 	$student = Student::create($data);
		// 	// echo $student;
		// 	// exit();
		// 	$student->cardno()->save(new Attendancecard(['card_no' => $request->card_no]));
		// }catch(\Exception $e){
		// 	redirect()->back()->withInput();
		// }
		return redirect('/students')->with('message', 'Student Added');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Student $student
	 * @return \Illuminate\Http\Response
	 */
	public function show(Student $student)
	{
		/*$level = Level::find($student->level_id);
		$shift = Shift::find($level->shift_id);
		$branches = Branch::find($shift->branch_id);*/
		//dd($shift);
		return view('admin.students.show', ['student' => $student]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Student $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$student = Student::find($id);
		$levels = Level::pluck('class_name', 'id');
		$sections = Section::pluck('section_name', 'id');
		return view('admin.students.edit', ['student' => $student, 'levels' => $levels, 'sections' => $sections]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Student $student
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Student $student)
	{
		// $uniqueVal = [
		// 	'bail',
		// 	'nullable',
		// 	'integer'
		// ];
		// if($student->cardno){
		// 	$uniqueVal[] = 'unique:attendancecards,card_no,'.$student->cardno->id;
		// }else{
		// 	$uniqueVal[] = 'unique:attendancecards,card_no';
		// }
		$this->validate($request, ['name' => 'required',
			'roll_no' => 'bail|required|unique:students,roll_no,'.$student->id,
			'fathers_name' => 'required',
			'fathers_name_bangla' => 'required',
			'mothers_name' => 'required',
			'mothers_name_bangla' => 'required',
			'date_of_birth' => 'required',
			'birth_place' => 'required',
			'admission_date' => 'required',
			'admission_class' => 'required|numeric',
			'admission_type' => 'required',
			'nationality' => 'required',
			'religion' => 'required',
			'birth_certificate_number' => 'required',
			'previous_school_name' => 'required',
			'previous_school_address' => 'required',

			'contact_no' => 'required|numeric',
			// 'card_no' => 'bail|nullable|integer|unique:attendancecards,card_no',
			'student_photo' => 'mimes:jpeg,bmp,png,jpg|unique:students',
			'birth_certificate_image'=>'mimes:jpeg,bmp,png,jpg|unique:students' 

		]);
		$name = $request->input('name');
		$roll_no = $request->input('roll_no');
		$date_of_birth = $request->input('date_of_birth');
		$admission_date = $request->input('admission_date');
		$nationality = $request->input('nationality');
		$religion = $request->input('religion');
		$gender = $request->input('gender');
		$fathers_name = $request->input('fathers_name');
		$mothers_name = $request->input('mothers_name');
		// $present_address = $request->input('present_address');
		// $permanent_address = $request->input('permanent_address');

		
		$contact_no = $request->input('contact_no');
		$fathers_cell = $request->input('fathers_cell');
		$mothers_cell = $request->input('mothers_cell');
		$birth_place = $request->input('birth_place');
		$status = $request->input('status');

		$blood_group =  $request->input('blood_group');
		$scholarship =  $request->input('scholarship');
		$mother_nid =  $request->input('mother_nid');
		$father_nid =  $request->input('father_nid');
		$gvt_unique_id =  $request->input('gvt_unique_id');
		$father_profession =  $request->input('father_profession');
		$mother_profession =  $request->input('mother_profession');
		$previous_school_class =  $request->input('previous_school_class');
		$previous_school_testimonial_number =  $request->input('previous_school_testimonial_number');
		$previous_school_testimonial_date =  $request->input('previous_school_testimonial_date');
		$tc_number =  $request->input('tc_number');
		$tc_date =  $request->input('tc_date');

		$name_bangla =  $request->input('name_bangla');
		$fathers_name_bangla =  $request->input('fathers_name_bangla');
		$mothers_name_bangla =  $request->input('mothers_name_bangla');
		$local_guardian_name =  $request->input('local_guardian_name');
		$local_guardian_address =  $request->input('local_guardian_address');
		$student_guardian_relationship =  $request->input('student_guardian_relationship');
		$birth_certificate_number =  $request->input('birth_certificate_number');
		$local_guardian_cell =  $request->input('local_guardian_cell');
		$previous_school_name =  $request->input('previous_school_name');
		$previous_school_address =  $request->input('previous_school_address');
		$admission_class =  $request->input('admission_class');
		$admission_department =  $request->input('admission_department');
		$admission_type =  $request->input('admission_type');
		/*******/
		$image = $request->file('student_photo');
		$certificate_image=$request->file('birth_certificate_image');


		if (is_null($image)) {

			$data = [
				'name' => $name, 
				'name_bangla' => $name_bangla,
				'roll_no' => $roll_no, 
				'fathers_name' => $fathers_name, 
				'fathers_name_bangla' => $fathers_name_bangla, 
				'mothers_name' => $mothers_name, 
				'mothers_name_bangla' => $mothers_name_bangla,
				'local_guardian_name' => $local_guardian_name,
				'date_of_birth' => $date_of_birth, 
				'admission_date' => $admission_date,
				'nationality' => $nationality, 
				'religion' => $religion, 
				'gender' => $gender, 
				//'present_address' => $present_address, 
			//	'permanent_address' => $permanent_address,
				'local_guardian_address' => $local_guardian_address,
				'student_guardian_relationship' => $student_guardian_relationship,
				'mothers_cell' => $mothers_cell,
				'birth_place' => $birth_place,
				'birth_certificate_number' => $birth_certificate_number,
				'contact_no' => $contact_no, 
				'fathers_cell' => $fathers_cell, 
				'local_guardian_cell' => $local_guardian_cell,
				'previous_school_name' => $previous_school_name,
				'previous_school_address' => $previous_school_address,
				'admission_class' => $admission_class,
				'admission_department' => $admission_department,
				'admission_type' => $admission_type,
				
				'status' => $status
			];

			$student->update($data);

			$id= $student->id;
			$stu=Student::find($id);
			$stu->blood_group=$blood_group;
			$stu->father_nid_num=$father_nid;
			$stu->mother_nid_num=$mother_nid;
			$stu->scholarship=$scholarship;
			$stu->gvt_unique_id=$gvt_unique_id;
			$stu->father_profession=$father_profession;
			$stu->mother_profession=$mother_profession;
			$stu->previous_school_class=$previous_school_class;
			$stu->previous_school_testimonial_number=$previous_school_testimonial_number;
			$stu->previous_school_testimonial_date=$previous_school_testimonial_date;
			$stu->tc_number=$tc_number;
			$stu->tc_date=$tc_date;
			$stu->save();


			//present Address data store
			$PresentAddress = PresentAddress::where('student_id','=',$student->id)->first();
			$PresentAddress->student_id = $student->id;
			$PresentAddress->village = $request->village;
			$PresentAddress->post_office = $request->post_office;
			$PresentAddress->upazila = $request->upazila;
			$PresentAddress->district = $request->district;
			$PresentAddress->save();

			//permanent Address data store
			$PermanentAddress = PermanentAddress::where('student_id','=',$student->id)->first();
			$PermanentAddress->where('student_id',$student->id);
			$PermanentAddress->student_id = $student->id;
			$PermanentAddress->village = $request->village_name;
			$PermanentAddress->post_office = $request->post_office_name;
			$PermanentAddress->upazila = $request->upazila_name;
			$PermanentAddress->district = $request->district_name;
			$PermanentAddress->save();
			// try{				
			// 	$student->update($data);				
			// 	if($student->cardno)
			// 		$student->cardno()->delete();
			// 	$student->cardno()->save(new Attendancecard(['card_no' => $request->card_no]));
			// }catch(\Exception $e){				
			// 	return redirect()->back()->withInput();
			// }
			// return redirect('/students')->with('message', 'Student updated');
		}

		else{
			unlink($student->student_photo);
			$destinationPath = 'img/';
			$originalFile = $image->getClientOriginalName();
			$uniqueName = date("Y-m-d").$originalFile;
			$image->move($destinationPath, $uniqueName);
			$originalPath = $destinationPath.$uniqueName;
			$data = [
				'name' => $name, 
				'name_bangla' => $name_bangla,
				'roll_no' => $roll_no, 
				'fathers_name' => $fathers_name, 
				'fathers_name_bangla' => $fathers_name_bangla, 
				'mothers_name' => $mothers_name, 
				'mothers_name_bangla' => $mothers_name_bangla,
				'local_guardian_name' => $local_guardian_name,
				'date_of_birth' => $date_of_birth, 
				'admission_date' => $admission_date,
				'nationality' => $nationality, 
				'religion' => $religion, 
				'gender' => $gender, 
			//	'present_address' => $present_address, 
			//	'permanent_address' => $permanent_address,
				'local_guardian_address' => $local_guardian_address,
				'student_guardian_relationship' => $student_guardian_relationship,
				'mothers_cell' => $mothers_cell,
				'birth_place' => $birth_place,
				'birth_certificate_number' => $birth_certificate_number,
				'contact_no' => $contact_no, 
				'fathers_cell' => $fathers_cell, 
				'local_guardian_cell' => $local_guardian_cell,
				'previous_school_name' => $previous_school_name,
				'previous_school_address' => $previous_school_address,
				'admission_class' => $admission_class,
				'admission_department' => $admission_department,
				'admission_type' => $admission_type,
				'status' => $status,
				
				'student_photo' => $originalPath
			];			
			

			$student->update($data);
			$id= $student->id;
			$stu=Student::find($id);
			$stu->blood_group=$blood_group;
			$stu->father_nid_num=$father_nid;
			$stu->mother_nid_num=$mother_nid;
			$stu->scholarship=$scholarship;
			$stu->gvt_unique_id=$gvt_unique_id;
			$stu->father_profession=$father_profession;
			$stu->mother_profession=$mother_profession;
			$stu->previous_school_class=$previous_school_class;
			$stu->previous_school_testimonial_number=$previous_school_testimonial_number;
			$stu->previous_school_testimonial_date=$previous_school_testimonial_date;
			$stu->tc_number=$tc_number;
			$stu->tc_date=$tc_date;
			$stu->save();
				//present Address data store
			$PresentAddress = PresentAddress::where('student_id','=',$student->id)->first();
			$PresentAddress->student_id = $student->id;
			$PresentAddress->village = $request->village;
			$PresentAddress->post_office = $request->post_office;
			$PresentAddress->upazila = $request->upazila;
			$PresentAddress->district = $request->district;
			$PresentAddress->save();

				//permanent Address data store
			$PermanentAddress = PermanentAddress::where('student_id','=',$student->id)->first();
			$PermanentAddress->where('student_id',$student->id);
			$PermanentAddress->student_id = $student->id;
			$PermanentAddress->village = $request->village_name;
			$PermanentAddress->post_office = $request->post_office_name;
			$PermanentAddress->upazila = $request->upazila_name;
			$PermanentAddress->district = $request->district_name;
			$PermanentAddress->save();		
				// return redirect('/students')->with('message', 'Student updated');
		}

		$chk_std=Student::find($student->id);
		$chk_certificate_photo=$chk_std->birth_certificate_image;
				//database null 
		if(is_null($chk_certificate_photo)){
					//form has data
			if (!is_null($certificate_image)) {
				$destinationPath1 = 'img/';
				$originalFile1 = $certificate_image->getClientOriginalName();
				$uniqueName1 = date("Y-m-d").$originalFile1;
				$certificate_image->move($destinationPath1, $uniqueName1);
				$originalPath1 = $destinationPath1.$uniqueName1;
				$stu=Student::find($student->id);
				$stu->birth_certificate_image=$originalPath1;
				$stu->save();
			}
		}
				//database has data
		else{
					//form has data
			if (!is_null($certificate_image)) {
				unlink($student->birth_certificate_image);
				$destinationPath1 = 'img/';
				$originalFile1 = $certificate_image->getClientOriginalName();
				$uniqueName1 = date("Y-m-d").$originalFile1;
				$certificate_image->move($destinationPath1, $uniqueName1);
				$originalPath1 = $destinationPath1.$uniqueName1;
				$stu=Student::find($student->id);
				$stu->birth_certificate_image=$originalPath1;
				$stu->save();
			}

		}
		return Redirect::back()->with('message', 'Successfully Updated');				
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Student $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$student = Student::find($id);
		try {
			$student->delete();
		}
		catch (\Illuminate\Database\QueryException $e) {
			return redirect('/students')->with('message', 'This student cannot be deleted');
		}
		
		return redirect('/students')->with('message', 'Student deleted');
	}

	public function showResult($id)
	{
		/*Subject::all();
		Result::all();*/
		$student = Student::find($id);

		$level = Level::find($student->level_id);
		/*$result = $student->result()->get();
		dd($result);*/
		$subjects = $level->subject()->get();
		dd($subjects);


		//dd($result);
		//$className = $level->class_name;


	return view('admin.weeklytests.index', ['student' => $student, 'level' => $level, 'subjects' => $subjects, /*'result'=>$result*/]);
}

public function saveResult(Request $request)
{

}

public function GetDataForDataTable(Request $request)
{
	$student = new Student();
	return $student->GetListForDataTable(
		$request->input('length'),
		$request->input('start'),
		$request->input('search')['value'],
		$request->input('status')
	);
}

}
