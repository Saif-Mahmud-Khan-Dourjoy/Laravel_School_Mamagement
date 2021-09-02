<!DOCTYPE html>
<html>
<head>
	<title>Weekly Test Result</title>
</head>
<body>
	<div class="row">
		<div class="logo" style="float:left; width:15%; position: absolute; text-align: left;">
			<img src="{{asset('admin')}}/img/favicon-final.png" style="width:80px;height:70px;"/>
		</div>
		<div style="float:left; width:70%; ">
			<h3 style="margin:0px; padding:0px; font-size: 22px; text-align: center;">GRACE SCHOOL</h3>
			<address style="margin:0px; padding:0px; text-align: center">
				{{$ssr_result->section_subject_teacher->section->level_enroll->branch->address}}
			</address>
			<p style="text-align: center; font-size: 12px;"><b>Contact No:</b> {{$ssr_result->section_subject_teacher->section->level_enroll->branch->contact_no}}</p>
			<br>
		</div>
	</div>
	<div class="row" style="padding-top: 0px;">
		<p style="text-align: center; font-size: 15px;"><b>Weekly Test Result</b></p>
		<p style="text-align: center; font-size: 13px;"><b>Subject:</b>  {{$student_subject_results[0]->section_subject_teacher->subject->subject_name}}  <b>Test No:</b> {{$weekly_test_number}}  <b>Term:</b>{{$term->term_name}}</p>
	</div>
	<div class="row" float="center">
		<table border=1 style="border-collapse: collapse;
			font-size: 13px; width: 100%;">
			<thead>
				<tr>
					<td colspan="4" style="text-align: center;"><i>Weekly Test Result of {{ $student_subject_results[0]->section_subject_teacher->subject->subject_name }} ( <b>Test No:</b> {{$weekly_test_number}} )</i></td>
				</tr>
				<tr style="padding: 5px;">
					<th style="text-align: center; font-size: 13px;">SL</th>
					<th style="text-align: left; font-size: 13px;">Student Name</th>
					<th style="text-align: center; font-size: 13px;">Total Number</th>
					<th style="text-align: center; font-size: 13px;">Mark</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; ?>
				@foreach($student_subject_results as $marks)
				<tr style="padding: 5px;">
					<td style="text-align: center;">{{$i++}}</td>
					<td style="text-align: left; margin-left: 10px;">{{ $marks->student->name }}</td>
					<td style="text-align: center;">{{$marks->wt_mark}}</td>
					<td style="text-align: center;">{{$marks->weekly_test_marks}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</body>
</html>