<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionSubjectDistribution extends Model
{
    protected $fillable = ['section_subject_teacher_id', 'written_total', 'written_permission', 'mcq_total', 'mcq_permission', 'pactical_total', 'pactical_permission'];

    public function section_subject_teacher() {
    	return $this->belongsTo('App\SectionSubjectTeacher');
    }
}
