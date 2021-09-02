<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingInfo extends Model
{
    protected $fillable = [
    	'teacher_id', 'institute_name', 'subject', 'training_place', 'starting_date', 'ending_date', 'expiration', 'comment'
    ];
}
