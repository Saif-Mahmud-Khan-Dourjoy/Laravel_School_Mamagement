<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NtrcaInfo extends Model
{
    protected $fillable = [
    	'teacher_id', 'registation_no', 'roll_no', 'subject', 'passing_year', 'appoiment_date', 'joining_date', 'comment'
    ];
}
