<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Teacher extends Model
{
	protected $fillable = [
		'teacher_name', 
		'teacher_name_bangla',
		'teacher_global_id',
	    'fathers_name', 
	    'mothers_name', 
	    'marital_status', 
	    'spouse_name', 
	    'date_of_birth', 
	    'nationality',
		'religion', 
		'present_address', 
		'permanent_address', 
		'contact_no', 
		'salary', 
		'designation',
		'teacher_photo', 
		'status', 
		'user_id',
		'deleted_at'
	];

	public function section_subject_teacher() {
		return $this->hasMany('App\SectionSubjectTeacher');
	}
	public function education() {
		return $this->hasMany('App\EducationalQualification');//make change
	}
	public function ntrca_info() {
		return $this->hasMany('App\NtrcaInfo');//make change
	}
	public function previous_school() {
		return $this->hasMany('App\PreviousSchoolInfo');//make change
	}
	public function training() {
		return $this->hasMany('App\TrainingInfo');//make change
	}
	public function scale_changing() {
		return $this->hasMany('App\ScaleChangingInfo');//make change
	}
	public function bank_account() {
		return $this->hasOne('App\BankAccount');
	}
	public function mobile_bank_account() {
		return $this->hasOne('App\MobileBankAccount');
	}
	public function user() {
		return $this->belongsTo('App\User');
	}

	public function weekly_test_result() {
		return $this->hasMany('App\Weekly_Test_Result');
	}

	public function fees_book() {
		return $this->hasMany('App\FeesBook');
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

		return [
			'data'   =>   $totalData->where('teacher_name', 'like', '%'.$search.'%')
				->offset($offset)
				->limit($limit)
				->latest()
				->get(),
			'draw' => 0,
			'recordsTotal' => $this->countRow(),
			'recordsFiltered' => $filterData->where('teacher_name', 'like', '%'.$search.'%')
				->count(),
		];

	}


}
