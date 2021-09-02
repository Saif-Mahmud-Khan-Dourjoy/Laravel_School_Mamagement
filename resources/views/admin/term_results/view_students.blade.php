@section('heading')
Generate Term Results For The Students
@endsection
@extends('layouts.app')
@section('content')
<div class="container">
	<?php
	    $viewSubjectsURL = \Request::fullUrl();
	    Session::put('viewSubjectsURL', $viewSubjectsURL);
	    Session::put('level_id', $level_id);
	    Session::put('section_id', $section_id);
	    Session::put('session_id', $session_id);
	    Session::put('term_id', $term_id);
	?>
	<?php
	    $level = \App\Level::find($level_id);
	    $section_name = \App\Section::find($section_id);
	    $term_name =  \App\Term::find($term_id);
    ?>
    <br>
</div>
<div class="container">
    <br>
	<div class="row">
	    <div class="col-md-8 col-md-offset-1">
			<div>
                @include('layouts.flash_message')
            </div>
	        <div class="panel panel-default">
	            <div class="panel-heading" style="background-color: #e6e6e6;">
	                <h5 class="title" align="center"><b>List of all Students</b></h5>
	                <p align="center"><b>Class: </b>{{ $level->class_name }} ( {{ $term_name->term_name }} )</p>
	                <div class="panel-body">
	                    <div style="padding-top: 0px;">
	                        <div class="content table-responsive table-full-width">   
	                            <table id="sectionStudentDataTable"  class="table table-striped">
	                                <thead>
	                                <th style="text-align: center;"><b>Student Name</b></th>
	                                <th style="text-align: center;"><b>Class Roll</b></th>
	                                <th style="text-align: center;"><b>Action</b></th>
									<th style="text-align: center;"><b>Submitted</b></th>
	                                </thead>
								     	<?php
											//echo $section_students;
											$i=0;
											$count_student=0;
	                                    ?> 
	                                @foreach($section_students as $section_student)
	                                    <tbody>

	                                        <?php
											
	                                        $student = \App\Student::findOrFail($section_student->student_id);
											$term_res = \App\TermResult::where('section_student_id', $section_student->id)->where('term_id',$term_id)->count();

											$count_student++;
	                                        //dd($student);
	                                        ?>   
	                                    <tr>
	                                        {!! Form::open(['method' => 'POST', 'url' => '/term_results/submit']) !!}
	                                        
	                                        <td>
	                                            
	                                            {!! Form::label('Student Name', $student->name, ['class'=> 'form-control']) !!}
	                                            {!! Form::hidden('student_id', $student->id, ['class'=> '']) !!}
	                                            {!! Form::hidden('term_id', $term_id, ['class'=> '']) !!} 
												{!! Form::hidden('section_id', $section_id, ['class'=> '']) !!} 
												{!! Form::hidden('level_id', $level_id, ['class'=> '']) !!} 
												{!! Form::hidden('session_id', $session_id, ['class'=> '']) !!} 
	                                                
	                                        </td>

	                                        <td>
	                                            
	                                            {!! Form::label('', $section_student->roll, ['class'=> 'form-control']) !!} 
	                                            
	                                        </td>
	                                        <td>
	                                            {!! Form::submit('Proceed', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
												
	                                        </td>
											<td style="text-align: center;">
											    @php
												     if($term_res>0){ $i++;

												@endphp
														<label for="">done</label>
												@php
													 }
												@endphp
											
											</td>
	                                        {!! Form::close() !!}
	                                    </tr>
	                                    </tbody>
	                               
										 
	                                @endforeach
	                            </table>  
	                        </div>
							@php
								if($count_student==$i){
							@endphp
								<div class="form-group" style="text-align: center;">
									<form method="POST" action="{{ url('/term_results/students') }}">
									@csrf
										{!! Form::hidden('student_id', $student->id, ['class'=> '']) !!}
										{!! Form::hidden('term_id', $term_id, ['class'=> '']) !!} 
										{!! Form::hidden('section_id', $section_id, ['class'=> '']) !!} 
										{!! Form::hidden('session_id', $session_id, ['class'=> '']) !!} 
										{!! Form::hidden('level_id', $level_id, ['class'=> '']) !!} 
										{!! Form::submit('View Term Result', array('class'=> 'btn btn-primary btn-wd')) !!}
									</form>	
								</div>
							@php
								}
							@endphp
	                        <div class="form-group" style="text-align: center;">
	                        	<form method="GET" action="{{ url('/term_results') }}">
								@csrf
	                        		<button type="submit" class="btn btn-primary btn-wd">Go Back</button>
	                        	</form>
								
                       		</div>

	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</div>  
@endsection
