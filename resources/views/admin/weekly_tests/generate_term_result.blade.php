@section('heading')
    Term Result Generation
@endsection


@extends('layouts.app')

@section('content')
<?php
    $url = Session::get('viewSubjectsURL');
?>

<?php
    $term_name = \App\Term::find($term_id)->term_name;  
?>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">

                    <div class="panel-heading" style="background-color: #e6e6e6;">
                        <h4 class="title" align="center">Generate Term Result here</h4>
                        <div class="header">
                            <div class="col-sm-6 pt-4">
                                <table border="1" class="table table-bordered" width="100%">
                                    <tr>
                                        <td>Term: {{ ($term_name) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Name: {{$student->name}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-sm-6 pt-4">
                                <div class="form-group row pull-right pt-4">
                                    <form action="javascript:void(0);">
                                        <div class="col-md-5 pt-4">
                                            <label for="">Hall Test Mark:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input class="form-control set_test_mark" required min = "0" value="{{isset($ht_mark)?$ht_mark->ht_mark:env('HT_MARK',70)}}" max="{{isset($ht_mark)?$ht_mark->ht_mark:env('HT_MARK',70) }}" type="number">
                                        </div>
                                        <div class="col-md-2">
                                            <button class="set_number_btn btn btn-fill btn-icon btn-info btn-xs">Set Number</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div style="padding-top: 25px;">

                                <br class="content table-responsive table-full-width">
                                    {!! Form::open(['method' => 'POST', 'url' => '/weekly_test/view_term_result/', 'class' => 'marks_form']) !!}
                                    {!! Form::hidden('term_id', $term_id, ['class'=> '']) !!}
                                    {!! Form::hidden('set_term_marks', isset($ht_mark)?$ht_mark->ht_mark:env('HT_MARK',70)  , ['class'=> 'set_term_marks']) !!}
                                     {!! Form::hidden('session_id', $session_id, ['class'=> 'form-control']) !!}
                                    {!! Form::hidden('student_id', $student->id  , ['class'=> '']) !!}
                                    <table class="table table-striped">

                                        <thead>
                                        <th>Subject Name</th>
                                        <th>Weekly Tests (With marks)</th>
                                        <th>Term marks</th>
                                        </thead>

                                        <?php
                                        $key = 0;
                                        ?>
                                        @foreach($section_subject_teacher_ids as $section_subject_teacher_id)
                                            <tbody>

                                            <?php
                                            $section_subject_teacher =
                                                \App\SectionSubjectTeacher::find($section_subject_teacher_id);

                                            $subject =
                                                \App\Subject::find($section_subject_teacher->subject_id);

                                            $student_subject_results =
                                                \App\StudentSubjectResult::where('section_subject_teacher_id', $section_subject_teacher_id)
                                                    ->where('student_id', $student->id)
                                                    ->where('term_id', $term_id)
                                                    ->get();

                                            ?>

                                            <tr>

                                                <td>
                                                    {!! Form::label('Subject name', $subject->subject_name, ['class'=> 'form-control']) !!}

                                                </td>


                                                <td width="55%">
                                                    @foreach($student_subject_results as $student_subject_result)
                                                        {{"Weekly test no.: "}}
                                                        {{$student_subject_result->weekly_test_number}}
                                                        ({{$student_subject_result->weekly_test_marks}}) 

                                                        {!! Form::checkbox('student_subject_result_id['.$student_subject_result->section_subject_teacher_id.']['.$student_subject_result->weekly_test_number.'][weekly_test_marks]',$student_subject_result->weekly_test_marks,
                                                        true) !!}
                                                        {!! Form::hidden('student_subject_result_id['.$student_subject_result->section_subject_teacher_id.']['.$student_subject_result->weekly_test_number.'][section_subject_teacher_id]',$student_subject_result->section_subject_teacher_id, ['class'=> '']) !!}
                                                        {!! Form::hidden('student_subject_result_id['.$student_subject_result->section_subject_teacher_id.']['.$student_subject_result->weekly_test_number.'][section_subject_result_id]',$student_subject_result->id, ['class'=> '']) !!}

                                                        {!! Form::hidden('student_subject_result_id['.$student_subject_result->section_subject_teacher_id.']['.$student_subject_result->weekly_test_number.'][wt_mark]',$student_subject_result->wt_mark, ['class'=> '']) !!}

                                                    @endforeach
                                                </td>

                                                <td width="20%">
                                                    {!! Form::number('term_marks['.$section_subject_teacher_id.']', null, ['max'=> isset($ht_mark)?$ht_mark->ht_mark:env('HT_MARK',70) , 'min'=>'0', 'step'=>'0.5','required'=>'true','class'=> 'form-control test_marks']) !!}
                                                    {!! Form::hidden('section_subject_teacher_idRes[]', $section_subject_teacher_id, ['class'=> '']) !!}

                                                </td>
                                            </tr>
                                            </tbody>
                                            <?php
                                            $key++;
                                            ?>
                                        @endforeach

                                    </table>
                                    <div class="form-group">
                                          <div class="text-center row">
                                            <div class="col-md-6" style="text-align: right;">
                                                {!! Form::submit('Proceed', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                                {{ Form::close() }} 
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
     <script>
        $(window).on('load', function(){
            $('.set_number_btn').click(function(){
                let number = $('.set_test_mark').val();
                if((number <= $('.set_test_mark').attr("max")) && (number >= $('.set_test_mark').attr("min"))){
                    $('.marks_form').find('.set_term_marks').val(number);
                    $('.marks_form').find('.test_marks').attr("max", number);
                }
            });
        })
    </script>
@endsection