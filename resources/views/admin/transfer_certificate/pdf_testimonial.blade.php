<!DOCTYPE html>
<html>
<head>
	<title>Testimonial</title>
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
                    
                        <img src="{{asset('site_logo')}}/{{$settings->site_logo}}" style=" height:90px;" alt=""/>
                  
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
		<!-- <div>
		<div style="float: left; width: 200px"><span>Number : </span><span style="font-weight: bold">201</span> </div>
		<span>Transfer Certificate</span>
		<div style="float: right;width: 130px"><span>Date : </span><span style="font-weight: bold">{{$today}}</span>  </div>
		</div> -->
		<table>
			<tbody>
				<tr>
					<td style="width: 50%;text-align: left"><span>Number : </span><span style="font-weight: bold">{{$testimonial_no}}</span></td>
					<!-- <td style="width: 40%;text-align: center"><span style="font-weight: bold; font-size: 16px"  >Testimonial</span></td> -->
					<td style="width: 50%;text-align: right"><span>Date : </span><span style="font-weight: bold">{{$today}}</span></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div style="text-align: center;">
		<h1>Testimonial</h1>
	</div>
	
	
	<br>
	
	<br>
	<div style="line-height: 2.5; letter-spacing: 1.5px ">
		<p style="font-size: 16px; "><span style="">That is going to  certify that </span>  <span style="font-weight: bold;text-decoration: underline;">{{$student_details->name}}  </span>  ID : </span>  <span style="font-weight: bold;text-decoration: underline;">{{$students->roll_no}}</span><span> Father : </span><span style="font-weight: bold;text-decoration: underline;">{{$student_details->fathers_name}}</span><span> Mother : </span><span style="font-weight: bold;text-decoration: underline;">{{$student_details->mothers_name}}</span><span> Village : </span><span style="font-weight: bold;text-decoration: underline;">{{$students->present->village}}</span> <span> P/O : </span><span style="font-weight: bold;text-decoration: underline;">{{$students->present->post_office}}</span> <span> Thana : </span><span style="font-weight: bold;text-decoration: underline;">{{$students->present->upazila}}</span>  <span> District : </span><span style="font-weight: bold;text-decoration: underline;">{{$students->present->district}}</span> <span> . He/She was the student of Class : </span><span style="font-weight: bold;text-decoration: underline;">{{$student_details->class_name}}</span> <span> in the year of : </span><span style="font-weight: bold;text-decoration: underline;">@php $year = date('Y'); @endphp {{$year}} </span> . <span> His/her class Roll : </span><span style="font-weight: bold;text-decoration: underline;">{{$student_details->roll}}</span> .<span> His/her date of birth : </span><span style="font-weight: bold;text-decoration: underline;">{{$students->date_of_birth}}</span> . </p>
		
	</div>
	<div style="font-size: 16px">
		<p>As far as I know, he is not involved in anti-state and extra-disciplinary activities .</p>
		<p>I wish his/her the best in life .</p>
	</div>
	<div style="margin-top: 25px;font-size: 16px">
		<table>
			<tbody >
				<tr >
					<td style="width: 50%;text-align: left;line-height: 2"><span> Office Assistant </span>
					</td>
					<td style="width: 50%;text-align: right;line-height: 2"><span>Headmaster </span></td>
				</tr>
				
			</tbody>
		</table>
		
	</div>


	
</body>
</html>















