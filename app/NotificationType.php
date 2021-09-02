<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
    protected $fillable = [
		  'type_name', 'status'
    ];

    public function notification_receiver() {
    	return $this->hasMany('App\NotificationReceiver');
    }

    public function sms_log() {
    	return $this->hasMany('App\SmsLog');
    }
}
