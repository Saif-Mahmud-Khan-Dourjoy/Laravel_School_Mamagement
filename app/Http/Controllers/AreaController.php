<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;



class AreaController extends Controller
{
    //this comment is to check gitignore
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
        //
        $areas = Area::all();
        return view('admin.areas.index', ['areas'=>$areas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.areas.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:areas']);
        $data = $request->only('name');
        $area = Area::create($data);
        //Session:flash('message', 'Area added');
        return redirect('/areas')->with('message', 'Area added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        $branches = $area->branch()->get();
        return view('admin.areas.show', ['area' => $area, 'branches' => $branches]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
        $area = Area::find($id);
        return view ('admin.areas.edit', ['area' => $area]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        $data = $request->only('name');
        $area -> update($data);
        //Session:flash('message', 'Area added');
        return redirect('/areas')->with('message', 'Area updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $area = Area::find($id);
        try{
            $area->delete();
        }
        catch (\Illuminate\Database\QueryException $e){
            $request->session()->flash('danger', 'Unable to delete section');
            return redirect('/areas')->with('message', 'This area cannot be deleted');
        }
        return redirect('/areas')->with('message', 'Area deleted');
        
        
    }
    public function GetDataForDataTable(Request $request) {
        $area = new Area();
        return $area->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
