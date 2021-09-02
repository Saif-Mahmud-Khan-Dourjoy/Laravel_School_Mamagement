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
                    <table class="table">
                        <tbody>
                        <thead>
                           <th>Subject Name</th>
                           <th>Marks</th>
                           <th>Term marks</th>
                        </thead>
                        <?php
                           $counter = 0;
                        ?>
                        @foreach($sectionSubjectTeacher as $ssr)
                        <tr>
                            <td> {{$ssr->subject->subject_name}}
                              {!! Form::hidden('subject_id[]', $ssr->subject->id  , ['class'=> '']) !!}
                            </td>
                            <td width="20%">
                              <?php if(isset($ssr->section_subject_distribution->written_permission)){ if($ssr->section_subject_distribution->written_permission=="Yes"){     ?>
                              Written {!! Form::number('written_marks[]', 0, ['class'=> ' border']) !!}
                              <?php }} ?>
                              <?php if(isset($ssr->section_subject_distribution->written_permission)){ if($ssr->section_subject_distribution->written_permission=="No"){     ?>
                              {!! Form::hidden('written_marks[]', 0, ['class'=> ' border']) !!}
                              <?php }} ?>
                              <?php if(isset($ssr->section_subject_distribution->mcq_permission)){ if($ssr->section_subject_distribution->mcq_permission=="Yes"){   ?>
                              MCQ {!! Form::number('mcq_marks[]', 0, ['class'=> ' border']) !!}
                              <?php }} ?>
                              <?php if(isset($ssr->section_subject_distribution->mcq_permission)){ if($ssr->section_subject_distribution->mcq_permission=="No"){   ?>
                              {!! Form::hidden('mcq_marks[]', 0, ['class'=> ' border']) !!}
                              <?php }} ?>
                              <?php if(isset($ssr->section_subject_distribution->pactical_permission)){ if($ssr->section_subject_distribution->pactical_permission=="Yes"){   ?>
                              Practical {!! Form::number('pactical_marks[]', 0,['class'=> ' border']) !!}
                              <?php }} ?>
                              <?php if(isset($ssr->section_subject_distribution->pactical_permission)){ if($ssr->section_subject_distribution->pactical_permission=="No"){   ?>
                              {!! Form::hidden('pactical_marks[]', 0,['class'=> ' border']) !!}
                              <?php }} ?>
                            </td>
                            <td width="20%">
                              {!! Form::number('term_marks[]', null, [ 'min'=>'0', 'step'=>'0.5','required'=>'true','class'=> 'form-control test_marks']) !!}
                            </td>
                        </tr>
                        <?php
                           $counter++;
                        ?>
                        @endforeach
                        </tbody>
                    </table>
                     <div class="form-group">
                        <div class="text-center row">
                           <div class="col-md-6" style="text-align: center;">
                              {!! Form::submit('Proceed', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                              {{ Form::close() }} 
                           </div>
                           <div class="col-md-6" style="text-align: center;">
                              {!! Form::open(['method' => 'POST', 'url' => $url]) !!}
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