<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendanceLog extends Model
{
    protected $fillable = [
		'card_no',
		'date',
		'machineNo'
	];
}
