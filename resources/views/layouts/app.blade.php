
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('admin')}}/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('admin')}}/img/favicon-final.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>{{env('APP_NAME')}}</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap core CSS     -->
    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    
    

    <!-- for jQuery     -->
    <script src="{{asset('admin/js/jquery.min.js')}}" type="text/javascript"></script>
    
    <script type="text/javascript" src="{{asset('plugins/js/jquery.toaster.js')}}"></script>
    <!-- Animation library for notifications   -->
    <link href="{{asset('admin/css/animate.min.css')}}" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="{{asset('admin/css/paper-dashboard.css')}}" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link href="{{asset('css/custom.css')}}" rel="stylesheet"/>

    <!--  Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{asset('admin/css/themify-icons.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/css/datatables.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/css/datetimepicker.min.css') }}">

    <!--  Multiple select     -->

    <!--  style.css --> 
    <link href="{{asset('admin')}}/css/style.css" rel="stylesheet"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap4-toggle/3.6.1/bootstrap4-toggle.min.js" integrity="sha512-bAjB1exAvX02w2izu+Oy4J96kEr1WOkG6nRRlCtOSQ0XujDtmAstq5ytbeIxZKuT9G+KzBmNq5d23D6bkGo8Kg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap4-toggle/3.6.1/bootstrap4-toggle.min.css" integrity="sha512-EzrsULyNzUc4xnMaqTrB4EpGvudqpetxG/WNjCpG6ZyyAGxeB6OBF9o246+mwx3l/9Cn838iLIcrxpPHTiygAA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    <script type="text/javascript" src="<?php echo url('/');?>/js/jsUtlt.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        jsUtlt["siteUrl"] = function(addr){
            addr = typeof addr != "undefined" ? addr : "";
            return "<?php echo url('/');?>"+addr;
        };
    </script>
</head>

