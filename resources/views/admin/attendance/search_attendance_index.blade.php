@section('heading')
Generate Student's Attendance Report
@endsection
@extends('layouts.app')
@section('content')
<div class="container-fluid">
    {{-- <br> --}}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            	<div>
                    @include('layouts.flash_message')
                </div>
               
                

                <div class="panel-heading" style="background-color: #f2f2f2;">
                    <h5 class="title" align="center"><strong>Search Student's Attendance Report</strong></h5>
                </div>
                <div class="panel-body">
                    <div style="padding-top: 2px;">
                        <div style="background-color: lightgray; padding: 10px;">
                            <form action="{{url('/pdf/attendance_report')}}" method="POST" id="att_search_form">
                                @csrf
                                <div class="form-group row">
                                	{{-- <div class="col-md-3">
                                   		<div class="form-group">
										    <label for="branch">Branch</label>
										    <select class="form-control" name="branch_id" id="branch">
										    </select>
                                            <span class="help-block"></span>
										</div>
                                   	</div> --}}
                                   	<div class="col-md-4">
                                   		<div class="form-group">
										    <label for="session">Session</label> <span class="text-danger">&#9733;</span>
										    <select class="form-control" name="session_id" id="session">
										    </select>
                                            @error('session_id')
                                                <small class="text-danger">The session field is required.</small>
                                            @enderror
                            
                                            <span class="help-block"></span>
										</div>
                                   	</div>
                                   	<div class="col-md-4">
                                   		<div class="form-group">
										    <label for="class">Class</label> <span class="text-danger">&#9733;</span>
										    <select class="form-control" name="level_id" id="class">  
										    </select>
                                            @error('level_id')
                                                <small class="text-danger">The class field is required.</small>
                                            @enderror
                                            <span class="help-block"></span>
										 </div>
                                   	</div>
                                   	<div class="col-md-4">
                                   		<div class="form-group">
										    <label for="section">Section</label> <span class="text-danger">&#9733;</span>
										    <select class="form-control" name="section_id" id="section">
										    </select>
                                            @error('section_id')
                                                <small class="text-danger">The section field is required.</small>
                                            @enderror
                                            
                                            <span class="help-block"></span>
										 </div>
                                   	</div>
                                </div>
                                <div class="row">
                                   	<div class="col-md-4">
                                   		<div class="form-group">
										    <label for="attendance_date">Date of Attendance</label> <span class="text-danger">&#9733;</span>
										    <input type="text" name="attendance_date" class="form-control pick-date" id="attendance_date" placeholder="yyyy-mm-dd" autocomplete="off" required>
                                            @error('attendance_date')
                                                <small class="text-danger">The attendance date field is required.</small>
                                            @enderror
                                            <span class="help-block"></span>
										 </div>
                                   	</div>
                                   	<div class="col-md-4">
                                   		<div class="form-group">
										    <label for="collection_type">Attendance Type</label><span class="text-danger">&#9733;</span>
										    <select class="form-control" name="collection_type" id="collection_type">
										      <option disabled selected>Select Attendance Type</option>
										      <option value="1">Present</option>
										      <option value="2">Absent</option>
                                              <option value="3">All</option>
										    </select>
                                            @error('collection_type')
                                                <small class="text-danger">The attendance type field is required.</small>
                                            @enderror
                                            <span class="help-block"></span>
										 </div>
                                   	</div>
                                   	<div class="col-md-4" style="text-align: left; padding-left: 0px;">
                                   		<button  style="margin-top: 30px;" type="button" id="refresh_btn2" class="btn btn-info btn-sm btn-round"><i class="fa fa-refresh text-info"></i></button>
                                   	</div>
                                </div>
                                <div class="row">
                                	<div class="col-md-12" style="text-align: center;">
                                		<input type="submit" id="att_search_btn" class="btn btn-round btn-wd">
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
<div class="container-fluid" id="showing_attendance">
</div>
<script type="text/javascript">
window.addEventListener('load', function(){
	$(function(){
        $('.pick-date').datetimepicker({
        	timepicker:false,
        	format: 'Y-m-d'
        });
    });
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
    });

    $('#class').on('change', function(){
        updateSection();
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
        $.each(levelList, function(index, value){
           if(value.id == $('#class').val()) {
               $('#section').empty();
                section_html = '<option disabled selected>Select Specific Section</option>';
               $.each(value.level_enroll, function(indxs, valxs){
                $.each(valxs.section, function(indxss, valxss) {
                    section_html += '<option value="'+valxss.id+'">'+valxss.section_name+'</option>';
                });        
            });
           }
        });
        $('#section').html(section_html);   
    }

    function refreshForm(){
        $('#att_search_form').trigger('reset');
        $('#class').empty();
        $('#section').empty();
    }

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
   
});
</script>
@endsection
