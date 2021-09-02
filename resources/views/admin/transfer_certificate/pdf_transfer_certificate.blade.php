<!DOCTYPE html>
<html>
<head>
	<title>Transfer Certificate</title>
	<style>
		
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
	<div style="margin-bottom: 5px; width:100%;text-align: center;">
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
					<td style="width: 30%;text-align: left"><span>Number : </span><span style="font-weight: bold">{{$transfer_certificate_no}}</span></td>
					<td style="width: 40%;text-align: center"><span style="font-weight: bold; font-size: 20px"  >Transfer Certificate</span></td>
					<td style="width: 30%;text-align: right"><span>Date : </span><span style="font-weight: bold">{{$today}}</span></td>
				</tr>
			</tbody>
		</table>
	</div>
	
	<br>
	
	<br>
	<div style="line-height: 2.5; letter-spacing: 1.5px ">
		<p style="font-size: 16px; "><span style="">That is going to  certify that the student Name : <span style="font-weight: bold;text-decoration: underline;">{{$students->name}}</span> of Roll : </span> <span style="font-weight: bold;text-decoration: underline;">{{$students->roll_no}}</span><span> Father : </span><span style="font-weight: bold;text-decoration: underline;">{{$student_details->fathers_name}}</span><span> Mother : </span><span style="font-weight: bold;text-decoration: underline;">{{$student_details->mothers_name}}</span>
			<span> Village : </span><span style="font-weight: bold;text-decoration: underline;">{{isset($students->present->village)?$students->present->village:''}}</span> <span> P/O : </span><span style="font-weight: bold;text-decoration: underline;">{{isset($students->present->post_office)?$students->present->post_office:''}}</span> <span> Thana : </span><span style="font-weight: bold;text-decoration: underline;">{{isset($students->present->upazila)?$students->present->upazila:''}}</span>  <span> District : </span><span style="font-weight: bold;text-decoration: underline;">{{isset($students->present->district)?$students->present->district:''}}</span> <span> He/She has studied in Class : </span><span style="font-weight: bold;text-decoration: underline;">{{$student_details->class_name}}</span> <span> in the year of : </span><span style="font-weight: bold;text-decoration: underline;">@php $year = date('Y'); @endphp {{$year}}</span>. <span> He/She has <span>{{ $result }}</span> the last annual examination</span>.<span> His/her date of birth : </span><span style="font-weight: bold;text-decoration: underline;">{{$students->date_of_birth}}</span>. <span> He/she has completed his/her payment till : </span><span style="font-weight: bold;">{{isset($collected_fees->collection_date)? $collected_fees->collection_date:"___________"}}</span>.</p>
		
	</div>
	<div >
		<table>
			<tbody >
				<tr >
					<td style="width: 50%;text-align: left;line-height: 2"><span> Character and Manner : </span><span style="font-weight: bold">{{ $character }}</span></td>
					<td style="width: 50%;text-align: right;line-height: 2"><span>Leaving reason : </span></td>
				</tr>
				<tr>
					<td style="width: 50%;text-align: left;line-height: 2"><span> Lesson development : </span><span style="font-weight: bold">{{ $lesson }}</span></td>
					<td style="width: 50%;text-align: right;line-height: 2"><span style="font-weight: bold"> {{ $transfer_reason }} </span></td>
				</tr>
				
			</tbody>
		</table>
		
	</div>
	<br>

	<div style="text-align: right; margin-top: 50px">
		<p style="font-weight: bold">_______________________</p>

		<p>Headmaster Signature</p>
		
	</div>

	
</body>
</html>
