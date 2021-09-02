<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobileBankAccount extends Model
{
    protected $fillable = [
    	'teacher_id', 'mobile_account_holder_name', 'mobile_bank_name', 'mobile_account_number', 'mobile_account_type', 'mobile_routing_number', 'mobile_comment'
    ];
}
