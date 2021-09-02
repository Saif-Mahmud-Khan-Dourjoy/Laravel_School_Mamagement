@section('heading')
Dashboard
@endsection

@extends('layouts.app')

@section('content')
<p class="text-right mr-5 text-info" style="font-size: 15px;"><b>{{$today}}</b></p>
<div class="content">
    <div class="container-fluid">
        <div class="row" style="padding-top: 10px">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-warning text-center">
                                    <i class="ti-home"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Total</p>
                                    <p>Branches</p>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <i class="ti-home"></i>
                                {{ \App\Branch::count() }}


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-success text-center">
                                    <i class="ti-user"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Total</p>
                                    <p>Teachers</p>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <i class="ti-user"></i>
                                {{\App\Teacher::where('status', 1)->count()}} <small>Number of Active Teachers</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-danger text-center">
                                    <i class="ti-ruler-pencil"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Total</p>
                                    <p>Students</p>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <i class="ti-ruler-pencil"></i>
                                {{\App\Student::count()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-info text-center">
                                    <i class="ti-reload"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Total</p>
                                    <p>Shifts</p>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <i class="ti-reload"></i>
                                {{\App\Shift::count()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach(\App\Branch::get() as $keyB => $branch)
<span>
    <p style="font-size: 20px;" class="text-center"><b>{{$branch->name}} Branch</b></p>
</span>
<div class="content">
    <div class="container-fluid">
        <div class="row" style="padding-top: 10px">
            <div class="col-lg-2 col-sm-5">
                <div class="card" style="border: 1px solid; border-color: yellowgreen;">
                    <div class="card-header">
                        <p style="font-size: 15px;" class="p-3 text-center"><strong>Present Student</strong></p>
                    </div>
                    @php
                    $level_session_id = \App\LevelEnroll::where('branch_id', $branch->id)->pluck('session_id')->toArray();
                    $present_student = \App\AttendanceStatus::whereIn('session_id', $level_session_id)->where('date', $current_date)->where('status',1)->count();
                    $absent_student = \App\AttendanceStatus::whereIn('session_id', $level_session_id)->where('date', $current_date)->where('status',0)->count();
                    @endphp
                    <div class="card-body">
                        <p style="font-size: 14px;" class="text-center"><i>{{ $present_student }}</i></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-5">
                <div class="card" style="border: 1px solid; border-color: red;">
                    <div class="card-header">
                         <p style="font-size: 15px;" class="p-3 text-center"><strong>Absent Student</strong></p>
                    </div>
                    <div class="card-body">
                       <p style="font-size: 14px;" class="text-center"><i>{{ $absent_student }}</i></p>
                    </div>
                    <div class="footer">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card" style="border: 1px solid; border-color: black;">
                    <div class="card-header">
                        <p style="font-size: 15px;" class="p-3 text-center"><strong>Expected Collection</strong></p>
                    </div>
                    @php
                      //  $collections = \App\SectionWiseFees::leftJoin('business_months', 'section_wise_fees.business_month_id', '=', 'business_months.id')
                      //               ->leftJoin('sessions', 'section_wise_fees.session_id', '=', 'sessions.id')
                      //               ->leftJoin('fees_types', 'section_wise_fees.fees_type_id', '=', 'fees_types.id')
                      //               ->leftJoin('fiscal_years', 'business_months.fiscal_year_id', '=', 'fiscal_years.id')
                      //               ->select('section_wise_fees.id as section_wise_fees_id',
                      //                   'section_wise_fees.session_id',
                      //                   'section_wise_fees.section_id',
                      //                   'section_wise_fees.fees_type_id',
                      //                   'section_wise_fees.business_month_id',
                      //                   'section_wise_fees.amount',
                      //                   'fees_types.fees_type_name',
                      //                   'sessions.name as session_name',
                      //                   'sessions.starts_from as session_starts_from',
                      //                   'business_months.fiscal_year_id', 
                      //                   'business_months.month_name',
                      //                   'business_months.starts_from as month_starts_from',
                      //                   'business_months.ends_on as month_ends_on',
                      //                   'fiscal_years.year',
                      //                   'fiscal_years.branch_id',
                      //                   'fiscal_years.starts_from as year_starts_from',
                      //                   'fiscal_years.ends_on as year_ends_on')
                      //               ->where('month_name',$current_month)
                      //               ->where('fees_types.fees_type_name','Monthly Fees')
                      //               ->where('business_months.starts_from',$current_month_first_date)
                      //               ->where('fiscal_years.starts_from',$current_year_first_date)
                      //              // ->where('fiscal_years.year','Vatara 2020 Rose')
                      //               ->where('branch_id',$branch->id)
                      //               ->with('section.section_student','section.level_enroll')
                      //               ->get();
                      //   $total_collection = 0;
                      //   $sections = 0;
                      //   $section_students = 0;                    
                      // foreach($collections as $collection){
                      //   $total_collection += $collection->amount;
                      //   $section_students += $collection->section->section_student->count();
                      // }

                        //manual calculation of expected collection from the database
                        $expected_collection = \App\ExpectedCollection::leftJoin('fiscal_years', 'expected_collections.fiscal_year_id', '=', 'fiscal_years.id')
                        ->leftJoin('business_months', 'expected_collections.business_month_id', '=', 'business_months.id')
                        ->leftJoin('branches', 'fiscal_years.branch_id', '=', 'branches.id')
                         ->select('expected_collections.fiscal_year_id',
                                'expected_collections.business_month_id',  
                                'expected_collections.amount',  
                                'business_months.month_name',  
                                'business_months.starts_from as month_starts_from',  
                                'business_months.ends_on as month_ends_on',  
                                'fiscal_years.year',
                                'fiscal_years.branch_id',
                                'fiscal_years.starts_from as year_starts_from',
                                'fiscal_years.ends_on as year_ends_on',
                                'branches.id as branch_id',
                                'branches.name as branch_name')
                        ->where('month_name',$current_month)
                        ->where('business_months.starts_from',$current_month_first_date)
                        ->where('fiscal_years.starts_from',$current_year_first_date)
                        ->where('branch_id',$branch->id)
                        ->get();
                         //dd($expected_collection->isEmpty());
                    @endphp
                    <div class="card-body">
                       {{--  <p style="font-size: 14px;" class="text-center"><i>{{$total_collection*$section_students}} taka</i></p> --}}
                       @if($expected_collection->isEmpty() != true)
                            <p style="font-size: 14px;" class="text-center"><i>{{$expected_collection[0]->amount}} taka (<small>{{ucfirst($expected_collection[0]->month_name)}}</small>)</i></p>
                       @elseif($expected_collection->isEmpty() == true)
                            <p style="font-size: 14px;" class="text-center"><i>0 taka</i></p>
                       @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card" style="border: 1px solid; border-color: black;">
                    <div class="card-header">
                        <p style="font-size: 15px;" class="p-3 text-center"><strong>Today's Collection</strong></p>
                    </div>
                     @php
                        $today_collection = \App\CollectedFees::where('collection_date', $current_date)
                            ->leftJoin('section_students', 'collected_fees.section_student_id', '=', 'section_students.id')
                            ->leftJoin('sections', 'section_students.section_id', '=', 'sections.id')
                            ->leftJoin('level_enrolls', 'sections.level_enroll_id', '=', 'level_enrolls.id')
                             ->select('collected_fees.*', 'section_students.section_id', 'sections.level_enroll_id','level_enrolls.branch_id')
                             ->where('branch_id',$branch->id)
                            ->get();
                        $total = 0;
                        foreach($today_collection as $collection){
                            $total = $total + $collection->total_collected;
                        }
                    @endphp
                    <div class="card-body">
                        <p style="font-size: 14px;" class="text-center"><i>{{$total}} taka</i></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-5">
                <div class="card" style="border: 1px solid; border-color: red;">
                    @php
                        $total_due = 0;
                        foreach($today_collection as $collection){
                            $total_due = $total_due + $collection->total_due;
                        }
                    @endphp
                    <div class="card-header">
                        <p style="font-size: 15px;" class="p-3 text-center"><strong>Total Due</strong></p>
                    </div>
                    <div class="card-body">
                        <p style="font-size: 14px;" class="text-center"><i>{{$total_due}} taka</i></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
<footer class="footer">
    <div class="container-fluid">
    <div class="copyright pull-right">             
        &copy; <script>document.write(new Date().getFullYear())</script>, built with care by <a href="http://www.systechdigital.com">SYSTECH DIGITAL LIMITED</a>
    </div>
</div>
</footer>
</div>
</div>
@endsection
