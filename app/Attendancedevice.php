<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendancedevice extends Model
{
	protected $fillable = [
		'DeviceName',
		'MachineNo',
		'CommType',
		'IPAddress',
		'Port',
		'DeviceType'
	];

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
            'data'   =>   $totalData->where('DeviceName', 'like', '%'.$search.'%')
                ->offset($offset)
                ->limit($limit)
                ->latest()
                ->get(),
            'draw' => 0,
            'recordsTotal' => $this->countRow(),
            'recordsFiltered' => $filterData->where('DeviceName', 'like', '%'.$search.'%')
                ->count(),
        );

    }
}
