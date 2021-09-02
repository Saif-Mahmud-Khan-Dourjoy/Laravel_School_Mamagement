<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicExam extends Model
{
    protected $fillable = [
        'exam_name',
        'year',
        'roll_no',
        'reg_no',
        'board',
        'department',
        'reasult'
    ];
}
