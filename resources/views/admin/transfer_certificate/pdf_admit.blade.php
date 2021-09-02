<!DOCTYPE html>
<html>
<head>
	<title>Admit Card</title>
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
			table tr td{
				font-size: 17px;
			}
			table {
				border-collapse: collapse;
				width: 100%;

			}

			h2, h3, h4, h5{
				text-align: center;
				margin: 0px;
				padding:0px;
			}
			/*.name_div{
				display: flex;
				flex-direction: row;
			}*/
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

				<img src="{{asset('admin/img/demo_logo.png')}}" style="height:90px;padding-left: 35px" alt=""/>

				@endif
			</div>
			<div style="">
				<h3 style="">{{ $settings->site_name }}</h3>
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
		
		<div style="text-align: center;">
			<p style="text-align: center;">{{ $term_info->term_name }}</p>

		</div>
			
		<br>
		<div style="text-align: center">
			<h2>Admit Card</h2>
		</div>

		<br>
	
	<div  style="font-size: 18px; width: 100%;">
		<div style="width: 25%;float:left">
			Student Name :
		</div>
		<div style="width: 75%;font-weight:bold;text-decoration:underline; text-transform: capitalize;float:left">
			{{$student_details->name}}
		</div>
		
	</div>
<!-- 
	<table style="width:100%">
		<tr  style="font-size: 18px; ">
			<td>Class :</td>
			<td style="font-weight: bold;text-decoration: underline;">{{$student_details->class_name}}</td>
			<td>Section :</td>
			<td style="font-weight: bold;text-decoration: underline;">{{$student_details->section_name}}</td>
			<td>Roll :</td>
			<td style="font-weight: bold;text-decoration: underline;">{{$student_details->roll}}</td>
		</tr>
		
	</table> -->
	<div  style="font-size: 18px; width: 100%; margin-top: 15px;"> 
		<div style="width: 40%;float:left">
			<div style="width: 30%;float:left">
				Class :
			</div>
			<div style="width: 70%;float:left;font-weight:bold;text-decoration:underline; text-transform: capitalize">
				{{$student_details->class_name}}
			</div>
		</div>
		<div style="width: 34%;float:left">
			<div style="width: 50%;float:left">
				Section :
			</div>
			<div style="width: 50%;float:left;font-weight:bold;text-decoration:underline; text-transform: capitalize">
				{{$student_details->section_name}}
			</div>
		</div>
		<div style="width: 26%;float:left">
			<div style="width: 50%;float:left">
				Roll :
			</div>
			<div style="width: 50%;float:left;font-weight:bold;text-decoration:underline; text-transform: capitalize">
				{{$student_details->roll}}
			</div>
			
		</div>
		
	</div>

	
	<div style="line-height: 2.5; letter-spacing: 1.5px; font-size: 18px ">
		<p>Exam start Date : <span>{{ $exam_start_date }}</span></p>
	</div>
	<br>
	<div style="margin-top: 25px">
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
