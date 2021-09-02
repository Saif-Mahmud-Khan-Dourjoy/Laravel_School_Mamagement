<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GeneralSetting;

class GeneralSettingsController extends Controller
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
        $settings = GeneralSetting::first();
        return view('admin.general_settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $old_settings = GeneralSetting::first();
        $validatedData = $request->validate([
            'email_1' => 'email|required',
            'email_2' => 'email|required',
            'site_name' => 'required',
            'address_1' => 'required',
            'address_2' => 'required',
            'website' => 'required',
            'phone_2' => 'required',
            'phone_2' => 'required',
            'site_logo' => 'mimes:jpeg,bmp,png,jpg'
        ]);
        $settings_data = $request->all();

        if($old_settings == null){
            if($request->hasFile('site_logo')){
                $file =  $request->file('site_logo');
                $filename = time().'.'.$file->getClientOriginalName();
                $settings_data['site_logo'] =  $filename;
                $site_logo_dir = $file->move('site_logo', $filename);
            }
            GeneralSetting::create($settings_data);

        }elseif($old_settings != null){
            if($request->hasFile('site_logo')){
            $file =  $request->file('site_logo');
            $filename = time().'.'.$file->getClientOriginalName();
            $settings_data['site_logo'] =  $filename;
            $oldPath = public_path() . '/site_logo/' . $old_settings->site_logo;
                    if(file_exists($oldPath) && !is_dir($oldPath)){
                            unlink($oldPath);
                    }
                $site_logo_dir = $file->move('site_logo', $filename);
            }
            $old_settings->update($settings_data);
        }
        return redirect('/generalSettings')->with('message', 'Updated General Settings');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
