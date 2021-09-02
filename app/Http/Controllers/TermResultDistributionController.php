<?php

namespace App\Http\Controllers;

use App\TermResultDistribution;
use Illuminate\Http\Request;

class TermResultDistributionController extends Controller
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
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TermResultDistribution  $termResultDistribution
     * @return \Illuminate\Http\Response
     */
    public function show(TermResultDistribution $termResultDistribution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TermResultDistribution  $termResultDistribution
     * @return \Illuminate\Http\Response
     */
    public function edit(TermResultDistribution $termResultDistribution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TermResultDistribution  $termResultDistribution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TermResultDistribution $termResultDistribution)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TermResultDistribution  $termResultDistribution
     * @return \Illuminate\Http\Response
     */
    public function destroy(TermResultDistribution $termResultDistribution)
    {
        //
    }
}
