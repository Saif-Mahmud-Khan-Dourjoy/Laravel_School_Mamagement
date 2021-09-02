@section('heading')
    Monthly Fees Calculation Report
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
                    <h5 class="title" align="center"><strong>Generate Monthly Fees Collection Report</strong></h5>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li> {{ $error }} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="panel-body">
                    <div style="padding-top: 2px;">
                        <div style="background-color: lightgray; padding: 10px;">
                            <form id="search_form1">
                                <div class="form-group row">
                                   	<div class="col-md-3">
                                   		<div class="form-group">
										    <label for="from_date">From Date</label>
										    <input type="text" name="from_date" class="form-control pick-date" id="from_date" placeholder="yyyy-mm-dd" autocomplete="off">
										 </div>
                                   	</div>
                                   	<div class="col-md-3">
                                   		<div class="form-group">
										    <label for="to_date">To Date</label>
										    <input type="text" name="to_date" class="form-control pick-date" id="to_date" placeholder="yyyy-mm-dd" autocomplete="off">
										 </div>
                                   	</div>
                                   	<div class="col-md-3">
                                   		<div class="form-group">
										    <label for="fiscal_year">Fiscal Year</label>
										    <select class="form-control" name="fiscal_year" id="fiscal_year">
										    </select>
										</div>
                                   	</div>
                                   	<div class="col-md-3">
                                   		<div class="form-group">
										    <label for="business_month">Business Month</label>
										    <select class="form-control" name="business_month" id="business_month">
										    </select>
										 </div>
                                   	</div>
                                </div>
                                <div class="row">
                                	<div class="col-md-3">
                                   		<div class="form-group">
										    <label for="fees_type">Fees Type</label>
										    <select class="form-control" name="fees_type" id="fees_type">  
										    </select>
										 </div>
                                   	</div>
                                   	<div class="col-md-3">
                                   		<div class="form-group">
										    <label for="collection_type">Collection Type</label>
										    <select class="form-control" name="collection_type" id="collection_type">
										      <option disabled selected>Select Collection Type</option>
										      <option value="1">Due</option>
										      <option value="2">Collected</option>
										      <option value="3">Both</option>
										    </select>
										 </div>
                                   	</div>
                                   	<div class="col-md-3" style="text-align: left; padding-left: 0px;">
                                   		<button  style="margin-top: 30px;" type="button" id="refresh_btn" class="btn btn-info btn-sm btn-round"><i class="fa fa-refresh text-info"></i></button>
                                   	</div>
                                </div>
                                <div class="row">
                                	<div class="col-md-12" style="text-align: center;">
                                		<button type="button" id="search_btn" class="btn btn-danger btn-round btn-wd">Search</button>
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
<div class="container-fluid" id="showing_collection_div">
</div>
<script type="text/javascript">
window.addEventListener('load', function(){
	$(function(){
        $('.pick-date').datetimepicker({
        	timepicker:false,
        	format: 'Y-m-d'
        });
    });
	var fiscal_years = <?php echo json_encode($fiscal_years); ?>;
	var fees_types = <?php echo json_encode($fees_types); ?>;
	var business_months = <?php echo json_encode($business_months); ?>;
	fy_html = '<option disabled selected>Select Fiscal Year</option>';
	ft_html = '<option disabled selected>Select Fees Type</option>';
	$.each(fiscal_years, function(index, value){
		fy_html += '<option value="'+value.id+'">'+ value.year +'</option>';
	});
	$.each(fees_types, function(index, value){
		ft_html += '<option value="'+value.id+'">'+ value.fees_type_name +'</option>';
	});
	$('#fiscal_year').html(fy_html);
	$('#fees_type').html(ft_html);
	$('#fiscal_year').on('change', function(){
	    var id = this.value;
		bm_html = '<option disabled selected>Select Business Month</option>';
		$.each(business_months, function(index, value){
			if(value.fiscal_year_id == id){
				bm_html += '<option value="'+value.id+'">'+ value.month_name +'</option>';
			}
		});
	$('#business_month').html(bm_html);
	});
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	$(document).on('click','#search_btn', function(){
		$.ajax({
			url : jsUtlt.siteUrl('/monthly_collection_report'),
			type: "POST",
			data: $('#search_form1').serialize()
		}).done(function(resdata){
			$('#showing_collection_div').empty();
			$('#showing_collection_div').append(resdata);
		}).fail(function(faildata){
			alert("can not search report !!");
		});
	});

	$(document).on('click','#refresh_btn', function(){
		$('#search_form1').trigger('reset');
		$('#business_month').empty();
	});
});
</script>
@endsection
