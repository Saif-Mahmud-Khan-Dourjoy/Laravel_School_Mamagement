@section('heading')
    Attendance Report
@endsection
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="col-md-6 panel-body" style="padding:0px;">  
                        <h5 style="padding-left: 25px; padding-top:0px; margin:0px;"><strong>Class:</strong> {{$section_student_attendance[0]->class_name}}</h5>
                        <p style="padding-left: 25px; padding-top:0px; margin:0px;"><strong>Section:</strong> {{$section_student_attendance[0]->section_name}}</p>
                        <p style="padding-left: 25px; padding-top:0px; margin:0px;"><strong>Attendance Date:</strong> {{$today}}</p>
                    </div>
                    <div class="col-md-6"  style="padding:0px;">
                        <form class="form-inline" id="filter_form" method="get">
                            <div class="form-group">
                                <input type="hidden" name="section_id" value="{{$section_student_attendance[0]->section_id}}">
                                <select class="form-control custom-select" name="filter_value" style="width:165px;">
                                    <option selected disabled>Filter Attendance</option>
                                    <option value="1">Absent Students</option>
                                    <option value="2">Present Students</option>
                                    <option value="3">Absent & Present</option>
                                </select>
                                <button type="submit" id="filter_btn" class="btn btn-success btn-sm btn-round"><i class="fa fa-refresh text-info"></i></button>
                                <a href="{{route('sections.index')}}" class="btn btn-info"><i class="fa fa-reply-all text-info"></i> Go to Section List</a>
                            </div>
                        </form>
                    </div>          
                </div>

           {{-- filtering absent students --}}
                @if($filter_type == 1)
                    <div class="row">
                        <div class="col-md-12">
                            <strong><p style="font-size: 18px; text-align: left; color: slateblue;" class="h4">List of the <span style="color:olive;">Absent</span> Students of Class {{$section_student_attendance[0]->class_name}}</p></strong>    
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table id="" class="table table-striped" style="width:90%; margin-left:20px;">
                            <thead>
                                <tr>
                                    <th colspan="6" style="text-align: left;">
                                        <form method="get" action="{{route('attendance.pdfAttendanceReport', ['section_id' => $section_student_attendance[0]->section_id])}}" target="_blank">
                                            <input type="hidden" name="searched_date" value="">
                                            <input type="hidden" name="filter_type" value="1">
                                            <button type="submit" class="btn btn-outline-success btn-sm"><i class="fa fa-download text-warning"></i> PDF</button> 
                                        </form>
                                    </th> 
                                </tr>
                                <tr>
                                    <th style="text-align: center;"><strong>SL</strong></th>
                                    <th style="text-align: left;"><strong>Student Name</strong></th>
                                    <th style="text-align: center;"><strong>Class Roll</strong></th>
                                    <th style="text-align: center;"><strong>Contact No(Father)</strong></th>
                                    <th style="text-align: center;"><strong>Contact No(Mother)</strong></th>
                                    <th style="text-align: center;"><strong>Status</strong></th>
                                </tr>
                            </thead>
                        @php
                        //dd($section_student_attendance);
                        $i = 1;
                        $present = 0;
                        $absent = 0;
                        @endphp
                            <tbody>
                                @foreach($section_student_attendance as $st_attendance)
                                @php
                                    if($st_attendance->in_time != null){
                                        $present++;
                                    }else{
                                        $absent++;
                                    }
                                    if($st_attendance->in_time != null){
                                        continue;
                                    }
                                @endphp
                                <tr>
                                    <td style="text-align: center;">@php echo $i; @endphp</td>
                                    <td style="text-align: left;">{{$st_attendance->name}}</td>
                                    <td style="text-align: center;">{{$st_attendance->roll}}</td>
                                    <td style="text-align: center;">
                                        {{$st_attendance->fathers_name}}<br>
                                        @php
                                            if($st_attendance->fathers_cell != null){
                                                @endphp
                                                {{$st_attendance->fathers_cell}}
                                                @php
                                            }
                                            else echo "---";
                                        @endphp
                                        
                                    </td>
                                    <td style="text-align: center;">
                                        {{$st_attendance->mothers_name}}<br>
                                        @php
                                            if($st_attendance->mothers_cell != null){
                                                @endphp
                                                {{$st_attendance->mothers_cell}}
                                                @php
                                            }
                                            else echo "---";
                                        @endphp
                                    </td>
                                    <td style="text-align: center;">
                                        @php
                                            $absent_msg = "Absent";
                                            $present_msg = "Present";
                                            if($st_attendance->in_time == null){
                                                echo "<p style='color:red;'>" . "<b>" . $absent_msg . "</b>" . "</p>";
                                            }
                                            else{
                                                echo "<p style='color:green;'>" .  "<b>" . $present_msg .  "</b>" . "</p>";
                                            }
                                        @endphp
                                    </td>
                                </tr>
                                @php $i++; @endphp
                                @endforeach
                                <tr>
                                    <td style="text-align: center;"></td>
                                    <td style="text-align: center;"></td>
                                    <td style="text-align: center;"></td>
                                    <td style="text-align: center;"></td>
                                    <td style="text-align: center;"></td>
                                    <td style="text-align: center;">
                                        @php
                                            $a_msg = "Total Absent = ";
                                            echo "<p style='color:red;'>" . "<b>" . $a_msg . $absent ."</b>" . "</p>";
                                        @endphp
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif

           {{-- filtering present students --}}
                @if($filter_type == 2)
                    <div class="row">
                        <div class="col-md-12">
                            <strong><p style="font-size: 18px; text-align: left; color: slateblue;" class="h4">List of the <span style="color:olive;">Present</span> Students of Class {{$section_student_attendance[0]->class_name}}</p></strong>    
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table id="" class="table table-striped" style="width:90%; margin-left:20px;">
                            <thead>
                                <tr>
                                    <th colspan="6" style="text-align: left;">
                                        <form method="get" action="{{route('attendance.pdfAttendanceReport', ['section_id' => $section_student_attendance[0]->section_id])}}" target="_blank">
                                            <input type="hidden" name="searched_date" value="">
                                            <input type="hidden" name="filter_type" value="2">
                                            <button type="submit" class="btn btn-outline-success btn-sm"><i class="fa fa-download text-warning"></i> PDF</button> 
                                        </form>
                                    </th> 
                                </tr>
                                <tr>
                                    <th style="text-align: center;"><strong>SL</strong></th>
                                    <th style="text-align: left;"><strong>Student Name</strong></th>
                                    <th style="text-align: center;"><strong>Class Roll</strong></th>
                                    <th style="text-align: center;"><strong>In Time</strong></th>
                                    <th style="text-align: center;"><strong>Out Time</strong></th>
                                    <th style="text-align: center;"><strong>Status</strong></th>
                                </tr>
                            </thead>
                        @php
                        $i = 1;
                        $present = 0;
                        $absent = 0;
                        @endphp
                            <tbody>
                                @foreach($section_student_attendance as $st_attendance)
                                @php
                                    if($st_attendance->in_time != null){
                                        $present++;
                                    }else{
                                        $absent++;
                                    }
                                     if($st_attendance->in_time == null){
                                        continue;
                                    }
                                @endphp
                                <tr>
                                    <td style="text-align: center;">@php echo $i; @endphp</td>
                                    <td style="text-align: left;">{{$st_attendance->name}}</td>
                                    <td style="text-align: center;">{{$st_attendance->roll}}</td>
                                    <td style="text-align: center;">
                                        @php
                                            if($st_attendance->in_time == null){
                                                echo "--";
                                            }else{
                                        @endphp
                                            {{$st_attendance->in_time}}
                                        @php
                                            }
                                        @endphp  
                                    </td>
                                    <td style="text-align: center;">
                                        @php
                                            if($st_attendance->in_time == null){
                                                echo "--";
                                            }else{
                                        @endphp
                                            {{$st_attendance->out_time}}
                                        @php
                                            }
                                        @endphp  
                                    </td>
                                    <td style="text-align: center;">
                                        @php
                                            $absent_msg = "Absent";
                                            $present_msg = "Present";
                                            if($st_attendance->in_time == null){
                                                echo "<p style='color:red;'>" . "<b>" . $absent_msg . "</b>" . "</p>";
                                            }else{
                                                echo "<p style='color:green;'>" .  "<b>" . $present_msg .  "</b>" . "</p>";
                                            }
                                        @endphp
                                    </td>
                                </tr>
                                @php $i++; @endphp
                                @endforeach
                                <tr>
                                    <td style="text-align: center;"></td>
                                    <td style="text-align: center;"></td>
                                    <td style="text-align: center;"></td>
                                    <td style="text-align: center;"></td>
                                    <td style="text-align: center;"></td>
                                    <td style="text-align: center;">
                                        @php
                                            $p_msg = "Total Present = ";
                                            echo "<p style='color:green;'>" . "<b>" . $p_msg . $present ."</b>" . "</p>";
                                        @endphp
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif

            {{-- filtering both present and absent students --}}
                @if($filter_type == 3)
                    <div class="row">
                        <div class="col-md-12">
                            <strong><p style="font-size: 18px; text-align: left; color: slateblue;" class="h4">List of the <span style="color:olive;">Present & Absent</span> Students of Class {{$section_student_attendance[0]->class_name}}</p></strong>    
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table id="" class="table table-striped" style="width:90%; margin-left:20px;">
                            <thead>
                                <tr>
                                    <th colspan="6" style="text-align: left;">
                                        <form method="get" action="{{route('attendance.pdfAttendanceReport', ['section_id' => $section_student_attendance[0]->section_id])}}" target="_blank">
                                            <input type="hidden" name="searched_date" value="">
                                            <input type="hidden" name="filter_type" value="3">
                                            <button type="submit" class="btn btn-outline-success btn-sm"><i class="fa fa-download text-warning"></i> PDF</button> 
                                        </form>
                                    </th> 
                                </tr>
                                <tr>
                                    <th style="text-align: center;"><strong>SL</strong></th>
                                    <th style="text-align: left;"><strong>Student Name</strong></th>
                                    <th style="text-align: center;"><strong>Class Roll</strong></th>
                                    <th style="text-align: center;"><strong>In Time</strong></th>
                                    <th style="text-align: center;"><strong>Out Time</strong></th>
                                    <th style="text-align: center;"><strong>Present Status</strong></th>
                                </tr>
                            </thead>
                        @php
                        $i = 1;
                        $present = 0;
                        $absent = 0;
                        @endphp
                            <tbody>
                                @foreach($section_student_attendance as $st_attendance)
                                @php
                                    if($st_attendance->in_time != null){
                                        $present++;
                                    }else{
                                        $absent++;
                                    }
                                @endphp
                                <tr>
                                    <td style="text-align: center;">@php echo $i; @endphp</td>
                                    <td style="text-align: left;">{{$st_attendance->name}}</td>
                                    <td style="text-align: center;">{{$st_attendance->roll}}</td>
                                    <td style="text-align: center;">
                                        @php
                                            $father_name = $st_attendance->fathers_name;
                                            $father_cell = $st_attendance->fathers_cell;
                                            if($st_attendance->in_time == null){
                                                if($father_cell != null){
                                                    echo "<b>"."Contact-No: (Father)"."</b>"."<br>".$father_name."<br>"."(".$father_cell.")";
                                                }else{
                                                    echo "<b>"."Contact-No: (Father)"."</b>"."<br>".$father_name."<br>"."(---)";
                                                }
                                            }else{
                                        @endphp
                                            {{$st_attendance->in_time}}
                                        @php
                                            }
                                        @endphp  
                                    </td>
                                    <td style="text-align: center;">
                                        @php
                                            $mother_name = $st_attendance->mothers_name;
                                            $mother_cell = $st_attendance->mothers_cell;
                                            if($st_attendance->in_time == null){
                                                if($mother_cell != null){
                                                    echo "<b>"."Contact-No: (Mother)"."</b>"."<br>".$mother_name."<br>"."(".$mother_cell.")";
                                                }else{
                                                    echo "<b>"."Contact-No: (Mother)"."</b>"."<br>".$mother_name."<br>"."(---)";
                                                }
                                            }else{
                                        @endphp
                                            {{$st_attendance->out_time}}
                                        @php
                                            }
                                        @endphp  
                                    </td>
                                    <td style="text-align: center;">
                                        @php
                                            $absent_msg = "Absent";
                                            $present_msg = "Present";
                                            if($st_attendance->in_time == null){
                                                echo "<p style='color:red;'>" . "<b>" . $absent_msg . "</b>" . "</p>";
                                            }else{
                                                echo "<p style='color:green;'>" .  "<b>" . $present_msg .  "</b>" . "</p>";
                                            }
                                        @endphp
                                    </td>
                                </tr>
                                @php $i++; @endphp
                                @endforeach
                                <tr>
                                    <td style="text-align: center;"></td>
                                    <td style="text-align: center;"></td>
                                    <td style="text-align: center;"></td>
                                    <td style="text-align: center;"></td>
                                    <td style="text-align: center;"></td>
                                    <td style="text-align: center;">
                                        @php
                                            $a_msg = "Total Absent = ";
                                            $p_msg = "Total Present = ";
                                            echo "<p style='color:green;'>" . "<b>" . $p_msg . $present ."</b>" . "</p>";
                                            echo "<p style='color:red;'>" . "<b>" . $a_msg . $absent ."</b>" . "</p>";
                                        @endphp
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif

            {{-- initially when not filterd any record --}}
                @if($filter_type == null)
                    <div class="row">
                        <div class="col-md-12">
                            <strong><p style="font-size: 18px; text-align: left; color: slateblue;" class="h4">Attendance List of the Students of Class {{$section_student_attendance[0]->class_name}}</p></strong>    
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table id="" class="table table-striped" style="width:90%; margin-left:20px;">
                            <thead>
                                <tr>
                                    <td colspan="6" style="text-align: left;">
                                        <form method="get" action="{{route('attendance.pdfAttendanceReport', ['section_id' => $section_student_attendance[0]->section_id])}}" target="_blank">
                                            <input type="hidden" name="searched_date" value="">
                                            <input type="hidden" name="filter_type" value="">
                                            <button type="submit" class="btn btn-outline-success btn-sm"><i class="fa fa-download text-warning"></i> PDF</button> 
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: center;"><strong>SL</strong></th>
                                    <th style="text-align: left;"><strong>Student Name</strong></th>
                                    <th style="text-align: center;"><strong>Class Roll</strong></th>
                                    <th style="text-align: center;"><strong>In Time</strong></th>
                                    <th style="text-align: center;"><strong>Out Time</strong></th>
                                    <th style="text-align: center;"><strong>Status</strong></th>
                                </tr>
                            </thead>
                        @php
                        $i = 1;
                        $present = 0;
                        $absent = 0;
                        @endphp
                            <tbody>
                                @foreach($section_student_attendance as $st_attendance)
                                @php
                                    if($st_attendance->in_time != null){
                                        $present++;
                                    }else{
                                        $absent++;
                                    }
                                @endphp
                                <tr>
                                    <td style="text-align: center;">@php echo $i; @endphp</td>
                                    <td style="text-align: left;">{{$st_attendance->name}}</td>
                                    <td style="text-align: center;">{{$st_attendance->roll}}</td>
                                    <td style="text-align: center;">
                                        @php
                                            $father_name = $st_attendance->fathers_name;
                                            $father_cell = $st_attendance->fathers_cell;
                                            if($st_attendance->in_time == null){
                                                if($father_cell != null){
                                                    echo "<b>"."Contact-No: (Father)"."</b>"."<br>".$father_name."<br>"."(".$father_cell.")";
                                                }else{
                                                    echo "<b>"."Contact-No: (Father)"."</b>"."<br>".$father_name."<br>"."(---)";
                                                }
                                            }else{
                                        @endphp
                                            {{$st_attendance->in_time}}
                                        @php
                                            }
                                        @endphp  
                                    </td>
                                    <td style="text-align: center;">
                                        @php
                                            $mother_name = $st_attendance->mothers_name;
                                            $mother_cell = $st_attendance->mothers_cell;
                                            if($st_attendance->in_time == null){
                                                if($mother_cell != null){
                                                    echo "<b>"."Contact-No: (Mother)"."</b>"."<br>".$mother_name."<br>"."(".$mother_cell.")";
                                                }else{
                                                    echo "<b>"."Contact-No: (Mother)"."</b>"."<br>".$mother_name."<br>"."(---)";
                                                }
                                            }else{
                                        @endphp
                                            {{$st_attendance->out_time}}
                                        @php
                                            }
                                        @endphp  
                                    </td>
                                    <td style="text-align: center;">
                                        @php
                                            $absent_msg = "Absent";
                                            $present_msg = "Present";
                                            if($st_attendance->in_time == null){
                                                echo "<p style='color:red;'>" . "<b>" . $absent_msg . "</b>" . "</p>";
                                            }else{
                                                echo "<p style='color:green;'>" .  "<b>" . $present_msg .  "</b>" . "</p>";
                                            }
                                        @endphp
                                    </td>
                                </tr>
                                @php $i++; @endphp
                                @endforeach
                                <tr>
                                    <td style="text-align: center;"></td>
                                    <td style="text-align: center;"></td>
                                    <td style="text-align: center;"></td>
                                    <td style="text-align: center;"></td>
                                    <td style="text-align: center;"></td>
                                    <td style="text-align: center;">
                                        @php
                                            $a_msg = "Total Absent = ";
                                            $p_msg = "Total Present = ";
                                            echo "<p style='color:green;'>" . "<b>" . $p_msg . $present ."</b>" . "</p>";
                                            echo "<p style='color:red;'>" . "<b>" . $a_msg . $absent ."</b>" . "</p>";
                                        @endphp
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
        @if(url()->previous() == route('sections.index'))
            <div class="row">
                <div class="col-md-12" style="text-align: center;">
                    <a href="{{route('sections.index')}}" class="btn btn-info btn-wd"> Go Back</a>  
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-12" style="text-align: center;">
                    <a href="{{route('sectionStudents.show', ['sectionStudent' => $section_student_attendance[0]->section_id])}}" class="btn btn-info btn-wd"> Go Back</a>  
                </div>
            </div>
        @endif
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
             $.ajax({
                url:  jsUtlt.siteUrl("/section_student/view_attendance/"),
                type: "GET",
                data: $('#filter_form').serialize(),
              });
        });
    </script>
@endsection

