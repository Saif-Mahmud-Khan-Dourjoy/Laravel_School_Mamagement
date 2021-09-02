<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreviousSchoolInfo extends Model
{
    protected $fillable = [
    	'teacher_id', 'institute_name', 'designation', 'appoiment_date', 'joining_date', 'mpo_date', 'exemption_date', 'comment'
    ];
}
