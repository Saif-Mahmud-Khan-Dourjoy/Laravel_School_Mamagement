<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = [
    	'teacher_id', 'account_holder_name', 'bank_name', 'branch_name', 'account_number', 'account_type', 'routing_number', 'comment'

    ];
}
