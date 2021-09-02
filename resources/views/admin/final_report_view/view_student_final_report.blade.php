<?php
//dd($final_reports);
?>

@section('heading')
    Final Report
@endsection


@extends('layouts.app')

@section('content')
    
    <div class="container">

        <br>
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <?php
                    /*$section_student_id = $term_results->first()->section_student_id;
                    $section_student = \App\SectionStudent::find($section_student_id);
                    $student = \App\Student::find($section_student->student_id);
                    $term = \App\Term::find($term_results->first()->term_id);
                    $section = \App\Section::find($section_student->section_id);
                    $level_enroll = \App\LevelEnroll::find($section->level_enroll_id);
                    $level = \App\Level::find($level_enroll->level_id);
                    $session = \App\Session::find($level_enroll->session_id);*/

                    ?>
                    <div class="panel-heading" style="background-color: #e6e6e6;">
                        <h4 class="title" align="center">Showing Final Result of <br>


                            <p>{{$student->name}}</p>
                            <p>{{ "Roll no: " }} {{ $student->roll_no }}

                        </h4>

                        <div class="panel-body">
                            <div style="padding-top: 25px;">
                                <div class="row" style="align-content: center">
                                    @if($count_freport>0)
                                    <div class="col-md-3">
                                        <div class="form-group" style="text-align: center">
                                            
                                            {!! Form::open(['method' => 'GET', 'url' => ['/pdf/report-final/'.$student->id], 'target' => '_blank']) !!}
                                            {!! Form::submit('Download PDF', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                            {!! Form::hidden('section_id', $section->id, ['class'=> '']) !!}
                                            {!! Form::close() !!}
                                                
                                        </div>
                                    </div>
                                    @endif
                                <div class="row" style="align-content: center">
                                    <div class="col-md-3">
                                        <div class="form-group" style="text-align: center">
                                            {{"Session:"}}
                                            {{$session->name}}
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group" style="text-align: center">
                                            {{"Class:"}}
                                            {{$level->class_name}}
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group" style="text-align: center">
                                            {{"Section:"}}
                                            {{$section->section_name}}
                                        </div>
                                    </div>


                                </div>


                                <div class="content table-responsive table-full-width">

                                    <table class="table table-striped">

                                        <thead>

	                                        <th style="width:25%">Subjects</th>
	                                        <th style="width:25%">Final Marks</th>
	                                        <th style="width:25%">Final Letter Grade</th>
	                                        <th style="width:25%">Final Points</th>

                                        </thead>


                                        @foreach($final_reports as $final_report)

                                            <?php

                                            $section_subject_teacher =
                                                \App\SectionSubjectTeacher::find($final_report->section_subject_teacher_id);

                                            $subject =
                                                \App\Subject::find($section_subject_teacher->subject_id);

                                            ?>

                                            <tr>
                                                <td>
                                                    {{$subject->subject_name}}
                                                </td>

                                                <td>
                                                    {{$final_report->subject_marks}}
                                                </td>

                                                <td>
                                                    {{grade_calculation($final_report->subject_marks)}}
                                                </td>

                                                <td>
                                                    {{grade_calculation($final_report->subject_marks, 'point')}}
                                                </td>

                                            </tr>

                                        @endforeach

                                    </table>
                                    @if($count_freport==0)
                                    <div class="bg-warning text-center p-4">
                                        <h4 class="text-danger">Term Result Is Empty!</h4>
                                        <p class="text-info"><b>Please Upload Student Term Result</b> </p>
                                        <p>Go To <b>Menu</b> <i class="ti-arrow-right"></i> Click on <b>Reports</b>  <i class="ti-arrow-right"></i> Click on <b>Term Result</b> </p>
                                    </div>

                                    @endif

                                </div>
                                <div class="form-group p-2">
                                    <div class="text-center">
                                        {!! link_to(URL::previous(), 'Done!', ['class' => 'btn btn-primary btn-fill btn-wd']) !!}
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