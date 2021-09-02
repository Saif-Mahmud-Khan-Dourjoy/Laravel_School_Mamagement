<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionSubjectTeacher extends Model
{
    protected $fillable = ['subject_id', 'teacher_id', 'section_id'];

    public function subject() {
    	return $this->belongsTo('App\Subject');
    }

    public function teacher() {
    	return $this->belongsTo('App\Teacher');
    }

    public function section() {
    	return $this->belongsTo('App\Section');
    }

    public function term_result() {
        return $this->hasMany('App\TermResult');
    }

    public function student_subject_result() {
        return $this->hasOne('App\StudentSubjectResult');
    }
    
    public function student_subject_term_mark() {
        return $this->hasOne('App\SectionSubjectTermMark');
    }
    public function section_subject_distribution() {
        return $this->hasOne('App\SectionSubjectDistribution');
    }

    public function weekly_test() {
        return $this->hasMany('App\Weekly_Test');
    }

    public function final_report() {
        return $this->hasMany('App\FinalReport');
    }

    public function countRow() {
        $totalData = $this::query();
        return $totalData->select('*')->count();
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
            'data'   =>   $totalData->with('subject')->with('section.level_enroll.level')
                ->with('teacher')
                ->offset($offset)
                ->limit($limit)
                ->latest()
                ->get(),
            'draw' => 0,
            'recordsTotal' => $this->countRow(),
            'recordsFiltered' => $filterData->count(),
        );

    }
}
