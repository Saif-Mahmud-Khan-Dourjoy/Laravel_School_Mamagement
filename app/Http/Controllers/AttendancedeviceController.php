<?php

namespace App\Http\Controllers;

use App\Attendancedevice;
use App\AttendanceLog;
use App\Attendance;
use App\Attendancecard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendancedeviceController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */	
	public function __construct()
	{
		$this->middleware('auth');
		
		
		$this->middleware(function ($request, $next) {
			

			if(env('ROLE_ENABLE',0) == 1){                
				if (!$request->user()->hasPermission($request->route()->action['as'])){
					return redirect('warning');
				}
			}
			return $next($request);
		});
	}

	public function index()
	{
		return view('admin.att_device.index')->with('attendancedevices',Attendancedevice::all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.att_device.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$request->validate([
			'DeviceName' => 'bail|required|string',
			'MachineNo' => 'bail|required|integer',
			'CommType' => 'bail|required|string',
			'IPAddress' => 'bail|required|string',
			'Port' => 'bail|required|integer',
			'DeviceType' => 'bail|required|string',
		]);
		Attendancedevice::create($request->all());
		return redirect('/attendancedevices')->with('message', 'Device added');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Attendancedevice  $attendancedevice
	 * @return \Illuminate\Http\Response
	 */
	public function show(Attendancedevice $attendancedevice)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Attendancedevice  $attendancedevice
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Attendancedevice $attendancedevice)
	{
		return view('admin.att_device.edit')->with('att_device',$attendancedevice);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Attendancedevice  $attendancedevice
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Attendancedevice $attendancedevice)
	{
		$request->validate([
			'DeviceName' => 'bail|required|string',
			'MachineNo' => 'bail|required|integer',
			'CommType' => 'bail|required|string',
			'IPAddress' => 'bail|required|string',
			'Port' => 'bail|required|integer',
			'DeviceType' => 'bail|required|string',
		]);
		$attendancedevice->update($request->all());
		return redirect('/attendancedevices')->with('message', 'Device Updated');		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Attendancedevice  $attendancedevice
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Attendancedevice $attendancedevice)
	{
		$attendancedevice->delete();
		return redirect('/attendancedevices')->with('message', 'Device Deleted');
	}

	public function GetListForDataTable(Request $request) {
		$attendancedevice = new Attendancedevice();
		return $attendancedevice->GetListForDataTable(
			$request->input('length'),
			$request->input('start'),
			$request->input('search')['value'],
			$request->input('status')
		);
	}

	public function deviceList(){
		return Attendancedevice::all();		
	}

	public function importData(Request $request){
		try{
			if($request->deviceData){			
				$reqData = json_decode($request->deviceData);
				// Log::stack(['single'])->info($request->deviceData);
				$import = 0;
				foreach ($reqData as $key => $value) {
					try{
						if(Attendancecard::where('card_no',$value->CardNo)->first()){
							if(!AttendanceLog::where([
								['card_no', '=', $value->CardNo],
								['date', '=', $this->formatDate($value->Date).' '.$this->formatTime($value->Time)],
								['machineNo', '=', $value->MachineNo],
							])->first()){
								AttendanceLog::create([
									'card_no' => $value->CardNo,
									'date' => $this->formatDate($value->Date).' '.$this->formatTime($value->Time),
									'machineNo' => $value->MachineNo,
								]);
								$import++;
							}							
						}						
					}catch(\Exception $e){
						Log::stack(['single'])->debug($e->getMessage());
						//exit;
					}
				}
				return $import;
			}
		}catch(\Exception $e){
			Log::stack(['single'])->debug($e->getMessage());
			exit;
		}
	}

	public function processData(Request $request){
		if($request->date){
			try{
				$attDate = new Carbon($this->formatDate($request->date));
				$data = AttendanceLog::selectRaw("MAX(date) AS max_date, MIN(date) AS min_date, card_no")->whereBetween('date',[$attDate->format('Y-m-d 00:00:00'),$attDate->format('Y-m-d 23:59:59')])->groupBy("card_no")->get();
				foreach ($data as $key => $value) {
					try{
						$attLogCard = Attendancecard::where('card_no',$value->card_no)->firstOrFail();
						
						$attData = Attendance::where([
												['date', '=', $attDate->format('Y-m-d')],
												['attendanceable_type', '=', $attLogCard->cardable_type],
												['attendanceable_id', '=', $attLogCard->cardable_id],
											])->first();
						if($attData){
							$attData->in_time = $value->min_date;
							$attData->out_time = $value->max_date;
							$attData->update();
						}else{
							$attendance = new Attendance([
								'date'	=>	$attDate->format('Y-m-d'),
								'in_time'	=>	$value->min_date,
								'out_time'	=>	$value->max_date,
							]);
							$attLogCard->cardable->attendance()->save($attendance);
						}						
					}catch(\Exception $e){
						Log::stack(['single'])->debug($e->getMessage());
						Log::stack(['single'])->info(json_encode($data));
						exit;
					}
				}
			}catch(\Exception $e){
				Log::stack(['single'])->debug($e->getMessage());				
				exit;
			}			
		}
	}

	protected function formatDate($date){
		return substr($date, 0, 4).'-'.substr($date, 4, 2).'-'.substr($date, 6, 2);
	}

	protected function formatTime($time){
		return substr($time, 0, 2).':'.substr($time, 2, 2).':'.substr($time, 4, 2);
	}
}
