<!DOCTYPE html>
<html>
<head>
	<title>Term Result</title>
	<style>
		/*.head_table td{
			border:none;
			padding-bottom: 0px;
			margin-top:0px;
		}*/
		/*.head_table{
			border: 1px dotted;
			margin:0;

		}*/
	/*	table, td, th {
			border: solid #4d4d4d;
			border-width: 0.01em; 
			padding: 3px;
		}*/
		table {
			border-collapse: collapse;
			width: 100%;
			
		}

		h2, h3, h4, h5{
			text-align: center;
			margin: 0px;
			padding:0px;
		}
	</style>
</head>
<body style="text-align: justify;">
	<div style="margin-bottom: 5px; width:100%; height:60px; text-align: center;">
		<div>
			@php
                $settings = \App\GeneralSetting::first();
                @endphp
             
                    @if($settings != null)
                    
                        <img src="{{asset('site_logo')}}/{{$settings->site_logo}}" style="height:90px;" alt=""/>
                  
                    @elseif($settings == null)
                     
                        <img src="{{asset('admin/img/demo_logo.png')}}" style="width:100px;height:90px;padding-left: 35px" alt=""/>
                    
                    @endif
		</div>
		<div style="">
			<h3 style="">{{$settings->site_name}}</h3>
			<address style="">
			{{ isset($student_details->section->level_enroll)?$student_details->section->level_enroll->branch->address: "Bongshirdia, Shibpur 1600 Narsingdi, Dhaka Division, Bangladesh" }}
			</address>
			<span style="">
				<b>Phone:</b> {{ isset($student_details->section->level_enroll)?$student_details->section->level_enroll->branch->contact_no: " " }}
			</span>
			<br>
			<span style="">
				<b>Email:</b> {{ isset($student_details->section->level_enroll)?$student_details->section->level_enroll->branch->email: " " }}
			</span>
			<br>
			<br>		
		</div>
	</div>
	<div>
		
		<table>
			<tbody>
				<tr>
					<td style="text-align: left"><span>EIIN : </span><span style="font-weight: bold">112858</span></td>
					<td style="text-align: center"><span>School Code : </span><span style="font-weight: bold">3316</span></td>
					<td style="text-align: center"><span>College Code : </span><span style="font-weight: bold">3155</span></td>
					<td style="text-align: center"><span>Upazila Code : </span><span style="font-weight: bold">165</span></td>
					<td style="text-align: center"><span>District Code : </span><span style="font-weight: bold">18</span></td>
					
				</tr>
			</tbody>
		</table>
	</div>
	<br>
	<div style=" width:100%; text-align: center;">
		<h2>Studentship Certificate</h2>
	</div>
	
	
	
	<br>
	<div style="line-height: 2.5; letter-spacing: 1.5px ">
		<p style="font-size: 16px; "><span style="">That is going to  certify that </span>  <span style="font-weight: bold;text-decoration: underline;">{{$student_details->name}}</span> <span> Father : </span><span style="font-weight: bold;text-decoration: underline;">{{$student_details->fathers_name}}</span><span> Mother : </span><span style="font-weight: bold;text-decoration: underline;">{{$student_details->mothers_name}}</span><span> Village : </span><span style="font-weight: bold;text-decoration: underline;">{{$students->present->village}}</span> <span> P/O : </span><span style="font-weight: bold;text-decoration: underline;">{{$students->present->post_office}}</span> <span> Thana : </span><span style="font-weight: bold;text-decoration: underline;">{{$students->present->upazila}}</span>  <span> District : </span><span style="font-weight: bold;text-decoration: underline;">{{$students->present->district}}</span> <span> Class : </span><span style="font-weight: bold;text-decoration: underline;">{{$student_details->class_name}}</span> <span> Roll : </span><span style="font-weight: bold;text-decoration: underline;">{{$student_details->roll }}</span> <span> Section : </span><span style="font-weight: bold;text-decoration: underline;">{{$student_details->section_name}}</span> <span> is a regular student of our instituion </span> .   </p>
		
	</div>
	<div style="font-size: 16px">
		<p>I wish his/her the best in life .</p>
		
	</div>
	<div style="float:right; margin-top: 25px; width: 250px">
		<div style="text-align: center; font-size: 16px">
        <p>(Md. Mazharul islam Juel)</p>
        <p>Principal</p>
        <p>{{$settings->site_name}}</p>
		</div>
		
	</div>

	
</body>
</html>