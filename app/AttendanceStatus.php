<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendanceStatus extends Model
{
    protected $fillable = [
    	'session_id', 'section_id', 'section_student_id', 'date', 'status'

    ];
    public function section_student() {
    	return $this->belongsTo('App\SectionStudent');
    }
}
