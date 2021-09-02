@section('heading')
    Weekly Result
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
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading" style="background-color: #e6e6e6;">
                       <table class='borderless'>
                                  <thead>
                                        <tr>
                                          <th><h5><b>List of all Subjects for the Students of</b></h5></th>
                                        </tr>
                                  </thead>
                                  <tbody>
                                        <tr>  
                                          <td><b>Class: </b>{{$level->class_name}}</td>
                                        </tr>
                                        <tr>
                                          <td><b>Exam for: </b>{{$term_name->term_name}}</td>
                                        </tr>
                                 </tbody>
                        </table>
                        <div class="panel-body">
                            <div style="padding-top: 0px;">
                                
                                <div class="content table-responsive table-full-width">
                                    
                                    <table class="table table-striped">

                                        <thead>
                                        <th style="text-align: center;"><b>Subject Name</b></th>
                                        <th style="text-align: center;"><b>Action</b></th>
                                        </thead>


                                        @foreach($section_subject_teachers as $sec_sub_teach)
                                            <tbody>

                                                <?php
                                                $subject = \App\Subject::find($sec_sub_teach->subject_id);
                                                //dd($subject);
                                                ?>
                                                
                                            <tr>
                                                {!! Form::open(['method' => 'GET', 'url' => '/weekly_test/proceed/']) !!}
                                                {!! Form::hidden('term_id', $term_id, ['class'=> '']) !!}
                                                {!! Form::hidden('section_id', $sec_sub_teach->section_id, ['class'=> '']) !!}
                                                {!! Form::hidden('level_id', $sec_sub_teach->subject_id, ['class'=> '']) !!}
                                                <td>
                                                    
                                                    {!! Form::label('Subject Name', $subject->subject_name, ['class'=> 'form-control']) !!}
                                                    {!! Form::hidden('section_subject_teacher_id', $sec_sub_teach->id, ['class'=> '']) !!} 
                                                    
                                                </td>

                                                

                                                <td style="text-align: center;">
                                                    {!! Form::submit('Proceed', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                                </td>
                                                {!! Form::close() !!}
                                            </tr>
                                            </tbody>
                                        @endforeach

                                    </table>
                                    <!-- <div class="form-group">
                                        <div class="text-center">
                                            {!! Form::submit('Proceed', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="text-align: center;">
                            <form method="GET" action="{{ url('/weeklytests') }}">
                                <button type="submit" class="btn btn-primary btn-wd">Go Back</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>   
@endsection
