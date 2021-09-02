<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingDay extends Model
{
    protected $fillable = ['session_id', 'section_id', 'date'];
}
