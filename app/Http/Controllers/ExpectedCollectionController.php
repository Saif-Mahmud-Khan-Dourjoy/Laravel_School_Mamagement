<?php

namespace App\Http\Controllers;

use App\ExpectedCollection;
use App\FiscalYear;
use App\Branch;
use App\BusinessMonth;
use Illuminate\Http\Request;
use App\Validator;
use Illuminate\Validation\Rule;

class ExpectedCollectionController extends Controller
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
            $expectedCollection = new ExpectedCollection();
            $responseFormate = $expectedCollection->getListForDataTable(
                                        $request->input('length'),
                                        $request->input('start'),
                                        $request->input('search')['value']
                                    );
            $responseFormate['draw'] = (int) 0;
            return response()->json($responseFormate);
        }
        return view('admin.expected_collections.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::all();
        $fiscal_years = FiscalYear::all();
        $business_months = BusinessMonth::all();
        return view('admin.expected_collections.create', compact('branches','fiscal_years', 'business_months'));
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
            'fiscal_year_id'   => [
                            'required',
                            Rule::unique('expected_collections')->where(function($query) use ($request){
                                $query->where('fiscal_year_id',$request->fiscal_year_id)
                                        ->where('business_month_id',$request->business_month_id);
                            }),
                        ],
            'business_month_id'  => [
                            'required'
                        ],
             'amount'  => [
                            'required'
                        ],
        ]);
        $data = $request->only('fiscal_year_id', 'business_month_id', 'amount');

        $expected_collection = ExpectedCollection::create($data);
        return redirect('/expectedCollections')->with('message', 'Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExpectedCollection  $expectedCollection
     * @return \Illuminate\Http\Response
     */
    public function show(ExpectedCollection $expectedCollection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExpectedCollection  $expectedCollection
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpectedCollection $expectedCollection)
    {
        $branches = Branch::all();
        $fiscal_years = FiscalYear::all();
        $business_months = BusinessMonth::all();
        return view('admin.expected_collections.edit', compact('expectedCollection','branches','fiscal_years', 'business_months'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExpectedCollection  $expectedCollection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpectedCollection $expectedCollection)
    {
       //dd($expectedCollection->id);
        $request->validate([
            'fiscal_year_id'   => [
                            'required',
                            Rule::unique('expected_collections')->where(function($query) use ($request, $expectedCollection){
                                $query->where('fiscal_year_id',$request->fiscal_year_id)
                                        ->where('business_month_id',$request->business_month_id)
                                        ->where('id','!=',$expectedCollection->id);
                            }),
                        ],
            'business_month_id'  => [
                            'required'
                        ],
             'amount'  => [
                            'required'
                        ],
        ]);
        $data = $request->only('fiscal_year_id', 'business_month_id', 'amount');

        $expectedCollection->update($data);
        return redirect('/expectedCollections')->with('message', 'Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExpectedCollection  $expectedCollection
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpectedCollection $expectedCollection)
    {
        $expectedCollection->delete();
        return redirect('/expectedCollections')->with('warning', 'Successfully Deleted.');
    }

    public function GetDataForDataTable(Request $request) {
        $expectedCollection = new ExpectedCollection();
        return $expectedCollection->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
