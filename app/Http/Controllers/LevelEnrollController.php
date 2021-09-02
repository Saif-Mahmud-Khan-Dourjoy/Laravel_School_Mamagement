<?php

namespace App\Http\Controllers;

use App\Level;
use App\Session;
use App\Shift;
use App\Branch;
use App\LevelEnroll;
use Illuminate\Http\Request;


class LevelEnrollController extends Controller
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
        $level_enrolls = LevelEnroll::all();

        return view ('admin.level_enrolls.index', ['level_enrolls' => $level_enrolls]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = Level::pluck('class_name', 'id');
        $sessions = Session::pluck('name', 'id');
        $shifts = Shift::pluck('shift_name', 'id');
        $branches = Branch::pluck('name', 'id');
        return view('admin.level_enrolls.create', [
            'levels' => $levels, 'sessions' => $sessions, 'shifts' => $shifts, 'branches' => $branches
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function destroy($id, Request $request)
    {
        $level_enroll = LevelEnroll::find($id);
        
        //return redirect('/levelEnrolls')->with('message', 'class deleted');
        try{
            $level_enroll->delete();
        }
        catch (\Illuminate\Database\QueryException $e){
            $request->session()->flash('danger', 'Unable to delete class');
            return redirect('/levelEnrolls')->with('message', 'Class cannot be deleted');
        }
        return redirect('/levelEnrolls')->with('message', 'Class deleted');
    }

    public function GetDataForDataTable(Request $request) {
        $level_enroll = new LevelEnroll();
        return $level_enroll->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
