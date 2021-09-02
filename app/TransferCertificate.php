<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransferCertificate extends Model
{
    protected $fillable = [
    	'session_id', 'level_id', 'section_id', 'student_id','transfer_place', 'reason'
    ];
}
