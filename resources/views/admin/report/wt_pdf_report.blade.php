<!DOCTYPE html>
<html>
<head>
	<title>Weekly Test Result</title>
	<style type="text/css">
		td {
			padding: 1px;
			font-size: 12px;
		}
	</style>
</head>
<body>
	<div class="row">
		<div class="logo" style="float:left; width:15%; position: absolute; text-align: left;">
			<img src="{{asset('admin')}}/img/favicon-final.png" style="width:80px;height:70px;"/>
		</div>
		<div style="float:left; width:70%; ">
			<h3 style="margin:0px; padding:0px; font-size: 22px; text-align: center;">GRACE SCHOOL</h3>
			<address style="margin:0px; padding:0px; text-align: center">
			<p style="text-align: center; font-size: 16px;"> {{ $wt_results[0]->address }}<br></p>
			<p style="font-size: 13px;"><b>Contact No:</b> {{ $wt_results[0]->contact_no }}<i></p>
			<p style="font-size: 13px;"><b>E-mail:</b></i> {{ $wt_results[0]->email }}</p>
			<p style="text-align: center; font-size: 15px; padding-top: 0px;"><b>Weekly Test Result</b></p>
			</address>
		</div>
	</div>
	<div style="padding-bottom: 10px; width: 100%;">
		<div style="width: 50%; float: left;">
		  <table width="100%">
		   	 <tr>
			  	<td style="font-size: 13px;"><b>Student Name:</b> {{ $wt_results[0]->name }}</td>
		 	 </tr>
		  	 <tr>
			    <td style="font-size: 13px;"><b>Class:</b> {{ $wt_results[0]->class_name }}</td>
		  	 </tr>
		  </table>
		</div>
		<div style="width: 50%; float: right; text-align: right;">
		  <table width="100%">
			  <tr>
			  	<td style="font-size: 13px; text-align: right;"><b>Section:</b> {{ $wt_results[0]->section_name }}</td>
			 </tr>
			 <tr>
			  	<td style="font-size: 13px; text-align: right;"><b>Roll No:</b> {{ $wt_results[0]->roll }}</td>
			 </tr>
		  </table>
		</div>
	</div>
@foreach($terms as $term_id)
	<div class="row" float="center">
		<table border=1 style="border-collapse: collapse;
			font-size: 12px; width: 100%; padding: 0px;">
			<thead>
				<tr>
					<td colspan="6" style="text-align: center;"><i> Weekly Test Results of ( <b> {{ $wt_results[0]->name }}</b>)</i></td>
				</tr>
				<tr style="padding: 0px;">
					<th style="text-align: center; font-size: 12px; width: 10%">SL</th>
					<th style="text-align: center; font-size: 12px; width: 20%;">Subject</th>
					<th style="text-align: center; font-size: 12px; width: 20%;">Term</th>
					<th style="text-align: center; font-size: 12px; width: 15%;">Test Number</th>
					<th style="text-align: center; font-size: 12px; width: 15%;">Test Marks</th>
					<th style="text-align: center; font-size: 12px; width: 20%;">Test Result</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; ?>
			@foreach($wt_results as $results)
			@if($results->term_id == $term_id)
				<tr style="padding: 0px;">
					<td style="text-align: center;">{{$i++}}</td>
					<td style="text-align: center;">{{ $results->subject_name }}</td>
					<td style="text-align: center;">{{ $results->term_name }}</td>
					<td style="text-align: center;">{{ $results->weekly_test_number }}</td>
					<td style="text-align: center;">{{ $results->wt_mark }}</td>
					<td style="text-align: center;">{{ $results->weekly_test_marks }} outof {{ $results->wt_mark }}</td>
				</tr>
			@endif
			@endforeach
			</tbody>
		</table>
	</div>
	<?php
		$last_element = end($terms);
		if($last_element == $term_id){
			break;
		}
	?>
	<pagebreak>
@endforeach
</body>
</html>