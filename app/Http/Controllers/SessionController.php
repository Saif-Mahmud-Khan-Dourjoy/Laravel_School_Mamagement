<?php

namespace App\Http\Controllers;

use App\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
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
        $sessions = Session::all();
        return view('admin.sessions.index', ['sessions'=>$sessions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:sessions', 
            'starts_from' => 'required', 
            'ends_to' => 'required',
            'fiscal_year_id'=> 'required|numeric'
            ]);
            // echo $request->fiscal_year_id;
            $data = $request->only('name', 'starts_from', 'ends_to', 'fiscal_year_id');
            $session = Session::create($data);
            //Session:flash('message', 'Area added');
        return redirect('/sessions')->with('message', 'Session added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        //$session = Session::all();
        return view('admin.sessions.show', ['session' => $session]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $session = Session::find($id);
        return view ('admin.sessions.edit', ['session' => $session]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        $data = $request->only('name', 'starts_from', 'ends_to','fiscal_year_id');
        $session->update($data);
        return redirect('/sessions')->with('message', 'Session updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $session = Session::find($id);
        try {
            $session->delete();
        }
        catch (\Illuminate\Database\QueryException $e) {
            return redirect('/sessions')->with('message', 'This session cannot be Deleted');
        }
        
        return redirect('/sessions')->with('message', 'Session Deleted');
    }

    public function GetDataForDataTable(Request $request) {
        $session = new Session();
        return $session->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
