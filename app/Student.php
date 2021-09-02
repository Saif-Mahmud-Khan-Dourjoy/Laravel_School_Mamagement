<?php

namespace App;
use App\model\modelCommonTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
	protected $fillable = [
		'name',
		'name_bangla',
		'roll_no', 
		'fathers_name', 
		'fathers_name_bangla',
		'mothers_name', 
		'mothers_name_bangla',
		'local_guardian_name',
		'local_guardian_address',
		'student_guardian_relationship',
		'date_of_birth', 
		'birth_place', 
		'birth_certificate_number',
		'admission_date',
		'admission_type',
		'nationality', 
		'religion', 
		'gender', 
		'present_address', 
		'permanent_address', 
		'mothers_cell',
		'contact_no', 
		'fathers_cell', 
		'local_guardian_cell',
		'previous_school_name',
		'previous_school_address',
		'admission_class',
		'admission_department',
		'student_photo',
		'status',
		'added_by'
	];

	public function section_student() {
		return $this->hasOne('App\SectionStudent');
	}

	public function section_student_current() {
		return $this->hasOne('App\SectionStudent')->orderBy('id','DESC');
	}

	public function public_exam() {
		return $this->hasMany('App\PublicExam');
	}
	public function present() {
		return $this->hasOne('App\PresentAddress');
	}
	public function permanent() {
		return $this->hasOne('App\PermanentAddress');
	}

	public function weekly_test_result() {
		return $this->hasMany('App\Weekly_Test_Result');
	}

	public function final_report() {
		return $this->hasMany('App\FinalReport');
	}

	public function collected_fees() {
		return $this->hasMany('App\CollectedFees');
	}

	public function countRow() {
		$totalData = $this::query();
		return $totalData->select('*')->count();
	}

	public function cardno(){
		return $this->morphOne('App\Attendancecard', 'cardable');
	}

	public function attendance(){
		return $this->morphMany('App\Attendance', 'attendanceable');
	}

	public function GetListForDataTable($limit = 20, $offset = 0, $search = "", $status = 0){
		$totalData = $this::query();
		$filterData = $this::query();

		if ($status == 1){
			$totalData->where('where', 1);
			$filterData->where('where', 1);
		}

		if ($limit == -1)
			$limit = 999999;

		return array(
			'data'   =>   $totalData->select('students.*','sections.section_name','levels.class_name','sessions.name as sessionName','branches.name as branchName','section_students.roll')
				->leftJoin('section_students',function($join){
					$join->on('section_students.student_id','=','students.id');
					$join->on('section_students.id', '=',DB::raw('(select max(id) from section_students where student_id=students.id)'));
				})
				->leftJoin('sections','sections.id','=','section_students.section_id')
				->leftJoin('level_enrolls','level_enrolls.id','=','sections.level_enroll_id')
				->leftJoin('levels','levels.id','=','level_enrolls.level_id')
				->leftJoin('sessions','sessions.id','=','level_enrolls.session_id')
				->leftJoin('branches','branches.id','=','level_enrolls.branch_id')
				->where('students.name', 'like', '%'.$search.'%')
				->orwhere('students.roll_no', 'like', '%'.$search.'%')
				->orwhere('students.contact_no', 'like', '%'.$search.'%')
				->orwhere('students.fathers_name', 'like', '%'.$search.'%')
				->offset($offset)
				->limit($limit)
				->latest()
				->get(),
			'draw' => 0,
			'recordsTotal' => $this->countRow(),
			'recordsFiltered' => $filterData->where('name', 'like', '%'.$search.'%')
				->count(),
		);

	}


}
