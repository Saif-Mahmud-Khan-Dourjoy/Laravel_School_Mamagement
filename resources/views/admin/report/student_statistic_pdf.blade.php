<!DOCTYPE html>
<html>
<head>
	<title>Transfer Certificate</title>
	<style>
		
		table, td, th {
			border: solid #4d4d4d;
			border-width: 0.01em; 
			padding: 3px;
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
		.top-section{
			height:4cm;
		}
		.data-section{
			text-align: center;
		}
		.text-left{
			text-align: left;
		}
		.text-right{
			text-align: right;
		}
		table{
			margin-top: 5px;
		}
	</style>
</head>
<body style="text-align: justify;">
	<div style="width:100%; height:60px; text-align: center;" class="top-section pb-4">
		<div>
			@php
                $settings = \App\GeneralSetting::first();
                @endphp
             
                    @if($settings != null)
                    
                        <img src="{{asset('site_logo')}}/{{$settings->site_logo}}" style=" width:100px;height:90px;" alt=""/>
                  
                    @elseif($settings == null)
                     
                        <img src="{{asset('admin/img/demo_logo.png')}}" style="width:100px;height:90px;padding-left: 35px" alt=""/>
                    
                    @endif
		</div>
		<div style="">
			<h3 style="">{{$settings->site_name}}</h3>
			<address style="">{{ isset($settings->address_1)?$settings->address_1 : " Bongshirdia, Shibpur 1600 Narsingdi, Dhaka Division, Bangladesh" }}</address>
			<span style="">
				<b>Phone:</b> {{ isset($settings->phone_1)?$settings->phone_1: " " }}
			</span>
			<br>
			<span style="">
				<b>Email:</b> {{ isset($settings->email_1)?$settings->email_1: " " }}
			</span>
				
		</div>
	</div>
	<div style="text-align: center" class="data-section">
	

		@php
		 	$level_enrolls=\App\LevelEnroll::where('session_id',$session->id)->get();	
			$total_students = 0;
			$total_muslim_students = 0;
			$total_hindu_students = 0;
			$total_other_students = 0;
		@endphp

        <table >
			<tr>
				<th colspan="14">Session : {{ $session->name }}</th>
			</tr>
        	<tr>
        		<th rowspan="2">Class</th>
        		<th rowspan="2">Section</th>
        		<th colspan="4">Male</th>
        		<th colspan="4">Female</th>
        		<th colspan="4">Total</th>	
        	</tr>
        	<tr>
        		<th>Islam</th>
				<th>Hindu</th>
        		<th>Other</th>
        		<th>Total</th>
        		<th>Islam</th>
				<th>Hindu</th>
        		<th>Other</th>
        		<th>Total</th>
        		<th>Islam</th>
				<th>Hindu</th>
        		<th>Other</th>
        		<th>Total</th>	
        	</tr>
			@foreach($level_enrolls as $level_enroll)
					
				@foreach($level_enroll->section as $section)
				<tr>
					
				
					<td  class="text-left">
						{{ $level_enroll->level->class_name }}
					</td>
					
				
					<td class="text-left">
						{{ $section->section_name }}
					</td>
						@php 
							$student_ids = \App\SectionStudent::where('section_id', $section->id)->pluck('student_id')->toArray();
							
							$count_male_islam1 = \App\Student::whereIn('id', $student_ids)
							->where('gender', '=', "Male")
							->where('religion', "Islam")
							->count();
							$count_male_islam2 = \App\Student::whereIn('id', $student_ids)
							->where('gender', '=', "Male")
							->where('religion', "Muslim")
							->count();
							$count_male_muslim = $count_male_islam1  + $count_male_islam2;


							$count_male_hindu = \App\Student::whereIn('id', $student_ids)
							->where('gender', '=', "Male")
							->where('religion', "Hindu")
							->count();

							$count_male_total = \App\Student::whereIn('id', $student_ids)
							->where('gender', '=', "Male")->count();
							$count_male_other = $count_male_total - $count_male_muslim - $count_male_hindu;
						@endphp
					<td>
						
						{{ $count_male_muslim }}
					</td>
					<td>
						@php
							
						@endphp
						{{ $count_male_hindu }}
					</td>
					<td>
						@php
						    
						@endphp

						{{ $count_male_other }}
					</td>
					<td>
						{{ $count_male_total }}
					</td>
						@php 
							$student_ids = \App\SectionStudent::where('section_id', $section->id)->pluck('student_id')->toArray();
							
							$count_female_islam1 = \App\Student::whereIn('id', $student_ids)
							->where('gender', '=', "female")
							->where('religion', "Islam")
							->count();
							$count_female_islam2 = \App\Student::whereIn('id', $student_ids)
							->where('gender', '=', "female")
							->where('religion', "Muslim")
							->count();
							$count_female_muslim = $count_female_islam1  + $count_female_islam2;


							$count_female_hindu = \App\Student::whereIn('id', $student_ids)
							->where('gender', '=', "female")
							->where('religion', "Hindu")
							->count();

							$count_female_total = \App\Student::whereIn('id', $student_ids)
							->where('gender', '=', "female")->count();
							$count_female_other = $count_female_total - $count_female_muslim - $count_female_hindu;
						@endphp
					<td>
						{{ $count_female_muslim }}
					</td>
					<td>
						{{ $count_female_hindu }}
					</td>
					<td>
						{{ $count_female_other }}
					</td>
					<td>
						{{ $count_female_total }}
					</td>

					@php
						$total_muslim = $count_male_muslim + $count_female_muslim;
						$total_hindu = $count_male_hindu + $count_female_hindu;
						$total_other = $count_female_other + $count_male_other;
						$section_students = \App\SectionStudent::where('section_id', $section->id)->count();
						
						$total_students = $total_students + $section_students;
						$total_muslim_students = $total_muslim_students + $total_muslim;
						$total_hindu_students = $total_hindu_students + $total_hindu;
						$total_other_students = $total_other_students + $total_other;
					@endphp
					<td>
						{{ $total_muslim }}
					</td>
					<td>
						{{ $total_hindu }}
					</td>
					<td>
						{{ $total_other }}
					</td>
					<td>
						{{ $section_students }}
					</td>
				</tr>
				@endforeach
				
			@endforeach
			@php
				
			@endphp
			<tr>
				<th class="text-right" colspan="10">Total= </th>
				
				<th >{{$total_muslim_students}}</th>
				<th >{{$total_hindu_students}}</th>
				<th >{{$total_other_students}}</th>
				<th >{{$total_students}}</th>
			</tr>

        </table>


		
	</div>
	
	<br>


</body>
</html>