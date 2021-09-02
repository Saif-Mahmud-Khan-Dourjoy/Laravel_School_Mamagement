<!DOCTYPE html>
<html>
<head>
	<title>Student's Daily Attendance Sheet</title>
</head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

.table tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<body>
@php
$settings = \App\GeneralSetting::first();
@endphp
	<div class="row">
		<div style="margin-bottom: 20px; width:100%; height:60px;">
			<div class="logo" style="float:left; width:15%; margin-right: -15px;">
                @if($settings != null)
                    
                    <img src="{{asset('site_logo')}}/{{$settings->site_logo}}" style="height:70px; margin-top:15px;;" alt=""/>
                
                @elseif($settings == null)
                    
                    <img src="{{asset('admin/img/demo_logo.png')}}" style="height:70px; margin-top:15px;" alt=""/>
                
                @endif
				 <!-- <img src="{{asset('admin')}}/img/favicon-final.png" style="height:70px; margin-top:15px;"/> -->
			</div>
			<div style="float:left; width:80%; text-align: center;">
				<h3 style="margin:0px; padding:0px">{{ $settings->site_name }}</h3>
				<address style="margin:0px; padding:0px">{{ $settings->address_1 }}</address>
				<span style="margin:0px; padding:0px">Phone: {{ $settings->phone_1 }}</span><br>
				<div>
					<img src="{{asset('admin')}}/img/mailicon.png" style="width:15px;height:13px; vertical-align: middle;"/>
					<span style="text-align: center; margin:0px; padding:0px; font-size: 12px;">{{ $settings->email_1 }}</span>
				</div>
				<div>
					<img src="{{asset('admin')}}/img/webicon.png" style="width:15px;height:13px;vertical-align: middle;"/>
					<span style="text-align: center; margin:0px; padding:0px; font-size: 12px;"> {{ $settings->website }} |</span>
					<img src="{{asset('admin')}}/img/facebook.png" style="width:15px;height:13px;vertical-align: middle;"/> 
					<span style="text-align: center; margin:0px; padding:0px; font-size: 12px;"> {{ $settings->facebook }}</span>
				</div>
			</div>
		</div>
	</div>
    <br>
	<div>
		<p style="text-align: center; font-size: 15px;"><b>Student's Daily Attendance Report</b></p>
	</div>
	@php
	$count_all=  \App\SectionStudent::where('section_id',$section->id)->count();
	$count_present=  \App\AttendanceStatus::where('section_id',$section->id)->where('date',$attendance_date)->where('status',1)->count();
	$count_absent=  \App\AttendanceStatus::where('section_id',$section->id)->where('date',$attendance_date)->where('status',0)->count();

	@endphp
	<div class="row" style="padding-top: 0px;">
		<table style="width:100%; border:1px dotted;">
			<tbody>
				<tr>
					<td colspan=3> <p style="padding-left: 10px; padding-top:0px; margin:0px; text-align: center;"><strong>Attendance Date:</strong>{{ $date }} </p></td>
					
				</tr>
				<tr>
					<td> <p style="padding-left: 10px; padding-top:0px; margin:0px; text-align: left;"><strong>Session:</strong> {{ $session->name }}</p></td>
					<td> <p style="padding-left: 10px; padding-top:0px; margin:0px; text-align: left;"><strong>Class:</strong> {{ $level->class_name }}</p></td>		
					<td> <p style="padding-left: 10px; padding-top:0px; margin:0px; text-align: left;"><strong>Section:</strong>{{ $section->section_name }}</p></td>
				</tr>

				<tr>
					<td> <p style="padding-left: 10px; padding-top:0px; margin:0px; text-align: left;"><strong style="padding-right: 10px;">Totall Student:</strong><span>{{ $count_all }}</span> </p></td>
					<td> <p style="padding-left: 10px; padding-top:0px; margin:0px; text-align: left;"><strong style="padding-right: 10px;">Present Student:</strong><span style="color: green;">{{ $count_present }}</span> </p></td>		
					<td> <p style="padding-left: 10px; padding-top:0px; margin:0px; text-align: left;"><strong style="padding-right: 10px;">Absent Student:</strong><span style="color: red;">{{ $count_absent }}</span>  </p></td>
				</tr>

				
			</tbody>
		</table>
	</div>
	<br>


	

   
   {{--  showing report for absent stuednt --}}
   @if($filter_type == 1)
   <div  style="display:flex; justify-content:center; text-align:center; width:100%;">
		<table >
			<tr style="text-align:center;">
				<th style="text-align:center;">List of the <span style="color: green;">Present</span> Students of Class {{ $level->class_name }}</th> 
			</tr>
		</table>
	</div>
   <table class="table">
        <tr>
            <th>Class Roll</th>
            <th>Name</th>
            <th>Attendance Status</th>
        </tr>
        @foreach($attendances as $attendance)
		
		
        <tr>        
            <td>{{ $attendance->section_student->roll }}</td>
            <td>{{ $attendance->section_student->student->name }}</td>
            <td><span style="padding-left: 10px; color: green;">Present</span></td>
        </tr>
        @endforeach
    </table>
    

    @endif


    {{--  showing report for present stuednt --}}
    @if($filter_type == 2)
	<div  style="display:flex; justify-content:center; text-align:center; width:100%;">
		<table >
			<tr style="text-align:center;">
				<th style="text-align:center;">List of the <span style="color: red;">Absent</span> Students of Class {{ $level->class_name }}</th> 
			</tr>
		</table>
	</div>
	
	
	<table >
        <tr>
            <th>Class Roll</th>
            <th>Name</th>
            <th>Attendance Status</th>
        </tr>
        @foreach($attendances as $attendance)
		
        <tr>        
            <td>{{ $attendance->section_student->roll }}</td>
            <td>{{ $attendance->section_student->student->name }}</td>
            <td><span style="padding-left: 10px; color: red;">Absent</span>
			</td>
        </tr>
        @endforeach
    </table>
        
    @endif

    {{--  showing report for present & absent stuednt --}}
    @if($filter_type == 3)
	<div >

	<!-- <div style="display:flex; justify-content:center; text-align:center">
		<marquee style="display:flex; justify-content:center; text-align:center" hight=50% width=50%  direction="left">
				List of the <span style="color: blue;">Present & Absent</span></td> Students of Class {{ $level->class_name }}
		</marquee>
	
	</div> -->
		
	<div  style="display:flex; justify-content:center; text-align:center; width:100%;">
		<table >
			<tr style="text-align:center;">
				<th style="text-align:center;">List of the <span style="color: blue;">Present & Absent</span> Students of Class {{ $level->class_name }}</th> 
			</tr>
		</table>
	</div>

	</div>
	
	<table>
        <tr>
            <th>Class Roll</th>
            <th>Name</th>
            <th>Attendance Status</th>
        </tr>
        @foreach($attendances as $attendance)
		
        <tr>        
            <td>{{ $attendance->section_student->roll }}</td>
            <td>{{ $attendance->section_student->student->name }}</td>
            <td>@if($attendance->status == 1) <span style="padding-left: 10px; color: green;">Present</span>
			@else <span style="padding-left: 10px; color: red;">Absent</span>
			@endif
			</td>
        </tr>
        @endforeach
    </table>
        
    @endif

    
</body>
</html>