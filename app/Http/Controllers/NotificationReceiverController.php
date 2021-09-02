<?php

namespace App\Http\Controllers;

use App\NotificationReceiver;
use App\NotificationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationReceiverController extends Controller
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
            $notificationReceiver = new NotificationReceiver();
            $responseFormate = $notificationReceiver->getListForDataTable(
                                        $request->input('length'),
                                        $request->input('start'),
                                        $request->input('search')['value']
                                    );
            $responseFormate['draw'] = (int) 0;
            return response()->json($responseFormate);
        }
        return view('admin.notification_receivers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $n_types = NotificationType::all();
        return view('admin.notification_receivers.create', compact('n_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'notification_type_id' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:notification_receivers',
            'phone' => ['required', 'regex:/(01)[0-9]{9}/', 'min:11', 'max:11'],
        ]);
  
        $validator->after(function ($validator) use ($request) {
            if (NotificationReceiver::where('phone', '88'.$request->phone)->count() > 0) {
                $validator->errors()->add('phone', __('validation.unique', ['attribute' => 'phone']));
            }
        });
        
        if($validator->fails()){            
           return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else{

            $data = $request->only('notification_type_id', 'name', 'email', 'phone', 'status');

            $phone_no = '88'.$request->phone;
            if(!isset($request->status)){
                $status = 0;
            }elseif(isset($request->status)){
                $status = 1;
            }
            $data = [
                'notification_type_id' => $request->notification_type_id,
                'name' => ucwords($request->name),
                'email' => $request->email,
                'phone' => $phone_no,
                'status' => $status
            ];
            
            NotificationReceiver::create($data);
            return redirect('/notification-receivers')->with('message', 'Successfully Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NotificationReceiver  $notificationReceiver
     * @return \Illuminate\Http\Response
     */
    public function show(NotificationReceiver $notificationReceiver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NotificationReceiver  $notificationReceiver
     * @return \Illuminate\Http\Response
     */
    public function edit(NotificationReceiver $notificationReceiver)
    {
        $n_types = NotificationType::all();
        return view('admin.notification_receivers.edit', compact('n_types', 'notificationReceiver'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NotificationReceiver  $notificationReceiver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotificationReceiver $notificationReceiver)
    {   
        $validator = Validator::make($request->all(), [
            'notification_type_id' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:notification_receivers,email, '.$notificationReceiver->id,
            'phone' => ['required', 'regex:/(01)[0-9]{9}/', 'min:11', 'max:11'],
        ]);
  
        $validator->after(function ($validator) use ($request, $notificationReceiver) {
            if (NotificationReceiver::where('phone', '88'.$request->phone)->where('id', '!=', $notificationReceiver->id)->count() > 0) {
                $validator->errors()->add('phone', __('validation.unique', ['attribute' => 'phone']));
            }
        });
        
        if($validator->fails()){            
           return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else{

            $data = $request->only('notification_type_id', 'name', 'email', 'phone', 'status');

            $phone_no = '88'.$request->phone;
            if(!isset($request->status)){
                $status = 0;
            }elseif(isset($request->status)){
                $status = 1;
            }
            $data = [
                'notification_type_id' => $request->notification_type_id,
                'name' => ucwords($request->name),
                'email' => $request->email,
                'phone' => $phone_no,
                'status' => $status
            ];

            $notificationReceiver->update($data);
            return redirect('/notification-receivers')->with('message', 'Successfully Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NotificationReceiver  $notificationReceiver
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotificationReceiver $notificationReceiver)
    {
        $notificationReceiver->delete();
        return redirect('/notification-receivers')->with('warning', 'Successfully Deleted.');
    }
}
