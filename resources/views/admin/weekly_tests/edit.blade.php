@section('heading')
Weekly Test
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card card-plain" style="padding-top: 10px">
                <div class="header">
                    <h4 class="title text-center">Update Weekly Test</h4>
                </div>
                <div class="mt-4">
                    <div class="col-sm-6 pt-4">
                        <table border="1" class="table table-bordered" width="100%">
                            <tr>
                                <td>Test No: {{ ($weekly_test->weekly_test_number) }}</td>
                                <td>Term: {{$term->term_name}}</td>
                            </tr>
                            <tr>
                                <td>Section: {{$section_subject_teacher->section->section_name}}</td>
                                <td>Subject: {{$section_subject_teacher->subject->subject_name}}</td>
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
                                    <input class="form-control set_test_mark" required min = "0" value="{{$student_subject_results[0]->wt_mark}}" max="{{isset($wt_mark)?$wt_mark->wt_mark:env('WT_MARK',15) }}" type="number">
                                </div>
                                <div class="col-md-2">
                                    <button class="set_number_btn btn btn-fill btn-icon btn-info btn-xs">Set Number</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="content table-responsive table-full-width">
                        {!! Form::open(['method' => 'PUT', 'url' => '/weeklytests/'.$student_subject_results[0]->id, 'class' => 'marks_form']) !!}
                        {!! Form::hidden('term_id', $term->id, ['class'=> '']) !!}
                        {!! Form::hidden('set_test_marks', $student_subject_results[0]->wt_mark , ['class'=> 'set_test_marks']) !!}
                        {!! Form::hidden('section_subject_teacher_id', $section_subject_teacher->id, ['class'=> '']) !!}
                        {!! Form::hidden('weekly_test_number', $weekly_test->weekly_test_number, ['class'=> '']) !!}

                        <table class="table table-striped">

                            <thead>
                                <th>Student Name</th>
                                <th> Marks </th>
                            </thead>

                            @foreach($student_subject_results as $section_student)
                            <tbody>
                                <tr>
                                    <td>
                                        {!! Form::label('student_name[]', $section_student->student->name, ['class'=> 'form-control']) !!}
                                        {!! Form::hidden('student_subject_result_id[]', $section_student->id, ['class'=> '']) !!}
                                    </td>

                                    <td>
                                        {!! Form::number('marks[]', $section_student->weekly_test_marks, ['max'=> $student_subject_results[0]->wt_mark , 
                                        'min'=>'0','step'=>'0.5','required'=>'true', 'class'=> 'test_marks form-control']) !!}
                                    </td> 
                                </tr>
                            </tbody>
                            @endforeach

                        </table>
                        <div class="form-group">
                            <div class="text-center">
                                {!! link_to(URL::previous(), 'Back', ['class' => 'btn btn-default btn-fill btn-wd']) !!}
                                {!! Form::submit('Update', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
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