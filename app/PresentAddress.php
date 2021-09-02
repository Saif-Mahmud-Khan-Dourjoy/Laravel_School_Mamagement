<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PresentAddress extends Model
{
    protected $fillable = [
    	'village', 'post_office', 'upazila', 'district'
    ];
}
