<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendancecard extends Model
{
    protected $fillable = [
    	'card_no'
    ];
    public function cardable()
    {
        return $this->morphTo();
    }
}
