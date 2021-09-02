<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    protected $table = 'sms_logs';
	protected $fillable = [
		'notification_type_id', 
		'total_send', 
		'created_at', 
		'updated_at'
    ];

    public function notification_type() {
    	return $this->belongsTo('App\NotificationType');
    }

}
