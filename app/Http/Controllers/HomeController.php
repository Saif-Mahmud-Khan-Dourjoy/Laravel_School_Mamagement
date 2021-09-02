<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use NumberToWords\NumberToWords;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_month = Carbon::now()->format('F');
        $current_date = Carbon::now()->format('Y-m-d');
        $current_month_first_date = Carbon::now()->startOfMonth()->toDateString();
        $current_month_last_date = Carbon::now()->lastOfMonth()->toDateString();
        $current_year_first_date = Carbon::now()->startOfYear()->toDateString();
        $today = Carbon::now()->toDayDateTimeString();
        return view('home', compact('current_month','current_date','current_month_first_date','current_month_last_date','today','current_year_first_date'));
    }
    public function warning()
    {

        return view('warning');
    }
}
