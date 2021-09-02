<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
    	'date',
    	'in_time',
    	'out_time',
    ];
    public function attendanceable()
    {
        return $this->morphTo();
    }
}
