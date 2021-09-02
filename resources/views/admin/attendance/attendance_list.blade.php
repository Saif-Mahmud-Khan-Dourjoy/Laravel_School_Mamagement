
@if($section_student_attendance->count() != 0)
<div class="container-fluid">
<div class="row">
    <div class="col-md-12">
        <div class="card card-plain">
            <div id="att_intro_div" class="col-md-12 panel-body py-4" style="padding:0px;">
                 <table class="table table-bordered m-auto" style="width: 75%; border: 1px dotted;">
			      <tbody>
			      	<tr>
			          <th  style="padding:2px; font-size: 16px;" scope="row">Date of Attendance: <span style="color:red;">{{$date}}</span></th>
			          <td colspan="3" style="padding:2px; font-size: 16px;"><strong>Number of Total Students = </strong> {{$total_std}} ({{$total_std_word}})<small style="color: indigo;"><b> Class-{{$section_student_attendance[0]->class_name}}</b></small></td>
			        </tr>
			        <tr>
			          <th  style="padding:2px;" scope="row">Absent</th>
			          <td style="padding:2px;"><span style="color:red;">{{$absent_std}} ({{$absent_std_word}})</span></td>
			          <th  style="padding:2px;" scope="row">Present</th>
			          <td style="padding:2px;"><span style="color:green;">{{$present_std}} ({{$present_std_word}})</span></td>
			        </tr>	
			        <tr>
			          <th  style="padding:2px;" scope="row">Branch</th>
			          <td style="padding:2px;">{{$section_student_attendance[0]->branchName}}</td>
			          <th  style="padding:2px;" scope="row">Session</th>
			          <td style="padding:2px;">{{$section_student_attendance[0]->sessionName}}</td>
			        </tr>
			        <tr>
			          <th  style="padding:2px;" scope="row">Section</th>
			          <td style="padding:2px;">{{$section_student_attendance[0]->section_name}}</td>
			          <th style="padding:2px;"  scope="row">Class</th>
			          <td style="padding:2px;">{{$section_student_attendance[0]->class_name}}</td>
			        </tr>
                    <tr>
                      <th style="padding:2px;"  scope="row">Search Date & Time</th>
                      <td colspan="3" style="padding:2px;">{{$today}}</td>
                    </tr>
                    <tr>
                      <th  colspan="3" style="padding:2px;" scope="row">
                        <marquee width="100%" direction="right">
                        <strong><p style="text-align:left; padding-left: 0px; font-size: 14px;">Showing the 
                            <span style="color:red;">
                                @if($type == 1)
                                    Present
                                @elseif($type == 2)
                                    Absent
                                @elseif($type == null)
                                    Present & Absent
                                @endif
                            </span> 
                            Student's Record of <span style="font-size: 14px; color:green;">{{$date}}</span></p></strong>
                        </marquee>
                      </th>
                      <td style="padding:2px;">
                        <form method="get" action="{{route('attendance.pdfAttendanceReport', ['section_id' => $section_student_attendance[0]->section_id])}}" target="_blank">
                                <input type="hidden" name="searched_date" value="{{$date}}">
                            @if($type == 1)
                                <input type="hidden" name="filter_type" value="2">
                            @endif
                            @if($type == 2)
                                <input type="hidden" name="filter_type" value="1">
                            @endif
                            @if($type == null)
                                <input type="hidden" name="filter_type" value="3">
                            @endif
                        <button style="margin-left: 5px; margin-bottom: 0px; font-size: 14px;" type="submit" class="btn btn-outline-success btn-xs"><i class="fa fa-download text-info"></i> PDF</button> 
                        </form>
                      </td>
                    </tr>
			      </tbody>
			    </table>
            </div>
        </div>

   	{{-- filtering present students --}}
        @if($type == 1)
            <div class="content table-responsive table-full-width">
                <table id="present_std_datatable" class="table table-striped" style="width:95%; margin-left:20px;">
                    <thead>
                        <tr>
                            <th style=" font-size: 16px; padding: 0px; text-align: center;"><strong>SL</strong></th>
                            <th style=" font-size: 16px; padding-left: 20px; text-align: left;"><strong>Student Name</strong></th>
                            <th style=" font-size: 16px; padding: 0px; text-align: center;"><strong>Class Roll</strong></th>
                            <!-- <th style=" font-size: 16px; padding: 0px; text-align: center;"><strong>In Time</strong></th>
                            <th style=" font-size: 16px; padding: 0px; text-align: center;"><strong>Out Time</strong></th> -->
                            <th style=" font-size: 16px; padding: 0px; text-align: center;"><strong>Present Status</strong></th>
                        </tr>
                    </thead>
                @php
                $i = 1;
                @endphp
                    <tbody>
                        @foreach($section_student_attendance as $st_attendance)
                        @php
                             if($st_attendance->in_time == null){
                                continue;
                            }
                        @endphp
                        <tr>
                            <td style=" font-size: 14px; padding: 0px; text-align: center;">@php echo $i; @endphp</td>
                            <td style=" font-size: 14px; padding-left: 20px; text-align: left;">{{$st_attendance->studentName}}</td>
                            <td style=" font-size: 14px; padding: 0px; text-align: center;">{{$st_attendance->roll}}</td>
                            
                            <td style=" font-size: 14px; padding: 0px; text-align: center;">
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
                    </tbody>
                </table>
            </div>
        @endif

    {{-- filtering absent students --}}
        @if($type == 2)
            <div class="content table-responsive table-full-width">
                <table id="absent_std_datatable" class="table table-striped" style="width:95%; margin-left:20px;">
                    <thead>
                        <tr>
                            <th style="font-size: 16px; padding: 0px; text-align: center;"><strong>SL</strong></th>
                            <th style="font-size: 16px; padding-left: 20px; text-align: left;"><strong>Student Name</strong></th>
                            <th style="font-size: 16px; padding: 0px; text-align: center;"><strong>Class Roll</strong></th>
                            <th style="font-size: 16px; padding: 0px; text-align: center;"><strong>Contact No(Father)</strong></th>
                            <th style="font-size: 16px; padding: 0px; text-align: center;"><strong>Contact No(Mother)</strong></th>
                            <th style="font-size: 16px; padding: 0px; text-align: center;"><strong>Status</strong></th>
                        </tr>
                    </thead>
                @php
                $i = 1;
                @endphp
                    <tbody>
                        @foreach($section_student_attendance as $st_attendance)
                        @php
                            if($st_attendance->in_time != null){
                                continue;
                            }
                        @endphp
                        <tr>
                            <td style="font-size: 14px; padding: 0px; text-align: center;">@php echo $i; @endphp</td>
                            <td style="font-size: 14px; padding-left: 20px; text-align: left;">{{$st_attendance->studentName}}</td>
                            <td style="font-size: 14px; padding: 0px; text-align: center;">{{$st_attendance->roll}}</td>
                            <td style="font-size: 14px; padding: 0px; text-align: center;">
                                <strong>{{$st_attendance->fathers_name}}</strong><br>
                                @php
                                    if($st_attendance->fathers_cell != null){
                                        @endphp
                                        {{$st_attendance->fathers_cell}}
                                        @php
                                    }
                                    else echo "---";
                                @endphp
                                
                            </td>
                            <td style="font-size: 14px; padding: 0px; text-align: center;">
                                <strong>{{$st_attendance->mothers_name}}</strong><br>
                                @php
                                    if($st_attendance->mothers_cell != null){
                                        @endphp
                                        {{$st_attendance->mothers_cell}}
                                        @php
                                    }
                                    else echo "---";
                                @endphp
                            </td>
                            <td style="font-size: 14px; padding: 0px; text-align: center;">
                                @php
                                    $absent_msg = "Absent";
                                    $present_msg = "Present";
                                    if($st_attendance->in_time == null){
                                        echo "<p style='color:red; font-size:14px;'>" . "<b>" . $absent_msg . "</b>" . "</p>";
                                    }
                                    else{
                                        echo "<p style='color:green; font-size:14px;'>" .  "<b>" . $present_msg .  "</b>" . "</p>";
                                    }
                                @endphp
                            </td>
                        </tr>
                        @php $i++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

   	{{-- filtering both present and absent students --}}
        @if($type == null)
            <div class="content table-responsive table-full-width">
                <table id="pa_std_datatable" class="table table-striped" style="width:95%; margin-left:20px;">
                    <thead>
                        <tr>
                            <th style="font-size: 16px; padding:0px; text-align: center;"><strong>SL</strong></th>
                            <th style="font-size: 16px; padding-left: 20px; text-align: left;"><strong>Student Name</strong></th>
                            <th style="font-size: 16px; padding:0px; text-align: center;"><strong>Class Roll</strong></th>
                            <th style="font-size: 16px; padding:0px; text-align: center;"><strong>In Time</strong></th>
                            <th style="font-size: 16px; padding:0px; text-align: center;"><strong>Out Time</strong></th>
                            <th style="font-size: 16px; padding:0px; text-align: center;"><strong>Present Status</strong></th>
                        </tr>
                    </thead>
                @php
                $i = 1;
                @endphp
                    <tbody>
                        @foreach($section_student_attendance as $st_attendance)
                        <tr>
                            <td style="font-size: 14px; padding:0px; text-align: center;">@php echo $i; @endphp</td>
                            <td style="font-size: 14px; padding-left: 20px; text-align: left;">{{$st_attendance->studentName}}</td>
                            <td style="font-size: 14px; padding:0px; text-align: center;">{{$st_attendance->roll}}</td>
                            <td style="font-size: 14px; padding:0px; text-align: center;">
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
                            <td style="font-size: 14px; padding:0px; text-align: center;">
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
                            <td style="font-size: 14px; padding:0px; text-align: center;">
                                @php
                                    $absent_msg = "Absent";
                                    $present_msg = "Present";
                                    if($st_attendance->in_time == null){
                                        echo "<p style='color:red; font-size:14px;'>" . "<b>" . $absent_msg . "</b>" . "</p>";
                                    }else{
                                        echo "<p style='color:green; font-size:14px;'>" .  "<b>" . $present_msg .  "</b>" . "</p>";
                                    }
                                @endphp
                            </td>
                        </tr>
                        @php $i++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@elseif($section_student_attendance->count() == 0)
<div class="container-fluid">
    <div class="row">
        <div id="att_alert" class="alert alert-danger fade in" style="width: 560px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Failed to load Attendance!!</strong> No student is Available in this Section..
        </div>
    </div>
</div>
<script type="text/javascript">
window.setTimeout(function(){
    $("#att_alert").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
    });
}, 1000); 
</script>
@endif