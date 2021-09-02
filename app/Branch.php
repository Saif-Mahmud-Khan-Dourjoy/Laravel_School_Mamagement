<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Branch extends Model
{
    //
    protected $fillable = [
        'name', 'address', 'contact_no', 'email', 'area_id'
    ];

    public function area() {
        return $this->belongsTo('App\Area');
    }

    public function shift() {
        return $this->hasMany('App\Shift');
    }

    public function level_enroll() {
        return $this->hasMany('App\LevelEnroll');
    }

    public function fiscal_year() {
        return $this->hasMany('App\FiscalYear');
    }

    public function fiscal_year_current() {        
        return $this->fiscal_year()->where([["fiscal_years.starts_from", '<=',date('Y-m-d')],["fiscal_years.ends_on", '>=',date('Y-m-d')]]);
    }

    public function fees_book() {
        return $this->hasMany('App\FeesBook');
    }

    public function countRow() {
        $totalData = $this::query();
        return $totalData->select('*')->count();
    }

    public function GetListForDataTable($limit = 20, $offset = 0, $search = "", $status = 0){
        $totalData = $this::query();
        $filterData = $this::query();

        if ($status == 1){
            $totalData->where('where', 1);
            $filterData->where('where', 1);
        }

        if ($limit == -1)
            $limit = 999999;

        return array(
            'data'   =>   $totalData->where('name', 'like', '%'.$search.'%')
                ->orwhere('email', 'like', '%'.$search.'%')
                ->orwhere('contact_no', 'like', '%'.$search.'%')
                ->offset($offset)
                ->limit($limit)
                ->latest()
                ->get(),
            'draw' => 0,
            'recordsTotal' => $this->countRow(),
            'recordsFiltered' => $filterData->where('name', 'like', '%'.$search.'%')
                ->count(),
        );

    }


}
