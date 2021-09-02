<?php

namespace App\Http\Controllers;
use App\Role;
use App\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
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
        $roles = Role::all();
        return view('admin.roles.index', ['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $result = Permission::orderBy('modual','ASC')->get();
        $permissions = [];

        foreach ($result as $key => $item) {
            $permissions[$item->modual][$key] = $item;
        }
        
        array_multisort($permissions,SORT_DESC);

       // look([$permissions,$result]);
        return view('admin.roles.create',compact('permissions'));
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

        $this->validate($request, ['name' => 'required|unique:roles',
                                     'description'=>'required' ]);
        $data = $request->only('name','description');
        $role = new Role;
        $role = Role::create($data);
        $role->Permissions()->sync($request->permission);
       return redirect('/roles')->with('message', 'Role added');

        /*$this->validate($request, ['name' => 'required|unique:roles',
                                     'description'=>'required' ]);
        $data = $request->only('name','description');
        
        $role = role::create($data);
        //Session:flash('message', 'role added');
        return redirect('/roles')->with('message', 'role added');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
        /*$permission = $role->permission()->get();*/
        return view('admin.roles.show', ['role' => $role]);
      
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
        $role = role::findOrFail($id);
        $role_permission = $role->permissions->pluck('id')->all();
        $result = Permission::all();
        $permissions = [];
        
        foreach ($result as $key => $item) {
            $permissions[$item->modual][$key] = $item;
        }
        array_multisort($permissions,SORT_DESC);
        return view('admin.roles.edit',compact('role','permissions','role_permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        /*//
        $data = $request->only('name','description');
        $role -> update($data);
        //Session:flash('message', 'role added');
        return redirect('/roles');*/
        $data = $request->only('name','description');
        
        $role->update($data);
        $role->Permissions()->sync($request->permission);
       return redirect('/roles')->with('message', 'Role added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
     {
         role::where('id',$id)->delete();
        return redirect()->back();
        
        
    }
    public function GetDataForDataTable(Request $request) {
        $role = new role();
        return $role->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
