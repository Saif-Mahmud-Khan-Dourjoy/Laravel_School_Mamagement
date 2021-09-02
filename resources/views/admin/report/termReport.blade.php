<!DOCTYPE html>
<html>
<head>
	<title>Term Result</title>
	<style>
		.head_table td{
			border:none;
			padding-bottom: 0px;
			margin-top:0px;
		}
		.head_table{
			border: 1px dotted;
			margin:0;

		}
		.title-part{
			height: 4cm;
		}
		table, td, th {
			border: solid #4d4d4d;
			border-width: 0.01em; 
			padding: 1px;
		}
		table {
			border-collapse: collapse;
			width: 100%;
			font-size: 12px;
		}

		h2, h3, h4, h5{
			text-align: center;
			margin: 0px;
			padding:0px;
		}
		p{
			margin: 0 auto;
			padding:0px;
		}
		.table-sub{
			border:none;
		}
		.table-sub td{
			border:none;
			text-align: left;
		}
		.td-top{
			width:70%;
		}

	</style>
</head>
<body>

				<?php
                    $section_student_id = $term_results->first()->section_student_id;
                    $section_student = \App\SectionStudent::find($section_student_id);
                    $student = \App\Student::find($section_student->student_id);
                    $term = \App\Term::find($term_results->first()->term_id);
                    $section = \App\Section::find($section_student->section_id);
                    $level_enroll = \App\LevelEnroll::find($section->level_enroll_id);
                    $level = \App\Level::find($level_enroll->level_id);
                    $session = \App\Session::find($level_enroll->session_id);
					$site =  \App\GeneralSetting::first();

                ?>

	<div class="row title-part" style="text-align: center; ">
		<div style=" margin-bottom: 20px; width:100%; height:60px; text-align: center; ">
			<!-- <div class="logo" style="float:left; width:15%; position: absolute; text-align: left;">
				<img src="{{asset('admin')}}/img/favicon-final.png" style="width:80px;height:70px;"/>
			</div> -->
			<div style="text-align: center;">
				<h3 style="margin:0px; padding:0px; font-size: 22px;">{{ isset($site->site_name)? $site->site_name: "Gulesta Hafiz Memorial Institute(School and College)" }}</h3>
				<address style="margin:0px; padding:0px">
				{{ isset($section_student->section->level_enroll)?$section_student->section->level_enroll->branch->address: " " }}
				</address>
				<span style="margin:0px; padding:0px">
					<b>Phone:</b> {{ isset($section_student->section->level_enroll)?$section_student->section->level_enroll->branch->contact_no: " " }}
				</span>
				<br>
				<span style="margin:0px; padding:0px">
					<b>Email:</b> {{ isset($section_student->section->level_enroll)?$section_student->section->level_enroll->branch->email: " " }}
				</span>
				<br>
				<br>
				<span style="margin:0px; padding: 10px; font-size: 17px;">
					<b>{{$term->term_name}} Result</b>
				</span>
			</div>
		</div>
	<br>

	<div class="row">
		<div style="width:40%; float: left;">
		<table>
			<thead>
			<tr>
				<td colspan="2" style="border:none solid #000;  margin:0px;"><b>Student Name:</b> {{$section_student->student->name}}</td>
			</tr>
			<tr>
				<td style="border:none solid #000; margin:0px;"><b>Class: </b>{{$section_student->section->level_enroll->level->class_name}} <i><b>Roll no:</b> {{$section_student->roll}}</i></td>	
			</tr>
		</thead>
		</table>
		</div>
		<div style="width:30%;  float: right;">
		<table>
			<thead>
			<tr>
				<td style="border:none solid #000; margin:0px; text-align: left;"><b>Session: </b>{{$section_student->section->level_enroll->session->name}} </td>
			</tr>
			<tr>
				<td style="border:none solid #000; margin:0px; text-align: left;"><b>Section: </b>{{$section_student->section->section_name}}, <b>ID: </b>{{$section_student->student->roll_no}}</td>
			</tr>
		</thead>
		</table>
		</div>
	</div>

	<!-- <div>
		@include('layouts.grade_pdf')
	</div> -->
<br>
	<table border="1" style="border-collapse: collapse; width: 100%; font-size: 12px;">
		<thead>
			<tr>
				<th style="text-align: left;">Subject</th>
				<th style="text-align: center;">Pass Mark</th>
				<th style="text-align: center;">Marks Distribution</th>
	            <th style="text-align: center;">Term Mark</th>
	            <th style="text-align: center;">Letter Grade</th>
	            <th style="text-align: center;">Point</th>
				<th style="text-align: center;">Highest Mark</th>
			</tr>
		</thead>
		<tbody>
			@php
				$failed = 0;
				$total = 0;
				$i = 0;
			@endphp
			@foreach($term_results as $term_result)
                <?php
               	 	$section_subject_teacher = \App\SectionSubjectTeacher::find($term_result->section_subject_teacher_id);
                	$subject = \App\Subject::find($section_subject_teacher->subject_id);
					$hight_marks = \App\TermResult::where('section_subject_teacher_id',  $section_subject_teacher->id)
                                                                        ->where('term_id',  $term->id)->orderBy('term_marks', 'desc')->first();
                  ?>

                <tr>
                    <td style="text-align: left;">
                        {{$subject->subject_name}}
                    </td>
		
                    <td style="text-align: center;">
                        {{$term_result->section_subject_teacher->student_subject_term_mark->pass_mark}}
                    </td> 

					<td style="text-align: center;">
					<table class="table-sub">
					    
						<?php if($term_result->section_subject_teacher->section_subject_distribution->written_permission=="Yes"){     ?>
							<tr>
								<td class="td-top">
									<p>Written</p>  
								</td>
								<td>
									<p>{{ $term_result->term_result_distribution->written_mark }}</p>  
								</td>
							</tr>
						<?php } ?>
						<?php if($term_result->section_subject_teacher->section_subject_distribution->mcq_permission=="Yes"){       ?>
							<tr>
								<td class="td-top">
									<p>MCQ</p>  
								</td>
								<td>
									<p>{{ $term_result->term_result_distribution->mcq_mark }}</p>
								</td>
							</tr>
						<?php } ?>
						<?php if($term_result->section_subject_teacher->section_subject_distribution->pactical_permission=="Yes"){     ?>
							<tr>
								<td class="td-top">
									<p>Practical</p>  
								</td>
								<td>
									<p>{{ $term_result->term_result_distribution->pactical_mark }}</p>
								</td>
							</tr>
						<?php } ?>
							
						
					</table>
						
					

                    </td>

                    <td style="text-align: center;">
                        {{$term_result->total_marks}}
                    </td>

                	<?php
                		$point = grade_calculation($term_result->total_marks,'point'); 
                		$grade = grade_calculation($term_result->total_marks);
                		$total += $point;
                		$i++;
                		if($grade === 'F')
                			$failed++;
                	?>
                    <td style="text-align: center;">{{$grade}}</td>

                    <td style="text-align: center;">{{$point}}</td>

					<td style="text-align: center;">
						{{ $hight_marks->term_marks }}
                    </td>

                </tr>
				
            @endforeach
		</tbody>
	</table>


	<table border="1" style="border-collapse: collapse; width: 100%; margin-top:20px;">
		<thead>
			<tr>
				<th style="text-align: center;">GPA</th>
				<th style="text-align: center;">Grade</th>
				<th style="text-align: center;">Class Teacher Comments</th>
				<th style="text-align: center;">Class Teacher Signature</th>
				<th style="text-align: center;">Headmaster Signature</th>
				<th style="text-align: center;">Guardian Signature</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style="text-align: center;">{{$term_gpa = round(($total/$i),2)}}</td>
				@if ($failed)
					<td style="text-align: center;">{{ "F" }}</td>
				@else
					<td style="text-align: center;">{{ cgpa_calculation($term_gpa) }}</td>
				@endif
				<td style="width:130px; padding:20px 4px; text-align: center;"></td>
				<td style="width:130px; padding:20px 4px; text-align: center;"></td>
				<td style="width:130px; padding:20px 4px; text-align: center;"></td>
				<td style="width:130px; padding:20px 4px; text-align: center;"></td>
			</tr>
		</tbody>
	</table>
	<table border="1" style="border-collapse: collapse; width: 100%; margin-top:20px;">
		<thead>
			<tr>
	     	 	<td colspan="8" style="text-align: center; font-size: 14px; font-style: italic;"><b>Teacher Feedback</b></td>
	    	</tr>
	    	<tr>
	     	 	<td style="width: 160;"></td>
				<td style="text-align: center; font-size: 11px;"><b>Total Students</b></td>
				<td style="text-align: center; font-size: 11px;"><b>Number of Candidates</b></td>
				<td style="text-align: center; font-size: 11px; width: 80;"><b>Total School Days</b></td>
				<td style="text-align: center; font-size: 11px;"><b>Number of Absents</b></td>
				<td style="text-align: center; font-size: 11px;"><b>Religious Activity</b></td>
		      	<td style="text-align: center; font-size: 11px;"><b>School Activity</b></td>
				<td style="text-align: center; font-size: 11px;"><b>Behavior Status</b></td>
	    	</tr>
		</thead>
		<tbody>
			<tr>
	     	 	<td style="width: 160;"><b>{{$term->term_name}} Exam</b></td>
				<td style="padding: 12px 5px"></td>
				<td style="padding: 12px 5px"></td>
				<td style="padding: 12px 5px"></td>
				<td style="padding: 12px 5px"></td>
				<td style="padding: 12px 5px"></td>
				<td style="padding: 12px 5px"></td>
				<td style="padding: 12px 5px"></td>
		    </tr>
		</tbody>   
	 </table>
</body>
</html>