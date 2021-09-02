<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducationalQualification extends Model
{
    protected $fillable = [
    	'teacher_id', 'degree_name', 'passing_year', 'result', 'institute_name', 'subject', 'education_board', 'comment'
    ];
}
