<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $fillable = [
    	'site_name',
    	'site_logo',
    	'address_1',
    	'address_2',
    	'website',
    	'phone_1',
    	'phone_2',
    	'email_1',
    	'email_2',
    	'facebook',
    	'instagram',
    	'twitter',
    	'youtube',
    	'google_plus',
    	'status'
    ];
}
