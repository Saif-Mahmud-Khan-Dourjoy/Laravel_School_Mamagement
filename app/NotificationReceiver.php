<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationReceiver extends Model
{
	protected $table = 'notification_receivers';
	protected $fillable = [
		'notification_type_id', 
		'name', 
		'email', 
		'phone', 
		'status'
    ];

    public function notification_type() {
    	return $this->belongsTo('App\NotificationType');
    }

    public function countRow() {
        $totalData = $this::query();
        return $totalData->select('*')->count();
    }

    public function getListForDataTable($limit = 50, $offset = 0, $search = ''){
        $totalData = $this::query();
        $filterData = $this::query();        
        
        return [
                    'data'              =>  $totalData
                                            ->limit($limit)
                                            ->offset($offset)
                                            ->where('name', 'like', '%'.$search.'%')
                                            ->with('notification_type')
                                            ->get(),

                    'recordsTotal'      =>  $this->count(),

                    'recordsFiltered'   =>  $filterData           
                                            ->where('name', 'like', '%'.$search.'%')
                                            ->count(),
                ];      
    } 
}
