@section('heading')
Attendance System
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
                    <h5 class="title" align="center"><strong>Attendance System</strong></h5>
                </div>
                @php
                   // dd($errors->any());
                @endphp
                <div class="panel-body">
                    <div style="padding-top: 2px;">
                        <div style="padding: 10px;">
                            <form id="cr_search_form" method="post" action="{{route('attendance.dashboard')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                   	<div class="col-md-3">
                                   		<div class="form-group">
										    <label for="session">Session</label><span class="text-danger">&#9733;</span>
										    <select style="border: 1px solid;" class="options form-control" name="session_id" id="session">
										    </select>
                                               @if ($errors->has('session_id'))
                                                    <span class="help-block" style="color: red;">{{ $errors->first('session_id') }}</span>
                                               @endif
										</div>
                                   	</div>
                                   	<div class="col-md-3">
                                   		<div class="form-group">
										    <label for="class">Class</label><small> *select session</small><span class="text-danger">&#9733;</span>
										    <select style="border: 1px solid;" class="options form-control" name="level_id" id="class">  
										    </select>
                                            @if ($errors->has('level_id'))
                                                <span class="help-block" style="color: red;">{{ $errors->first('level_id') }}</span>
                                            @endif
										 </div>
                                   	</div>
                                   	<div class="col-md-3">
                                   		<div class="form-group">
										    <label for="section">Section</label><small> *select class</small><span class="text-danger">&#9733;</span>
										    <select style="border: 1px solid;" class="options form-control" name="section_id" id="section">
										    </select>
                                            @if ($errors->has('section_id'))
                                                <span class="help-block" style="color: red;">{{ $errors->first('section_id') }}</span>
                                            @endif
										 </div>
                                   	</div>
                                        <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="date">Date</label><small> *select Date</small>
                                            <input type="date" class="form-control" name="class_date" id="class_date">
                                           
                                         </div>
                                    </div>
                                 
                                </div>
                               
                                <div class="row">
                                	<div class="col-md-12" style="text-align: center;">
                                		<button type="submit" id="cr_search_btn" class="btn btn-round btn-wd">Submit</button>
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
