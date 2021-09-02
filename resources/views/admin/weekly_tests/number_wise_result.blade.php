@section('heading')
Weekly Result
@endsection


@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">

				<div class="panel-heading" style="background-color: #f2f2f2;">
					<h4 class="title" align="center">Weekly Test Result</h4>
					<h5 align="center"><b>Subject:</b> {{$student_subject_results[0]->section_subject_teacher->subject->subject_name}}, <b>Test Number:</b> {{$weekly_test_number}}</h5>
					<h6 align="center" ><b>Term : </b>{{$term->term_name}}</h6>
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-6">
								<a style="text-align: left;" href="{{ url('/wt_pdf/'.$ssr_id) }}" class="btn btn-info btn-fill btn-wd" target="_blank">Download PDF</a>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<table class="table">
							<thead>
								<tr>
									<th>#SL</th>
									<th>Student name</th>
									<th>Total Number</th>
									<th>Marks</th>
								</tr>
							</thead>
							<tbody>
								<?php $i= 1; ?>
								@foreach ($student_subject_results as $ssr)
									<tr>
										<td>{{$i++}}</td>
										<td>{{$ssr->student->name}}</td>
										<td>{{$ssr->wt_mark}}</td>
										<td>{{$ssr->weekly_test_marks}}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="row">
						<div class="col-md-12 text-center">
							{!! Form::open(['method' => 'GET', 'url' => 'weekly_test/proceed' ]) !!}
							{!! Form::hidden('level_id', $student_subject_results[0]->section_subject_teacher->subject_id, ['class'=> 'form-control']) !!}
							{!! Form::hidden('section_id', $student_subject_results[0]->section_subject_teacher->section_id, ['class'=> 'form-control']) !!}
							{!! Form::hidden('term_id', $student_subject_results[0]->term_id, ['class'=> 'form-control']) !!}
							{!! Form::hidden('section_subject_teacher_id', $student_subject_results[0]->section_subject_teacher_id, ['class'=> 'form-control']) !!}
							{!! Form::submit('Back', array('class'=> 'btn btn-default btn-fill btn-wd')) !!}
							{{ Form::close() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection