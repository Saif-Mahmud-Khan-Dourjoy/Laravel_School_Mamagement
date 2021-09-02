@section('heading')
View Collection Report
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
                    <h5 class="title" align="center"><strong>Search to view Collection Report</strong></h5>
                </div>
                <div class="panel-body">
                    <div style="padding-top: 2px;">
                        <div style="padding: 10px;">
                            <form id="cr_search_form" method="post" action="{{route('collectionReport.view')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                	{{-- <div class="col-md-3">
                                   		<div class="form-group">
										    <label for="branch">Branch</label>
										    <select class="options form-control" name="branch_id" id="branch">
										    	@foreach($branches as $branch)
										    	<option value="{{$branch->id}}">{{$branch->name}}</option>
										    	@endforeach
										    </select>
                                            <span class="help-block"></span>
										</div>
                                   	</div> --}}
                                   	<div class="col-md-4">
                                   		<div class="form-group">
										    <label for="session">Session</label> <span class="text-danger">&#9733;</span>
										    <select style="border: 1px solid;" class="options form-control session" name="session_id" id="session">
										    </select>
                                            <span class="help-block"></span>
										</div>
                                   	</div>
                                   	<div class="col-md-4">
                                   		<div class="form-group">
										    <label for="class">Class</label><small> *select session</small>
										    <select style="border: 1px solid;" class="options form-control" name="level_id" id="class">  
										    </select>
                                            <span class="help-block"></span>
										 </div>
                                   	</div>
                                   	<div class="col-md-4">
                                   		<div class="form-group">
										    <label for="section">Section</label><small> *select class</small>
										    <select style="border: 1px solid;" class="options form-control" name="section_id" id="section">
										    </select>
                                            <span class="help-block"></span>
										 </div>
                                   	</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="section_student">Student</label><small> *select class & section</small>
                                            <select style="border: 1px solid;" class="options form-control" name="section_student_id" id="section_student">
                                            </select>
                                            <span class="help-block"></span>
                                         </div>
                                    </div>
                                   	<div class="col-md-3">
                                   		{{-- <div class="form-group">
										    <label for="date_from">Date From</label>
										    <input style="border: 1px solid;" type="text" name="date_from" class="form-control pick-date" id="date_from" placeholder="yyyy-mm-dd" autocomplete="off">
                                            <span class="help-block"></span>
										 </div> --}}
                                         <div class="form-group">
                                            <label for="fiscal_year">Fiscal Year</label> <span class="text-danger">&#9733;</span><small> *select session</small>
                                            <select style="border: 1px solid;" class="options form-control" name="fiscal_year_id" id="fiscal_year">
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                   	</div>
                                    <div class="col-md-3">
                                        {{-- <div class="form-group">
                                            <label for="date_to">Date To</label>
                                            <input style="border: 1px solid;" type="text" name="date_to" class="form-control pick-date" id="date_to" placeholder="yyyy-mm-dd" autocomplete="off">
                                            <span class="help-block"></span>
                                         </div> --}}
                                         <div class="form-group">
                                            <label for="business_month">Business Month</label><small> *select year first</small>
                                            <select style="border: 1px solid;" class="options form-control" name="business_month_id" id="business_month">
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                   	<div class="col-md-3">
                                   		<div class="form-group">
										    <label for="collection_type">Report Type</label>
										    <select style="border: 1px solid;" class="options form-control" name="collection_type" id="collection_type">
										      <option disabled>Select Report Type</option>
										      <option value="1" selected>Collection Report</option>
										      <option value="2">Due Report</option>
										    </select>
                                            <span class="help-block"></span>
										 </div>
                                   	</div>
                                </div>
                                <div class="row">
                                	<div class="col-md-12" style="text-align: center;">
                                		<button type="submit" id="cr_search_btn" class="btn btn-round btn-wd" formtarget="_blank">Search</button>
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
$(document).ready(function(){
    $('#session').change(function(){
        var session=$('#session').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '../get_data',
            type: 'POST',
            data: {
                'session_id':session
            },


            success: function(data) {
                var dataes=JSON.parse(data)
                console.log(dataes);
                var cls=dataes.class;
                var b_m=dataes.business_months;
                var f_y_datas = dataes.f_y_data;
               
                var output1="<option disabled selected>Select Month</option>";
                for(var j =0; j<b_m.length;j++){
                        output1 +='<option value="'+b_m[j].id+'">'+b_m[j].month_name+ '</option>';
                }
                $('#business_month').html(output1);


                fiscal_year_html = '<option disabled>Select Year</option>';
                fiscal_year_html = fiscal_year_html + '<option value="'+f_y_datas.id+'">'+f_y_datas.year+'</option>';
                $('#fiscal_year').html(fiscal_year_html); 



            },
            error:function(){
                alert('Error');
            }
        });
    });
});
</script>


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
    var businessMonths = <?php echo json_encode($business_months);?>;
    var fiscalYears = <?php echo json_encode($fiscal_years);?>;
    
    session_html = '<option disabled selected>Select Specific Session</option>';
    $.each(sessions, function(indexS, valueS) {
        session_html += '<option value="'+valueS.id+'">'+valueS.name+'</option>';
    });
    $('#session').html(session_html);
    $('#session').on('change', function(){
        updateLevel();
        updateFiscalYear();
        updateBusinessMonth();
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

    $('#fiscal_year').on('change', function(){
        updateBusinessMonth();
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

    function updateFiscalYear(){
       
       
    }

    function updateBusinessMonth(){
     
    }

    function refreshForm(){
        $('#cr_search_form').trigger('reset');
        $('#class').empty();
        $('#section').empty();
        $('#section_student').empty();
        $('#fiscal_year').empty();
        $('#business_month').empty();
    }
});
</script>
@endsection
