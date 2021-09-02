@section('heading')
    Weekly Test
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <?php
        $url = Session::get('chooseNumURL');

        //dd(Session::all());
        ?>
        <div class="row">
            <div class="col-md-10">
                <div class="card card-plain">

                    @if(Session::has('message'))
                        {{ Session::get('message') }}
                    @endif

                    <div class="header">
                        <div class="col-sm-6 pt-4">
                            <table border="1" class="table table-bordered" width="100%">
                                <tr>
                                    <td>Test No: {{ ($weekly_test_number) }}</td>
                                    <td>Term: {{$term->term_name}}</td>
                                </tr>
                                <tr>
                                    <td>Section: {{$sec_sub_teach->section->section_name}}</td>
                                    <td>Subject: {{$sec_sub_teach->subject->subject_name}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-6 pt-4">
                            <div class="form-group row pull-right pt-4">
                                <form action="javascript:void(0);">
                                    <div class="col-md-4 pt-4">
                                        <label for="">Test Mark:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control set_test_mark" required min = "0" value="{{isset($wt_mark)?$wt_mark->wt_mark:env('WT_MARK',15)}}" max="{{isset($wt_mark)?$wt_mark->wt_mark:env('WT_MARK',15) }}" type="number">
                                    </div>
                                    <div class="col-md-2">
                                        <button class="set_number_btn btn btn-fill btn-icon btn-info btn-xs">Set Number</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            
                            <div class="content table-responsive table-full-width">
                                {!! Form::open(['method' => 'GET', 'url' => '/weeklytest/storeMarks', 'class' => 'marks_form']) !!}
                                {!! Form::hidden('term_id', $term->id, ['class'=> '']) !!}
                                {!! Form::hidden('set_test_marks', isset($wt_mark)?$wt_mark->wt_mark:env('WT_MARK',15)  , ['class'=> 'set_test_marks']) !!}

                                    <table class="table table-striped">

                                        <thead>
                                        <th>Student Name</th>
                                        <th> Marks </th>
                                        
                                        </thead>


                                        @foreach($section_students as $section_student)
                                            <tbody>

                                                <?php
                                                $student = \App\Student::find($section_student->student_id);
                                                //dd($subject);
                                                ?>
                                                
                                            <tr>
                                                <td>
                                                    {!! Form::label('student_name[]', $student->name, ['class'=> 'form-control']) !!}
                                                    {!! Form::hidden('student_id[]', $student->id, ['class'=> '']) !!}
                                                    {!! Form::hidden('weekly_test_number[]', $weekly_test_number, ['class'=> '']) !!}
                                                    {!! Form::hidden('section_subject_teacher_id[]', $sec_sub_teach->id, ['class'=> '']) !!}
                                                </td>

                                                <td>
                                                    {!! Form::number('marks[]', null, ['max'=> isset($wt_mark)?$wt_mark->wt_mark:env('WT_MARK',15) , 
                                                    'min'=>'0','step'=>'0.5','required'=>'true', 'class'=> 'test_marks form-control']) !!}
                                                </td>
                                                

                                                
                                                
                                            </tr>
                                            </tbody>
                                        @endforeach

                                    </table>

                                    <div class="form-group">
                                        <div class="text-center">
                                            {!! Form::submit('Proceed', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                            {!! link_to($url, 'Back', ['class' => 'btn btn-default btn-fill btn-wd']) !!}
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                        </div>


                    </div>
                    <br>
                    

                </div>
            </div>
        </div>
    </div>
    <script>
        $(window).on('load', function(){
            $('.set_number_btn').click(function(){
                let number = $('.set_test_mark').val();
                if((number <= $('.set_test_mark').attr("max")) && (number >= $('.set_test_mark').attr("min"))){
                    $('.marks_form').find('.set_test_marks').val(number);
                    $('.marks_form').find('.test_marks').attr("max", number);
                }
            });
        })
    </script>
@endsection
