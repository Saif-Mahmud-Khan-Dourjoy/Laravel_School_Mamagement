<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScaleChangingInfo extends Model
{
    protected $fillable = [
    	'teacher_id', 'salary_grade', 'present_salary_scale', 'first_mpo_joining_date', 'first_high_scale_date', 'second_high_scale_date', 'first_time_scale_date', 'second_time_scale_date', 'bed_scale_date', 'comment'
    ];
}
