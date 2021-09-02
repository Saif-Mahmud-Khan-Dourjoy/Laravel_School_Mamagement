@section('heading')
    Term Report
@endsection


@extends('layouts.app')

@section('content')
    <?php
        $url = Session::get('viewSubjectsURL');
    ?>
    <div class="container">
        <?php
        $url = Session::get('viewSubjectsURL');
        
        ?>
        <br>
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <?php
                    //dd($term_results);
                    $section_student_id = $term_results->first()->section_student_id;
                    $section_student = \App\SectionStudent::find($section_student_id);
                    $student = \App\Student::find($section_student->student_id);
                    $term = \App\Term::find($term_results->first()->term_id);
                    $section = \App\Section::find($section_student->section_id);
                    $level_enroll = \App\LevelEnroll::find($section->level_enroll_id);
                    $level = \App\Level::find($level_enroll->level_id);
                    $session = \App\Session::find($level_enroll->session_id);

                    ?>
                    <div class="panel-heading" style="background-color: #e6e6e6;">
                        <h4 class="title" align="center">Showing {{$term->term_name}} Result of <br>


                            <p>{{$student->name}}</p>
                            <p>{{ "Roll no: " }} {{ $section_student->roll }}

                        </h4>

                        <div class="panel-body">
                            <div style="padding-top: 25px;">
                                <div class="row" style="align-content: center">
                                    <div class="col-md-3">
                                        <div class="form-group" style="text-align: center">
                                            
                                            {!! Form::open(['target' => '_blank' ,'method' => 'GET', 'url' => ['/pdf/report-weekly-test/'.$term->id]]) !!}
                                            {!! Form::submit('Download PDF', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                            
                                            {!! Form::hidden('section_student_id', $section_student_id, ['class'=> 'form-control']) !!}
                                            {!! Form::hidden('session_id', $session_id, ['class'=> 'form-control']) !!}
                                            {!! Form::hidden('section_id', $section->id, ['class'=> 'form-control']) !!}
                                            {!! Form::hidden('student_id', $student->id, ['class'=> '']) !!}
                                            {!! Form::hidden('term_id', $term->id, ['class'=> '']) !!} 

                                            {!! Form::close() !!}       
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="align-content: center">
                                    <div class="col-md-3">
                                        <div class="form-group" style="text-align: center">
                                           <b>{{"Session:"}}</b>
                                            {{$session->name}}
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group" style="text-align: center">
                                            <b>{{"Class:"}}</b>
                                            {{$level->class_name}}
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group" style="text-align: center">
                                           <b>{{"Section:"}}</b>
                                            {{$section->section_name}}
                                        </div>
                                    </div>


                                </div>


                                <div class="content table-responsive table-full-width">

                                    <table class="table table-striped">

                                        <thead>
                                        <th style="text-align:left;"><b>Subject</b></th>
                                        <th style="text-align:center;"><b>Pass Mark</b></th>
                                        <th style="text-align:center;"><b>Marks Distribution</b></th>
                                        <th style="text-align:center;"><b>Total Mark</b></th>
                                        <th style="text-align:center;"><b>Letter Grade</b><br></th>
                                        <th style="text-align:center;"><b>Point</b><br></th>
                                        <th style="text-align:center;"><b>Highest Mark</b></th>
                                        </thead>


                                        @foreach($term_results as $term_result)

                                            <?php

                                            $section_subject_teacher =
                                                \App\SectionSubjectTeacher::find($term_result->section_subject_teacher_id);

                                            $subject =
                                                \App\Subject::find($section_subject_teacher->subject_id);
                                            
                                            $hight_marks = \App\TermResult::where('section_subject_teacher_id',  $section_subject_teacher->id)
                                                                        ->where('term_id',  $term->id)->orderBy('term_marks', 'desc')->first();
                                            ?>

                                            <tr>
                                                <td style="text-align: left;">
                                                    {{$subject->subject_name." - ".((isset($term_result->section_subject_teacher->student_subject_term_mark->total_mark) && $term_result->section_subject_teacher->student_subject_term_mark->total_mark > 0)?$term_result->section_subject_teacher->student_subject_term_mark->total_mark:env('TOTAL_MARK',100))}}
                                                </td>

                                                <td style="text-align: center;">
                                                    {{((isset($term_result->section_subject_teacher->student_subject_term_mark->pass_mark) && $term_result->section_subject_teacher->student_subject_term_mark->pass_mark > 0)?$term_result->section_subject_teacher->student_subject_term_mark->pass_mark:env('PASS_MARK',40))}}
                                                </td> 

                                                <td style="text-align: left;">
                                                    <?php if(isset($term_result->section_subject_teacher->section_subject_distribution->written_permission)){ if($term_result->section_subject_teacher->section_subject_distribution->written_permission=="Yes"){     ?>
                                                        <span >Written:</span><span style="text-align: right;">{{ $term_result->term_result_distribution->written_mark }}</span>  
                                                    <?php }} ?>
                                                    <?php if(isset($term_result->section_subject_teacher->section_subject_distribution->mcq_permission)){ if($term_result->section_subject_teacher->section_subject_distribution->mcq_permission=="Yes"){     ?>
                                                        <br><span">MCQ:</span><span style="text-align: right;">{{ $term_result->term_result_distribution->mcq_mark }}</span>
                                                    <?php }} ?>
                                                    <?php if(isset($term_result->section_subject_teacher->section_subject_distribution->pactical_permission)){ if($term_result->section_subject_teacher->section_subject_distribution->pactical_permission=="Yes"){     ?>
                                                        <br><span >Practical:</span><span style="text-align: right;">{{ $term_result->term_result_distribution->pactical_mark }}</span>
                                                    <?php }} ?>

                                                </td>                                              

                                                <td style="text-align: center;">
                                                    {{$term_result->total_marks}}
                                                </td>

                                                <td style="text-align: center;">
                                                    {{grade_calculation($term_result->total_marks)}}
                                                </td>

                                                <td style="text-align: center;">
                                                    {{ grade_calculation($term_result->total_marks,'point')}}
                                                </td>
                                                <td style="text-align: center;">
                                                    {{ $hight_marks->term_marks }}
                                                </td>

                                            </tr>

                                        @endforeach

                                    </table>

                                </div>
                                <div class="form-group">
                                    <div class="text-center">
                                        {!! Form::open(['method' => 'POST', 'url' => $url]) !!}
                                        {!! Form::hidden('level_id', Session::get('level_id'), ['class'=> 'form-control']) !!}
                                        {!! Form::hidden('section_id', Session::get('section_id'), ['class'=> 'form-control']) !!}
                                        {!! Form::hidden('session_id', Session::get('session_id'), ['class'=> 'form-control']) !!}
                                        {!! Form::hidden('term_id', Session::get('term_id'), ['class'=> 'form-control']) !!}
                                        {!! Form::hidden('level_id', Session::get('level_id'), ['class'=> 'form-control']) !!}
                                        {!! Form::submit('View/Generate more', array('class'=> 'btn btn-default btn-fill btn-wd')) !!}
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
@endsection