<body>
    <div id="app">
       <div class="wrapper">
        @if (Auth::check())
        <div class="sidebar" data-background-color="white" data-active-color="info">

            <!--
                Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
                Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
            -->

            <div class="sidebar-wrapper">

                @php
                $settings = \App\GeneralSetting::get('site_logo')->first();
                @endphp
                <div class="logo">
                    @if($settings != null)
                    <a href="{{ route('login') }}">
                        <img src="{{asset('site_logo')}}/{{$settings->site_logo}}" style=" height:100px; padding-left: 35px;" alt=""/>
                    </a>
                    @elseif($settings == null)
                    <a href="{{ route('login') }}">  
                        <img src="{{asset('admin/img/demo_logo.png')}}" style="width:160px;height:100px;padding-left: 35px" alt=""/>
                    </a>
                    @endif
                </div>

                <ul class="nav">

                    <li class="{{ Request::is('home') ? 'active' : '' }}">
                        <a href="{{url('/home')}}">
                            <i class="ti-panel"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    
                    @permission(['areas.index','branches.index','sessions.index','terms.index','shifts.index','levels.index', 'subjects.index', 'generalSettings.index', 'notification-receivers.index', 'occasional-notifications.index'])
                    <li class="">
                        <a data-toggle="collapse" href="#settings"  class="">
                            <i class="ti-settings"></i>
                            <p>Application Settings</p> 
                        </a>
                        <div class="collapse" id="settings" aria-expanded="false" style="height: 0px; background-color: #ffffcc;">
                            <ul class="nav">
                                @permission('areas.index')
                                <li class="{{ Request::is('areas*') ? 'active' : '' }}">
                                    <a href="{{url('/areas')}}">
                                        <i class="ti-map"></i>
                                        <p>Areas</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('branches.index')
                                <li class="{{ Request::is('branches*') ? 'active' : '' }}">
                                    <a href="{{url('/branches')}}">
                                        <i class="ti-direction-alt"></i>
                                        <p>Branches</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('sessions.index')
                                <li class="{{ Request::is('sessions*') ? 'active' : '' }}">
                                    <a href="{{url('/sessions')}}">
                                        <i class="ti-control-forward"></i>
                                        <p>Sessions</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('terms.index')
                                <li class="{{ Request::is('terms*') ? 'active' : '' }}">
                                    <a href="{{url('/terms')}}">
                                        <i class="ti-tumblr"></i>
                                        <p>Terms</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('shifts.index')
                                <li class="{{ Request::is('shifts*') ? 'active' : '' }}">
                                    <a href="{{url('/shifts')}}">
                                        <i class="ti-control-shuffle"></i>
                                        <p>Shifts</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('levels.index')
                                <li class="{{ Request::is('levels*') ? 'active' : '' }}">
                                    <a href="{{url('/levels')}}">
                                        <i class="ti-view-list"></i>
                                        <p>Classes</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('levelEnrolls.index')
                                <li class="{{ Request::is('levelEnrolls*') ? 'active' : '' }}">
                                    <a href="{{url('/levelEnrolls')}}">
                                        <i class="ti-ruler-pencil"></i>
                                        <p>Enroll Class</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('subjects.index')
                                <li class="{{ Request::is('subjects*') ? 'active' : '' }}">
                                    <a href="{{url('/subjects')}}">
                                        <i class="ti-pencil-alt"></i>
                                        <p>Subjects</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('generalSettings.index')
                                <li class="{{ Request::is('generalSettings*') ? 'active' : '' }}">
                                    <a href="{{url('/generalSettings')}}">
                                        <i class="ti-unlink"></i>
                                        <p>School Settings</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('notification-receivers.index')
                                <li class="{{ Request::is('notification-receivers*') ? 'active' : '' }}">
                                    <a href="{{url('/notification-receivers')}}">
                                        <i class="ti-volume"></i>
                                        <p>Notification Setting</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('occasional-notifications.index')
                                <li class="{{ Request::is('occasional-notifications*') ? 'active' : '' }}">
                                    <a href="{{url('/occasional-notifications')}}">
                                        <i class="ti-alarm-clock"></i>
                                        <p>Occasional SMS</p>
                                    </a>
                                </li>
                                @endpermission
                            </ul>
                        </div>
                    </li>
                    @endpermission
                    @permission('teachers.index')
                    <li class="{{ Request::is('teachers*') ? 'active' : '' }}">
                        <a href="{{url('/teachers')}}">
                            <i class="ti-user"></i>
                            <p>Teachers</p>
                        </a>
                    </li>
                    @endpermission

                    @permission('sections.index')
                    <li class="{{ Request::is('sections*') ? 'active' : '' }}">
                        <a href="{{url('/sections')}}">
                            <i class="ti-view-list-alt"></i>
                            <p>Sections</p>
                        </a>
                    </li>
                    @endpermission
                    @permission('students.index')
                    <li class="{{ Request::is('students*') ? 'active' : '' }}">
                        <a href="{{url('/students')}}">
                            <i class="ti-pencil-alt2"></i>
                            <p>Students</p>
                        </a>
                    </li>
                    @endpermission



                    <!-- <li class="{{ Request::is('weeklytests*') ? 'active' : '' }}">
                        <a href="{{url('/weeklytests')}}">
                            <i class="ti-medall"></i>
                            <p>Weekly Test</p>
                        </a>
                    </li> -->

                    {{-- @permission('final_reports.index')
                    <li class="{{ Request::is('final_reports*') ? 'active' : '' }}">
                        <a href="{{url('/final_reports')}}">
                            <i class="ti-bookmark-alt"></i>
                            <p>Reports</p>
                        </a>
                    </li>
                    @endpermission --}}
                    @permission(['final_reports.index','weeklytests.wt_report','term_results.searchForTermResult', 'attendanceReport.search','monthlyFeesCollection.index', 'collectionReport.search'])   
                    <li class="">
                        <a data-toggle="collapse" href="#reportsSection"  class="collapsed">
                            <i class="ti-agenda text-danger"></i>
                            <p>Reports</p> 
                        </a>
                        <div class="collapse" id="reportsSection" aria-expanded="false" style="height: 0px; background-color: #ffffcc;">
                            <ul class="nav">
                                @permission('weeklytests.wt_report')
                                <li class="{{ Request::is('wt_report*') ? 'active' : '' }}">
                                    <a href="{{url('/wt_report')}}">
                                        <i class="ti-marker"></i>
                                        <p>Weekly Test Result</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('termresults.index')
                                <li class="{{ Request::is('term_results*') ? 'active' : '' }}">
                                    <a href="{{url('/term_results')}}">
                                        <i class="ti-ruler-pencil"></i>
                                        <p>Term Result</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('student_Statistics.pdf')
                                <li class="{{ Request::is('student-Statistics*') ? 'active' : '' }}">
                                    <a href="{{url('/student-Statistics')}}">
                                        <i class="ti-ruler-pencil"></i>
                                        <p>Student Statistics</p>
                                    </a>
                                </li>
                                @endpermission

                                @permission('blank_result.pdf')
                                <li class="{{ Request::is('blank_result*') ? 'active' : '' }}">
                                    <a href="{{url('/blank_result')}}">
                                        <i class="ti-ruler-pencil"></i>
                                        <p>Blank Result</p>
                                    </a>
                                </li>
                                @endpermission


                                @permission('final_reports.index')
                                <li class="{{ Request::is('final_reports*') ? 'active' : '' }}">
                                    <a href="{{url('/final_reports')}}">
                                        <i class="ti-cloud-down"></i>
                                        <p>Final Result</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('attendanceReport.search')
                                <li class="{{ Request::is('search/attendance_report*') ? 'active' : '' }}">
                                    <a href="{{url('/search/attendance_report')}}">
                                        <i class="ti-check-box text-info"></i>
                                        <p>Attendance Report</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('collectionReport.search')
                                <li class="{{ Request::is('search/collection-report*') ? 'active' : '' }}">
                                    <a href="{{url('/search/collection-report')}}">
                                        <i class="ti-printer"></i>
                                        <p>Collection Report</p>
                                    </a>
                                </li>
                                @endpermission
                                {{-- @permission('monthlyFeesCollection.index')
                                <li class="{{ Request::is('/monthly_fees*') ? 'active' : '' }}">
                                    <a href="{{url('/monthly_fees')}}">
                                        <i class="ti-import text-success"></i>
                                        <p>Monthly Collection</p>
                                    </a>
                                </li>
                                @endpermission --}}
                            </ul>
                        </div>
                    </li>
                    @endpermission
                    @permission(['fiscal_years.index','business_months.index','prefixes.index','fees_books.index','fees_books.index','fees_types.index','section_wise_fees.index','payment_methods.index','collected_fees.index','categories.index','suppliers.index','vouchers.index','financial_reports.index','expectedCollections.index'])   
                    <li class="">
                        <a data-toggle="collapse" href="#accountsSection"  class="collapsed">
                            <i class="ti-money text-info"></i>
                            <p>Account</p> 
                        </a>
                        <div class="collapse" id="accountsSection" aria-expanded="false" style="height: 0px; background-color: #ffffcc;">
                            <ul class="nav">
                                @permission('fiscal_years.index')
                                <li class="{{ Request::is('fiscal_year*') ? 'active' : '' }}">
                                    <a href="{{url('/fiscal_years')}}">
                                        <i class="ti-jsfiddle"></i>
                                        <p>Fiscal Years</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('business_months.index')

                                <li class="{{ Request::is('business_month*') ? 'active' : '' }}">
                                    <a href="{{url('/business_months')}}">
                                        <i class="ti-bar-chart"></i>
                                        <p>Business Months</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('prefixes.index')
                                <li class="{{ Request::is('prefix*') ? 'active' : '' }}">
                                    <a href="{{url('/prefixes')}}">
                                        <i class="ti-notepad"></i>
                                        <p>Prefix</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('fees_books.index')
                                <li class="{{ Request::is('fees_book*') ? 'active' : '' }}">
                                    <a href="{{url('/fees_books')}}">
                                        <i class="ti-book"></i>
                                        <p>Fees Books</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('fees_types.index')
                                <li class="{{ Request::is('fees_type*') ? 'active' : '' }}">
                                    <a href="{{url('/fees_types')}}">
                                        <i class="ti-panel"></i>
                                        <p>Fees Types</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('section_wise_fees.index')
                                <li class="{{ Request::is('section_wise_fees*') ? 'active' : '' }}">
                                    <a href="{{url('/section_wise_fees')}}">
                                        <i class="ti-vector text-danger"></i>
                                        <p>Section-wise Fees</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('payment_methods.index')
                                <li class="{{ Request::is('payment_method*') ? 'active' : '' }}">
                                    <a href="{{url('/payment_methods')}}">
                                        <i class="ti-share"></i>
                                        <p>Payment Methods</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('expectedCollections.index')
                                <li class="{{ Request::is('expectedCollections*') ? 'active' : '' }}">
                                    <a href="{{url('/expectedCollections')}}">
                                        <i class="ti-receipt"></i>
                                        <p>Expected Collection</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('collected_fees.index')
                                <li class="{{ Request::is('collected_fee*') ? 'active' : '' }}">
                                    <a href="{{url('/collected_fees')}}">
                                        <i class="ti-printer text-danger"></i>
                                        <p>Collected Fees</p>
                                    </a>
                                </li>
                                @endpermission
                                {{--  @permission('categories.index')
                                <li class="{{ Request::is('categor*') ? 'active' : '' }}">
                                    <a href="{{url('/categories')}}">
                                        <i class="ti-pulse"></i>
                                        <p>Categories</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('suppliers.index')
                                <li class="{{ Request::is('suppl*') ? 'active' : '' }}">
                                    <a href="{{url('/suppliers')}}">
                                        <i class="ti-user"></i>
                                        <p>Suppliers</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('vouchers.index')
                                <li class="{{ Request::is('voucher*') ? 'active' : '' }}">
                                    <a href="{{url('/vouchers')}}">
                                        <i class="ti-receipt"></i>
                                        <p>Vouchers</p>
                                    </a>
                                </li>
                                @endpermission --}}
                                @permission('financial_reports.index')
                                <li class="{{ Request::is('financial*') ? 'active' : '' }}">
                                    <a href="{{url('/financial_reports')}}">
                                        <i class="ti-zoom-in text-danger"></i>
                                        <p>Financial Report</p>
                                    </a>
                                </li>
                                @endpermission
                            </ul>
                        </div>
                    </li>
                    @endpermission
                    @permission('smsNotification')
                    <li class="{{ Request::is('sms-notification*') ? 'active' : '' }}">
                        <a href="{{url('/sms-notification')}}">
                            <i class="ti-email"></i>
                            <p>Send SMS</p>
                        </a>
                    </li>
                    @endpermission
                    @permission('transfer-certificate.index')
                    <li class="{{ Request::is('transfer-certificate*') ? 'active' : '' }}">
                        <a href="{{url('/transfer-certificate/index')}}">
                            <i class="ti-receipt text-info"></i>
                            <p>Transfer Certificate</p>
                        </a>
                    </li>
                    @endpermission
                    @permission('testimonial.pdf')
                    <li class="{{ Request::is('testmonial*') ? 'active' : '' }}">
                        <a href="{{url('/testmonial/index')}}">
                            <i class="ti-receipt text-info"></i>
                            <p>Testimonial</p>
                        </a>
                    </li>
                    @endpermission
                    @permission('studentship-certificate.pdf')
                    <li class="{{ Request::is('studentship-certificate*') ? 'active' : '' }}">
                        <a href="{{url('/studentship-certificate/index')}}">
                            <i class="ti-receipt text-info"></i>
                            <p>Studentship certificate</p>
                        </a>
                    </li>
                    @endpermission
                    @permission('admit_card.pdf')
                    <li class="{{ Request::is('admit-card*') ? 'active' : '' }}">
                        <a href="{{url('/admit-card/index')}}">
                            <i class="ti-receipt text-info"></i>
                            <p>Admit Card</p>
                        </a>
                    </li>
                    @endpermission
                    <!-- @permission('attendancedevices.index')
                    <li class="{{ Request::is('attendancedevices*') ? 'active' : '' }}">
                        <a href="{{url('/attendancedevices')}}">
                            <i class="ti-arrow-circle-down"></i>
                            <p>Attendance Device</p>
                        </a>
                    </li> -->
                    @endpermission
                    @permission('attendance.store')
                    <li class="{{ Request::is('attendance*') ? 'active' : '' }}">
                        <a href="{{url('/attendance_select_form')}}">
                            <i class="ti-arrow-circle-down"></i>
                            <p>Attendance System</p>
                        </a>
                    </li>
                    @endpermission
                    @permission(['roles.index','users.index'])
                    <li >
                        <a data-toggle="collapse" href="#userManage"  class="collapsed">
                            <i class="ti-id-badge text-danger"></i>
                            <p>User Manage</p> 
                        </a>
                        <div class="collapse" id="userManage" aria-expanded="false" style="height: 0px; background-color: #ffffcc;">
                            <ul class="nav">
                                @permission('roles.index')
                                <li class="{{ Request::is('roles*') ? 'active' : '' }}">
                                    <a href="{{url('/roles')}}">
                                        <i class="ti-hand-stop text-danger"></i>
                                        <p>Roles</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('users.index')
                                <li class="{{ Request::is('users*') ? 'active' : '' }}">
                                    <a href="{{url('/users')}}">
                                        <i class="ti-back-right text-success"></i>
                                        <p>Users</p>
                                    </a>
                                </li>
                                @endpermission
                            </ul>
                        </div>
                    </li>
                    @endpermission
                    <hr class="m-0">
                    <li style="font-size: 20px;" class="">
                        <a class="pl-5" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}

                            <form class="" id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
        @endif

        <div class="main-panel" style="background-color:#f4f3ef;">
            <nav class="navbar navbar-default" style="background-color:#f4f3ef;">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar bar1"></span>
                            <span class="icon-bar bar2"></span>
                            <span class="icon-bar bar3"></span>
                        </button>
                        <a class="navbar-brand" href="#">@yield('heading')</a>

                    </div>
                    
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                          @guest
                                <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @else
                            <li>
                                @php
                                if(Auth::user()->teacher != NULL){
                                    $url = route('teachers.show', Auth::user()->teacher->id);
                                }
                                else{
                                    $url = route('users.show', Auth::user()->id);
                                }
                                @endphp
                               
                                <a style="font-size: 20px;" href="{{ $url }}">
                                    <form id="profile" action="{{ $url }}" method="POST"
                                    style="">
                                    @csrf
                                    {{ Auth::user()->name }}

                                    </form>
                                </a>
                            </li>
                            <li>
                                <a class="pr-5" data-toggle="tooltip" data-placement="top" title="Logout"  href="{{ route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa-2x fa fa-sign-out"></i>

                                    <form class="" id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </a>
                            </li>
                         @endguest
                        </ul>

                    </div>
                </div>
            </nav>
            <main class="py-4">
                @yield('content')

                @yield('login')
            </main>
        </div>
    </div>
