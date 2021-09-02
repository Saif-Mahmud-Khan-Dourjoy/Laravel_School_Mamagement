<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
     protected $fillable = [
    	'session_id', 'level_id', 'section_id', 'student_id'
    ];
}
