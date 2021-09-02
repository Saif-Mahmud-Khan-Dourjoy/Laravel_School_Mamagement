<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable = [
        'term_name' 
    ];

    public function student_subject_result() {
    	return $this->hasMany('App\StudentSubjectResult');
    }

    public function term_result() {
    	return $this->hasMany('App\TermResult');
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

        return [
            'data'   =>   $totalData->where('term_name', 'like', '%'.$search.'%')
                ->offset($offset)
                ->limit($limit)
                ->latest()
                ->get(),
            'recordsTotal' => $this->countRow(),
            'recordsFiltered' => $filterData->where('term_name', 'like', '%'.$search.'%')
                ->count(),
            'draw' => 0
        ];

    }
}