</div>

@stack('scripts')

<script src="{{asset('admin/js/bootstrap.min.js')}}" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->

<!--  Charts Plugin -->
<script src="{{asset('admin/js/chartist.min.js')}}"></script>

<!--  Notifications Plugin    -->
<script src="{{asset('admin/js/bootstrap-notify.js')}}"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="{{asset('admin/js/paper-dashboard.js')}}"></script>

<!-- Paper Dashboard DEMO methods, don't include it in your project! -->

<!-- datatable -->


<link rel="stylesheet" type="text/css" href="{{asset('plugins/css/datatables2.min.css')}}"/>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="{{asset('plugins/js/datatables2.min.js')}}"></script>
<script src="{{ asset('material/js/plugins/bootstrap-datetimepicker.min.js') }}"></script>

<script>
    function goBack() {
      window.history.back();
  }

  $(function(){
    if(<?php
        if(Request::is('areas*')
            || Request::is('branches*')
            || Request::is('sessions*')
            || Request::is('terms*')
            || Request::is('shifts*')
            || Request::is('levels*')
            || Request::is('levelEnrolls*')
            || Request::is('subjects*')
            || Request::is('generalSettings*')
            || Request::is('notification-receivers*')
            || Request::is('occasional-notifications*')
        ) 
            echo "true";
        else
            echo "false";
        ?>){
        $('#settings').collapse('show');
    }

    if(<?php
        if(Request::is('roles*')
            || Request::is('users*')
        ) 
            echo "true";
        else
            echo "false";
        ?>){
        $('#userManage').collapse('show');
    }

    if(<?php
        if(Request::is('fiscal_years*')
            || Request::is('business_months*')
            || Request::is('prefixes*')
            || Request::is('fees_books*')
            || Request::is('fees_types*')
            || Request::is('section_wise_fees*')
            || Request::is('payment_methods*')
            || Request::is('expectedCollections*')
            || Request::is('collected_fees*')
            || Request::is('categories*')
            || Request::is('suppliers*')
            || Request::is('vouchers*')
        ) 
            echo "true";
        else
            echo "false";
        ?>){
        $('#accountsSection').collapse('show');
    }
    if(<?php
        if(Request::is('final_reports*')
            || Request::is('wt_report*')
            || Request::is('term_results*')
            || Request::is('monthly_fees*')
            || Request::is('search/attendance_report*')
        ) 
            echo "true";
        else
            echo "false";
        ?>){
        $('#reportsSection').collapse('show');
    }
});
</script>

</body>
@yield('modal-parts')


</html>
