<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
  //
    protected $fillable = [
        'name','description','modual' ];

    public function role() {
        return $this->hasMany('App\Role');
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

        return [
            'data'   =>   $totalData->where('name', 'like', '%'.$search.'%')
                  ->orwhere('description', 'like', '%'.$search.'%')
                ->offset($offset)
                ->limit($limit)
                ->latest()
                ->get(),
            'recordsTotal' => $this->countRow(),
            'recordsFiltered' => $filterData->where('name', 'like', '%'.$search.'%')
                ->count(),
            'draw' => 0
        ];

    }
}
