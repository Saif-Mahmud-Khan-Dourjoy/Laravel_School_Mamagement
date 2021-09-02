@section('heading')
Generate Admit Card
@endsection
@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div>
                    @include('layouts.flash_message')
                </div>
                <div class="panel-heading" style="background-color: #f2f2f2;">
                    <h5 class="title" align="center"><strong>Admit Card</strong></h5>
                </div>
                @php
                   // dd($errors->any());
                @endphp
                <div class="panel-body">
                    <div style="padding-top: 2px;">
                        <div style="padding: 10px;">
                            <form id="cr_search_form" method="post" action="{{route('admit_card.pdf')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="session">Session</label><small> *required</small>
                                            <select style="border: 1px solid;" class="options form-control" name="session_id" id="session">
                                            </select>
                                               @if ($errors->has('session_id'))
                                                    <span class="help-block" style="color: red;">The session field is required.</span>
                                               @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="class">Class</label><small> *select session</small>
                                            <select style="border: 1px solid;" class="options form-control" name="level_id" id="class">  
                                            </select>
                                            @if ($errors->has('level_id'))
                                                <span class="help-block" style="color: red;">The class field is required.</span>
                                            @endif
                                         </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="section">Section</label><small> *select class</small>
                                            <select style="border: 1px solid;" class="options form-control" name="section_id" id="section">
                                            </select>
                                            @if ($errors->has('section_id'))
                                                <span class="help-block" style="color: red;">The section field is required.</span>
                                            @endif
                                         </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="section_student">Student</label><small> *select class & section</small>
                                            <select style="border: 1px solid;" class="options form-control" name="section_student_id" id="section_student">
                                            </select>
                                            @if ($errors->has('section_student_id'))
                                                <span class="help-block" style="color: red;">The student field is required.</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                   <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="section">Term</label><small> *select term</small>
                                            <select style="border: 1px solid;" class="options form-control" name="term_id" id="term">
                                            
                                            @foreach($terms as $term)
                                            <option value="{{$term->id}}">{{$term->term_name}}</option>
                                            @endforeach

                                            </select>
                                            @if ($errors->has('term_id'))
                                                <span class="help-block" style="color: red;">The term field is required.</span>
                                            @endif
                                         </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exam_start_date">Exam Start Date</label>
                                            <input type="date" id="exam_start_date" name="exam_start_date" style="border: 1px solid;" class="options form-control">
                                        </div>
                                        @if ($errors->has('exam_start_date'))
                                                <span class="help-block" style="color: red;">The exam start date field is required.</span>
                                        @endif
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12" style="text-align: center;">
                                        <button type="submit" id="cr_search_btn" class="btn btn-round btn-wd">Generate Admit Card</button>
                                        <button  type="button" id="refresh_btn2" class="btn btn-info btn-round"><i class="fa fa-refresh text-info"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
window.addEventListener('load', function(){
    $(function(){
        $('.pick-date').datetimepicker({
            timepicker:false,
            format: 'Y-m-d'
        });
    });
    //$('.options').select2();
    var sessions = <?php echo json_encode($sessions); ?>;
    var levelList = <?php echo json_encode($levels);?>;
    
    session_html = '<option disabled selected>Select Specific Session</option>';
    $.each(sessions, function(indexS, valueS) {
        session_html += '<option value="'+valueS.id+'">'+valueS.name+'</option>';
    });
    $('#session').html(session_html);
    $('#session').on('change', function(){
        updateLevel();
        $('#section').empty();
        $('#section_student').empty();
    });

    $('#class').on('change', function(){
        updateSection();
        $('#section_student').empty();
    });

    $('#section').on('change', function(){
        updateStudent();
    });

    $(document).on('click','#refresh_btn2', function(){
        refreshForm();
    });

    function updateLevel(){
        $.each(sessions, function(ind, val){
            if(val.id == $('#session').val()){
                $('#class').empty();
                class_html = '<option disabled selected>Select Specific Class</option>';
                $.each(val.level_enroll, function(indS, valS) {
                    if(val.id == valS.session_id){
                    class_html += '<option value="'+valS.level.id+'">'+valS.level.class_name+'</option>';
                    }
                });
            }
        });
        $('#class').html(class_html);   
    }

     function updateSection(){
        $.each(sessions, function(ind, val){
            if(val.id == $('#session').val()){
                $('#section').empty();
                section_html = '<option disabled selected>Select Specific Section</option>';
                $.each(val.level_enroll, function(indLE, valLE){
                    if(valLE.level_id == $('#class').val()){
                        $.each(valLE.section, function(indS, valS){
                            section_html += '<option value="'+valS.id+'">'+valS.section_name+'</option>';
                        });
                    }
                });
            }
        });
        $('#section').html(section_html);
    }

    function updateStudent(){
        $.each(levelList, function(index, value){
            $.each(value.level_enroll, function(indexLE, valueLE){
                $.each(valueLE.section, function(indexS, valueS){
                    if(valueS.id == $('#section').val()){
                    $('#section_student').empty();
                    section_student_html = '<option disabled selected>Select Specific Student</option>';
                    $.each(valueS.section_student, function(indexSS, valueSS){

                        section_student_html = section_student_html + '<option value="'+valueSS.student.id+'">'+valueSS.student.name+'</option>';                        
                    });
                    }
                });
            });
        });
        // console.log(section_student_html);
        $('#section_student').html(section_student_html); 
    }

    function refreshForm(){
        $('#cr_search_form').trigger('reset');
        $('#class').empty();
        $('#section').empty();
        $('#section_student').empty();
    }
});
</script>
@endsection
