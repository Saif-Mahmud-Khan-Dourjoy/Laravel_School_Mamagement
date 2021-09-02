<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpectedCollection extends Model
{
    protected $fillable = [
    	'fiscal_year_id', 
    	'business_month_id', 
    	'amount'
    ];

    public function fiscal_year() {
    	return $this->belongsTo('App\FiscalYear');
    }

    public function business_month() {
    	return $this->belongsTo('App\BusinessMonth');
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
                                            ->where('amount', 'like', '%'.$search.'%')
                                            ->with('fiscal_year','business_month')
                                            ->get(),

                    'recordsTotal'      =>  $this->count(),

                    'recordsFiltered'   =>  $filterData           
                                            ->where('amount', 'like', '%'.$search.'%')
                                            ->count(),
                ];      
    } 
}
