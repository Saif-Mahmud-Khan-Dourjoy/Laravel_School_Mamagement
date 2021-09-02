@section('heading')
Weekly Result
@endsection


@extends('layouts.app')

@section('content')
<div class="container">
	<?php
	$viewStudentResultURL = \Request::fullUrl();
	Session::put('viewStudentResultURL', $viewStudentResultURL);
    //dd(Session::get('viewStudentResultURL'));
	$url = Session::get('viewSubjectsURL');
	$term = \App\Term::find($term_id);
	//dd($isGenerated);
	?>
	<br>
	<div class="row">
		<div class="col-md-10">
			<div class="panel panel-default">

				<div class="panel-heading" style="background-color: #e6e6e6;">
					<h4 class="title" align="center">Showing Weekly Result of</h4>
						<p style="font-size: 18px; text-align: center;"><b>{{ $student->name }}</b></p>
						<p style="font-size: 18px; text-align: center;"><b>{{ "Roll no: " }}</b> {{ $student->roll_no }}</p>
						

						<div class="panel-body">
							<div style="padding-top: 0px;">
								<div class="row" style="align-content: center">
									<table class="table" align="center">
									<tbody>
										<tr>
										  <td scope="col"><b>Session:</b> {{$session->name}}</td>
										  <td scope="col"><b>Term:</b> {{$term->term_name}} </td>
										  <td scope="col"><b>Class:</b> {{$level->class_name}}</td>
										  <td scope="col"><b>Section:</b> {{$section->section_name}}</td>
										</tr>
									</tbody>
									</table>
								</div>
								<div class="content table-responsive table-full-width">
									{!! Form::open(['method' => 'GET', 'url' => ['/weekly_test/generate_term_result']]) !!}
									{!! Form::hidden('student_id', $student->id, ['class'=> '']) !!}
									{!! Form::hidden('session_id', $session_id, ['class'=> '']) !!}
									{!! Form::hidden('term_id', $term_id, ['class'=> '']) !!}
									<table class="table table-striped">

										<thead>
											<th style="text-align: center; font-size: 15px;"><b>Test no.</b></th>
											<th style="font-size: 15px;"><b>Subjects</b></th>
											<th style="text-align: center; font-size: 15px;"><b>Marks</b></th>
											<th style="text-align: center; font-size: 15px;"><b>Total Mark</b></th>

										</thead>

										@foreach($student_subject_results as $student_subject_result)

										<?php
										
										$section_subject_teacher = 
										\App\SectionSubjectTeacher::find($student_subject_result->section_subject_teacher_id);

										$subject = 
										\App\Subject::find($section_subject_teacher->subject_id);

										?>

										<tr>
											<td style="text-align: center;">
												{{$student_subject_result->weekly_test_number}}
											</td>

											<td>
												{{$subject->subject_name}}
											</td>

											<td style="text-align: center;">
												{{$student_subject_result->weekly_test_marks}}
											</td>
											<td style="text-align: center;">
												{{(isset($student_subject_result->wt_mark) && $student_subject_result->wt_mark!= 0)?$student_subject_result->wt_mark:env('WT_MARK',15)}}
											</td>

										</tr>

										@endforeach

									</table>
									<div class="form-group row">
										
										<div class="text-center row">
											<div class="col-md-6" style="text-align: right;">
												{!! Form::submit('Generate Term Result', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
												{!! Form::close() !!}
											</div>
											<div class="col-md-6" style="text-align: left;">
												{!! Form::open(['method' => 'POST', 'url' => $url]) !!}

												{!! Form::hidden('level_id', Session::get('level_id'), ['class'=> 'form-control']) !!}
												{!! Form::hidden('section_id', Session::get('section_id'), ['class'=> 'form-control']) !!}
												{!! Form::hidden('session_id', Session::get('session_id'), ['class'=> 'form-control']) !!}
												{!! Form::hidden('term_id', Session::get('term_id'), ['class'=> 'form-control']) !!}
												{!! Form::submit('Back', array('class'=> 'btn btn-default btn-fill btn-wd')) !!}
												{{ Form::close() }}
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection