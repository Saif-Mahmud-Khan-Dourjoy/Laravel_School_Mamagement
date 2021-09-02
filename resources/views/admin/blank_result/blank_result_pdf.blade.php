<!DOCTYPE html>
<html>
<head>
	<title>Blank Result</title>
	<style type="text/css">
td {
	padding: 1px;
	font-size: 18px;
}
th {
  border: 1px solid black;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2;}
tr{
    border: 1px solid black;
}

td{
    padding: 8px;
	border: 1px solid black;
}
table{
	border: 1px solid black;
    
}


th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
h3, h4, p{
	margin: 0 auto;
	padding: 0px;
}
	</style>
</head>
<body>
	<div class="row" style="height: 3cm;">
	@php
	$settings = \App\GeneralSetting::first();
	@endphp
    <div style="text-center ">
			<h3 style="margin:0px; padding:0px; font-size: 22px; text-align: center;">{{ $settings->site_name }}</h3>
			<h4 style="text-center; text-align: center; ">Term: {{ $term->term_name }}</h4>
			<p style="text-center; text-align: center; ">Subject: {{ $section_subject_teacher->subject->subject_name}}, Subject Teacher: {{$section_subject_teacher->teacher->teacher_name}}</p>
			<p style="text-center; text-align: center; ">Session: {{ $session->name}}, Class: {{ $level->class_name}}, Section: {{$section->section_name}}</p>
		</div>
	</div>

	<div class="row" float="center">
		<table style="border: 1px solid #ddd; width: 100%; padding: 0px;" >

				<tr>
					<th style="text-align: center;  width: 10%">ID</th>
					<th style="text-align: center;  width: 10%">Roll</th>
					<th style="text-align: center;  width: 20%;">Name</th>
					@if($section_subject_teacher->section_subject_distribution->written_permission=="Yes")
					<th style="text-align: center;  width: 20%;">Written Mark</th>
					@endif
					@if($section_subject_teacher->section_subject_distribution->mcq_permission=="Yes")
					<th style="text-align: center;  width: 20%;">MCQ Mark</th>
					@endif
					@if($section_subject_teacher->section_subject_distribution->pactical_permission=="Yes")
					<th style="text-align: center;  width: 20%;">Pactical Mark</th>
					@endif
					<th style="text-align: center;  width: 20%;">Total Mark</th>
					
				</tr>
   

            @foreach($students as $student)

				<tr>
					<td style="text-align: left;">{{$student->student->roll_no}}</td>
					<td style="text-align: center;">{{ $student->roll }}</td>
					<td style="text-align: left;">{{$student->student->name}}</td>
					@if($section_subject_teacher->section_subject_distribution->written_permission=="Yes")
						<td style="text-align: center;"></td>
					@endif
					@if($section_subject_teacher->section_subject_distribution->mcq_permission=="Yes")
						<td style="text-align: center;"></td>
					@endif
					@if($section_subject_teacher->section_subject_distribution->pactical_permission=="Yes")
						<td style="text-align: center;"></td>
					@endif
					<td style="text-align: center;"></td>

				</tr>

			@endforeach
		
		</table>
	</div>
	<br>
	<br>
	<br>
	<div style="text-rightr; text-align: right; ">
		<p>___________________________</p>
		<p>Subject Teacher Signature</p>
	</div>


</body>
</html>