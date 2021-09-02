@section('heading')
Final Result
@endsection


@extends('layouts.app')

@section('content')
<div class="container">
	<br>
	<div class="row">
		<div class="col-md-6 col-md-offset-2">
			<div>
                 @include('layouts.flash_message')
            </div>
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color: #e6e6e6;">
					<h5 class="title" align="center"><b>Weekly Test Results For The Students Of</b></h5>
					<table class="table table-hover" style="padding-bottom: 0px;">
					   <tr class="table-primary">
					      <td scope="col"><b>Class:</b> {{ $section_students[0]->section->level_enroll->level->class_name }}</td>
					      <td scope="col"><b>Section:</b> {{ $section_students[0]->section->section_name }}</td>
					      <td scope="col"><b>Session:</b> {{ $section_students[0]->section->level_enroll->session->name }}</td>
					   </tr>
					</table>
					<div class="panel-body">
						<div style="padding: 0px;">  
							<div class="content table-responsive table-full-width"> 
								<table id="sectionStudentDataTable"  class="table table-striped">
									<tr>
										<th style="text-align: center;">SL</th>
										<th style="text-align: center;">Student Name</th>
										<th style="text-align: center;">Student Roll</th>
										<th style="text-align: center;">Action</th>
									</tr>
									<?php $i=1; ?>
									@foreach ($section_students as $students)	
									<?php //dd($students);?>
									<tr>
										<td style="text-align: center;">{{ $i++ }}</td>
										<td style="text-align: center;">{{ $students->student->name }}</td>
										<td style="text-align: center;">{{ $students->student->roll_no }}</td>
										<td style="text-align: center;">
											<form method="get" action="{{ route('weeklytests.view_wt_report') }}">
												<input type="hidden" name="section_id" value="{{ $section_id }}" />
												<input type="hidden" name="session_id" value="{{ $session_id }}" />
												<input type="hidden" name="level_id" value="{{ $level_id }}" />
												<input type="hidden" name="student_id" value="{{ $students->student_id }}" />
												<button type="submit" class="btn btn-info btn-fill btn-wd">Download WT Report</button>
											</form>  
										</td>
									</tr> 
									@endforeach
								</table>
								<div class="form-group">
									<div class="text-center">
										<a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
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
