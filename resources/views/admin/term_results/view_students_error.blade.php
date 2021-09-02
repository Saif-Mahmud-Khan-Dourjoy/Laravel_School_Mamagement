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
	                                <th style="text-align: center;"><b>Roll no.</b></th>
	                                <th style="text-align: center;"><b>Action</b></th>
									<th style="text-align: center;"><b>Submitted</b></th>

	                            </table>  
								<div class="bg-warning text-center p-4">
									<h4 class="text-danger">No Student Added In This Section!</h4>
									<p class="text-info"><b>Please Add Students</b> </p>
									<p>Go To <b>Menu</b> <i class="ti-arrow-right"></i> Click on <b>Section</b>  <i class="ti-arrow-right"></i> Click on <b>Action</b> <i class="ti-arrow-right"></i> Select <b>Student++</b></p>
								</div>
	                        </div>
							
							
	                        <div class="form-group p-4" style="text-align: center;">
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
