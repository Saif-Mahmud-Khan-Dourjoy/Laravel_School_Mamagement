<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OccasionalNotification extends Model
{
    protected $table = 'occasional_notifications';
	protected $fillable = [
		'name', 
		'date', 
		'text', 
		'send_to', 
		'status'
    ];

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
                                            ->get(),

                    'recordsTotal'      =>  $this->count(),

                    'recordsFiltered'   =>  $filterData           
                                            ->where('name', 'like', '%'.$search.'%')
                                            ->count(),
                ];      
    } 
}
