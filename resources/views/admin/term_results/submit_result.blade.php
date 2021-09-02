@section('heading')
    Term Result Generation
@endsection


@extends('layouts.app')

@section('content')
<?php
    $url = Session::get('viewSubjectsURL');
?>

<?php
    $term_name = $terms->term_name;  
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
                           
                        </div>
                        <div class="panel-body">
                            <div style="padding-top: 25px;">

                                <br class="content table-responsive table-full-width">
                                    {!! Form::open(['method' => 'POST', 'url' => '/term_results/submitTermResult', 'class' => 'marks_form']) !!}
                                    {!! Form::hidden('term_id', $terms->id, ['class'=> '']) !!}
									{!! Form::hidden('session_id', $session_id, ['class'=> '']) !!}
                                    {!! Form::hidden('student_id', $student->id  , ['class'=> '']) !!}
									{!! Form::hidden('section_id', $section_id  , ['class'=> '']) !!}
                                    {!! Form::hidden('level_id', $level_id, ['class'=> '']) !!} 
									
									
                                    <table class="table">

                                        <thead>
                                        <th>Subject Name</th>
                                        <th>Marks</th>
                                        <th>Term marks</th>
                                        </thead>
                                        <tbody>

                                        <?php
                                            $counter = 0;
                                        ?>
										@foreach($sectionSubjectTeacher as $ssr)
										<?php
                                        $section_student = \App\SectionStudent::where('student_id', $student->id)->where('section_id', $section_id)->first();
										$term_results = \App\TermResult::where('section_subject_teacher_id', $ssr->id)->where('term_id', $term_id)->where('section_student_id', $section_student->id)->first();
                                        ?>
											<td> {{$ssr->subject->subject_name}}
											{!! Form::hidden('subject_id[]', $ssr->subject->id  , ['class'=> '']) !!}
											 
											</td>
											<td width="20%">
                                                <?php if(isset($ssr->section_subject_distribution->written_permission)){ if($ssr->section_subject_distribution->written_permission=="Yes"){     ?>
                                                    Written {!! Form::number('written_marks[]', isset($term_results->term_result_distribution->written_mark) ? $term_results->term_result_distribution->written_mark : "0", ['class'=> 'rm border written', 'onkeyup'=>'carousel()']) !!}
                                                <?php }} ?>
                                                <?php if(isset($ssr->section_subject_distribution->written_permission)){ if($ssr->section_subject_distribution->written_permission=="No"){     ?>
                                                     {!! Form::hidden('written_marks[]', 0, ['class'=> ' border written', 'onkeyup'=>'carousel()']) !!}
                                                <?php }} ?>

                                                <?php if(isset($ssr->section_subject_distribution->mcq_permission)){ if($ssr->section_subject_distribution->mcq_permission=="Yes"){   ?>
                                                    MCQ {!! Form::number('mcq_marks[]', isset($term_results->term_result_distribution->mcq_mark) ? $term_results->term_result_distribution->mcq_mark : "0", ['class'=> 'mm border mcq', 'onkeyup'=>'carousel()']) !!}
                                                <?php }} ?>
                                                <?php if(isset($ssr->section_subject_distribution->mcq_permission)){ if($ssr->section_subject_distribution->mcq_permission=="No"){   ?>
                                                     {!! Form::hidden('mcq_marks[]', 0, ['class'=> 'border mcq', 'onkeyup'=>'carousel()']) !!}
                                                <?php }} ?>


                                                <?php if(isset($ssr->section_subject_distribution->pactical_permission)){ if($ssr->section_subject_distribution->pactical_permission=="Yes"){   ?>
                                                    Practical {!! Form::number('pactical_marks[]',  isset($term_results->term_result_distribution->pactical_mark) ? $term_results->term_result_distribution->pactical_mark : "0",['class'=> 'pm border pactical', 'onkeyup'=>'carousel()']) !!}
                                                <?php }} ?>
                                                <?php if(isset($ssr->section_subject_distribution->pactical_permission)){ if($ssr->section_subject_distribution->pactical_permission=="No"){   ?>
                                                     {!! Form::hidden('pactical_marks[]', 0,['class'=> ' border pactical', 'onkeyup'=>'carousel()']) !!}
                                                <?php }} ?>
                                            </td>
												
											<td width="20%">
                                                    @php
                                                    $s_max= \App\SectionSubjectTermMark::where('section_subject_teacher_id', $ssr->id)->where('term_id',$term_id)->first();
                                                    @endphp
												{!! Form::number('term_marks[]', isset($term_results->term_marks) ? $term_results->term_marks : "0", [ 'min'=>'0', 'max'=>$s_max->total_mark,'required'=>'true','class'=> 'form-control test_marks result']) !!}
											</td>
                                         
										</tr>
                                        <?php
                                            $counter++;
                                        ?>
										@endforeach
                                        
										
										</tbody>
                                       

                                    </table>
                                    @if($counter==0)
                                        <div class="bg-warning text-center p-4">
                                            <h4 class="text-danger">No Subject Added In This Section!</h4>
                                            <p class="text-info"><b>Please Add Section Subject</b> </p>
                                            <p>Go To <b>Menu</b> <i class="ti-arrow-right"></i> Click on <b>Section</b>  <i class="ti-arrow-right"></i> Click on <b>Action</b> <i class="ti-arrow-right"></i> Select <b>Subject++</b></p>
                                        </div>
                                    @endif
                                   
                                    
                                    <div class="form-group p-4">
                                        <div class="text-center row">
                                        @if($counter>0)
                                            <div class="col-md-12" style="text-align: center;">
                                                {!! Form::submit('Proceed', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                            </div>
                                        @endif
                                        {{ Form::close() }} 
                                        
                                    </div>

                                    <div class="form-group p-4">
                                            <div class="col-md-12" style="text-align: center;">
                                                {!! Form::open(['method' => 'POST', 'url' => '/term_results/view_students']) !!}
                                                {!! Form::hidden('term_id', $terms->id, ['class'=> '']) !!}
                                                {!! Form::hidden('session_id', $session_id, ['class'=> '']) !!}
                                                {!! Form::hidden('student_id', $student->id  , ['class'=> '']) !!}
                                                {!! Form::hidden('section_id', $section_id  , ['class'=> '']) !!}
                                                {!! Form::hidden('level_id', $level_id, ['class'=> '']) !!} 
                                                        
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
        function carousel() {
            var i;
            var w = document.getElementsByClassName("written");
            var m = document.getElementsByClassName("mcq");
            var p = document.getElementsByClassName("pactical");
            var x = document.getElementsByClassName("result");
            for (i = 0; i < x.length; i++) {
                var written = parseFloat(w[i].value);
                var mcq = parseFloat(m[i].value);
                var pactical = parseFloat(p[i].value);

                x[i].value=(written + mcq +pactical).toFixed(2);
            }
        }
    </script>
@endsection