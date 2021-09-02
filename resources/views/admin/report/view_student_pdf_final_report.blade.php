<!DOCTYPE html>
<html>
<head>
	<title>Final Result</title>
	<style>
		table, td, th {
			border: solid #4d4d4d;
			border-width: 0.01em; 
			padding: 3px;
		}
		table {
			border-collapse: collapse;
			width: 100%;
			font-size: 9px;
		}
		.grade-table table{
			font-size: 8px;
		}

		h2, h3, h4, h5{
			text-align: center;
			margin: 0px;
			padding:0px;
		}
		h4{
			font-style: underline;
		}
		.tc{
			text-align: center;
		}
		.pd-tb-12{
			padding:10px 5px;
		}
		.head_table td{
			border:none;
			padding:3px;
			font-size: 12px;
		}
		.head_table{
			border: 1px dotted;
			margin:0;

		}
	</style>
</head>
<body>
	<div>
		<div>
			<div style="width:100%; height:60px;">
			    @php
                 $settings = \App\GeneralSetting::get('site_logo')->first();
				 $gs= \App\GeneralSetting::first();
                @endphp
                <div class="logo" style="float:left; width:10%">
                    @if($settings != null)
      
                        <img src="{{asset('site_logo')}}/{{$settings->site_logo}}" style="height:70px;" alt=""/>

                    @elseif($settings == null)

                        <img src="{{asset('admin/img/demo_logo.png')}}" style="height:70px;" alt=""/>

                    @endif
                </div>
				<!-- <div class="logo" style="float:left; width:10%">
					 <img src="{{asset('admin')}}/img/favicon-final.png" style="width:80px;height:70px;"/>
				</div> -->
				<div style="float:left; width:84%; text-align: center;">
					<h3 style="margin:0px; padding:0px; font-size: 20px;">{{ $gs->site_name }}</h3>
					<address style="margin:0px; padding:0px">{{$section_student->section->level_enroll->branch->address}}</address>
					<span style="margin:0px; padding:0px"><b>Phone:</b> {{ $section_student->section->level_enroll->branch->contact_no }}    <b>Email:</b> {{ $section_student->section->level_enroll->branch->email }}</span>
					<h4 class="tc" style="font-size: 16px;">Final Result Sheet</h4>
				</div>
			</div>

		</div>
		<br>
		<div style="margin-bottom:10px;">
			<div style="float:left; width:50%;">	
				<table class="head_table">
					<tr>
						<td style="border-right:1px dotted;"><b>Name:</b> {{$section_student->student->name}}</td>
						<td style="border-right:1px dotted;"><b>Class:</b> {{$section_student->section->level_enroll->level->class_name}}</td>
						<td style="border-right:1px dotted;"><b>Session:</b> {{$section_student->section->level_enroll->session->name}}</td>
					</tr>
					<tr>
						<td style="border-right:1px dotted;"><b>Section:</b> {{$section_student->section->section_name}}</td>
						<td style="border-right:1px dotted;"><b>Class Roll:</b> {{$section_student->roll}}</td>
						<td style="border-right:1px dotted;"><b>Shift:</b> {{$section_student->section->level_enroll->shift->shift_name}}</td>
					</tr>
				</table>
			</div>
			<div style="float:left; width:45%; margin-left:5%;" class="grade-table">
				@include('layouts.grade_pdf')
			</div>
		</div>
	</div>
	<table border="1" style="border-collapse: collapse; width: 100%;">
		<thead>
			<tr>
				<th style="font-size: 12px; width: 180px;" rowspan="2">Subjects</th>
	            @foreach ($terms as $term)
	           		<th style="font-size: 12px" colspan="4">{{$term->term->term_name}}</th>
	            @endforeach
	            <th style="font-size: 12px" colspan="4">Final result</th>
			</tr>
			<tr>
				@php
					$count_terms = count($terms);
				@endphp

				@for ($i = 0; $i < $count_terms; $i++)
					<!-- <th class="tc">WT</th> -->
					<th class="tc">Marks</th>
					<th class="tc">Total</th>
					<th class="tc" >Point</th>
					<th class="tc">Letter Grade</th>
				@endfor

				<th class="tc" width="50">Final total No</th>
				<th class="tc" width="20">Average No</th>
				<th class="tc" width="15">Letter Grade</th>
				<th class="tc">Point</th>
			</tr>
		</thead>
		<tbody>
		 	<?php 
		 		$term_array = [];
		 		$grand_total = 0; 
		 		$grand_failed = 0; 
		 	?>
			@foreach ($final_reports as $subject_result)
				<tr>
		 		<?php 
		 			$first_term = 0;
		 			$total = 0;
		 			foreach ($terms as $term){
		 				$first_term++;
			 			$section_subject_teacher_id = $subject_result->section_subject_teacher_id;
		 				$term_result = $subject_result->section_subject_teacher->term_result->where('section_student_id', $section_student->id)->where('term_id', $term->term->id)->where('section_subject_teacher_id', $section_subject_teacher_id)->first();
		 		?>
		 				@if($term_result)
			 				@if ($first_term < 2)
								<td {{((strlen($subject_result->section_subject_teacher->subject->subject_name)>30)?'style=font-size:8px;':'')}}>
									{{$subject_result->section_subject_teacher->subject->subject_name}}
								</td>
			 				@endif
							<!-- <td class="tc">{{$term_result->weekly_avg}}</td> -->
							<td class="tc">{{$term_result->term_marks}}</td>
							@php
								$total += $term_result->total_marks;
							@endphp
							<td class="tc">{{$term_result->total_marks}}</td>
							<td class="tc">{{$term_marks = grade_calculation($term_result->total_marks,'point')}}</td>
							<td class="tc">{{grade_calculation($term_result->total_marks,'grade')}}</td>
							<?php
								if(!isset($term_array[$term->term_id])){
									$term_array[$term->term_id] = [
										'val' => 0,
										'failed' => 0,
										'name' => $term->term->term_name,
									];
								}
								if($term_marks == 0){
									$term_array[$term->term_id]['failed'] = 1;
								}
								$term_array[$term->term_id]['val'] += grade_calculation($term_result->total_marks,'point');
							?>
						@else
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						@endif

					<?php } ?>

					<td class="tc">{{$total}}</td>

					<td class="tc">{{$subject_result->subject_marks}}</td>
					<td class="tc">{{grade_calculation($subject_result->subject_marks,'grade')}}</td>
					<td class="tc">{{$point = grade_calculation($subject_result->subject_marks,'point')}}</td>
					@php
						if($point == 0){
							$grand_failed = 1;
						}
						$grand_total+= $point;
					@endphp
				</tr>	
			@endforeach
		</tbody>
	</table>
	
	<br>
	<table border="1" style="border-collapse: collapse; width: 100%; margin-top:0px; font-size: 9px;">
		<tr>
			<th>Terms</th>
			<th>Class Teacher Comments</th>
			<th>GPA</th>
			<th>Grade</th>
			<th>Class Teacher Signature</th>
			<th>Headmaster Signature</th>
			<th>Guardian Signature</th>
		</tr>
		@foreach ($term_array as $term)
			<tr>
				<td style="width:150px; padding:5px 4px;">{{$term['name']}}</td>
				<td class="tc" style="padding:5px 4px;"></td>
					<td class="tc" style="width:50px; padding:5px 4px;">{{$term_gpa = round(($term['val']/count($final_reports)),2)}}</td>
				@if ($term['failed'] == 0)
					<td class="tc" style="width:50px; padding:5px 4px;">{{cgpa_calculation($term_gpa)}}</td>
				@else
					<td class="tc" style="width:50px; padding:5px 4px;">F</td>
				@endif
				<td class="tc" style="width:150px; padding:5px 4px;"></td>
				<td class="tc" style="width:150px; padding:5px 4px;"></td>
				<td class="tc" style="width:150px; padding:5px 4px;"></td>
			</tr>
		@endforeach
	</table>
	
	<div style="float:left; width:50%">
		<table border="1" style="border-collapse: collapse; width: 100%; margin-top:20px;">
			<thead>
				<tr>
		     	 	<td colspan="{{count($terms)+1}}" style="text-align: center; font-size: 14px; font-style: italic;"><b>Teacher Feedback</b></td>
		    	</tr>
				<tr>
					<td></td>
					@foreach ($terms as $term)
				     	<td><b>{{$term->term->term_name}} Exam</b></td>
					@endforeach
			    </tr>
			</thead>
			<tbody>
				@php
					$side_menu = [ 'Total Students','Number of Candidates','Total School Days','Number of Absents','Religious Activity','School Activity','Behavior Status'];
				@endphp
				@foreach ($side_menu as $value)
			    	<tr>
						<td style="font-size: 11px;">{{$value}}</td>
			    		@foreach ($terms as $term)
							<td></td>
			    		@endforeach
					</tr>
				@endforeach
			</tbody>   
		 </table>
	</div>
	<div style="float:left; width:40%; margin-left: 10%;">
		<table border="1" style="border-collapse: collapse; width: 100%; margin-top:20px; font-size: 12px;">
			<thead>
				<tr>
					<td colspan="3" style="text-align: center; font-size: 14px; font-style: italic;"><b>Final Evaluation</b></td>
				</tr>
				<tr>
					<td style="padding: 8px 5px;" width="150px"><b>Result</b></td>
					<td style="padding: 8px 5px;" class="tc" ><b>GPA</b></td>
					<td style="padding: 8px 5px;" class="tc" ><b>Grade</b></td>
				</tr>
				@php
					$grand_point = round($grand_total /count($final_reports),2);
					$grade = cgpa_calculation($grand_point);
					$grade = (($grand_failed == 1)?"F":$grade);
				@endphp
				<tr>
					<td class="pd-tb-12">Passed</td>
					<td class="tc pd-tb-12">{{($grade != 'F')?$grand_point:""}}</td>
					<td class="tc pd-tb-12">{{($grade != 'F')?$grade:""}}</td>
				</tr>
				<tr>
					<td class="pd-tb-12">Special Consideration</td>
					<td class="tc pd-tb-12"></td>
					<td class="tc pd-tb-12"></td>
				</tr>
				<tr>
					<td class="pd-tb-12">Failed</td>
					<td class="tc pd-tb-12">{{($grade == 'F')?$grand_point:""}}</td>
					<td class="tc pd-tb-12">{{($grade == 'F')?$grade:""}}</td>
				</tr>
			</thead>   
		</table>
	</div>

</body>
</html>