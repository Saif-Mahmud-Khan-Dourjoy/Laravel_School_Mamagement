<?php

namespace App\Http\Controllers;

use App\OccasionalNotification;
use App\FiscalYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OccasionalNotificationController extends Controller
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

    public function index(Request $request)
    {
        if($request->wantsJson()){
            $occ_notification = new OccasionalNotification();
            $responseFormate = $occ_notification->getListForDataTable(
                                        $request->input('length'),
                                        $request->input('start'),
                                        $request->input('search')['value']
                                    );
            $responseFormate['draw'] = (int) 0;
            return response()->json($responseFormate);
        }
        return view('admin.occasional_notifications.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fiscal_years = FiscalYear::all();
        return view('admin.occasional_notifications.create', compact('fiscal_years')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
         $validator = Validator::make($request->all(), [
            'name' => 'required',
            'date' => 'required',
            'text' => 'required',
            'send_to' => 'required',
        ]);
        
        if($validator->fails()){            
           return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else{

            $data = $request->only('name', 'date', 'text', 'send_to','status');

            if(!isset($request->status)){
                $status = 0;
            }elseif(isset($request->status)){
                $status = 1;
            }

             $data = [
                'name' => ucwords($request->name),
                'date' => $request->date,
                'text' => $request->text,
                'send_to' => $request->send_to,
                'status' => $status
            ];
            
            OccasionalNotification::create($data);
            return redirect('/occasional-notifications')->with('message', 'Successfully Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OccasionalNotification  $occasionalNotification
     * @return \Illuminate\Http\Response
     */
    public function show(OccasionalNotification $occasionalNotification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OccasionalNotification  $occasionalNotification
     * @return \Illuminate\Http\Response
     */
    public function edit(OccasionalNotification $occasionalNotification)
    {
        $fiscal_years = FiscalYear::all();
        return view('admin.occasional_notifications.edit', compact('fiscal_years', 'occasionalNotification')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OccasionalNotification  $occasionalNotification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OccasionalNotification $occasionalNotification)
    {
         $validator = Validator::make($request->all(), [
            'name' => 'required',
            'date' => 'required',
            'text' => 'required',
            'send_to' => 'required',
        ]);
        
        if($validator->fails()){            
           return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else{

            $data = $request->only('name', 'date', 'text', 'send_to','status');

            if(!isset($request->status)){
                $status = 0;
            }elseif(isset($request->status)){
                $status = 1;
            }

             $data = [
                'name' => ucwords($request->name),
                'date' => $request->date,
                'text' => $request->text,
                'send_to' => $request->send_to,
                'status' => $status
            ];
            
            $occasionalNotification->update($data);
            return redirect('/occasional-notifications')->with('message', 'Successfully Updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OccasionalNotification  $occasionalNotification
     * @return \Illuminate\Http\Response
     */
    public function destroy(OccasionalNotification $occasionalNotification)
    {
        $occasionalNotification->delete();
        return redirect('/occasional-notifications')->with('warning', 'Successfully Deleted.');
    }
}
