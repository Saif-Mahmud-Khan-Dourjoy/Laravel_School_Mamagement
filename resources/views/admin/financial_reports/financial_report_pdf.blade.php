<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Financial Report</title>

	<style>
		table {
			border-collapse: collapse;
			width:100%;
		}

		table, th, td {
			border: 1px solid black;
			padding: 5px;
		}
		.col{
			float:left;
			width:45%;
		}
		.head_table td{
			border:none;
			padding-bottom: 0px;
			margin-top:0px;
		}
		.head_table{
			border: 1px dotted;
			margin:0;

		}
	</style>
</head>
<body>
	<div class="row">
		<div style="">
			<div style="margin-bottom: 5px; width:100%; height:60px; text-align: center;">
		<div>
			@php
                $settings = \App\GeneralSetting::first();
                @endphp
             
                    @if($settings != null)
                    
                        <img src="{{asset('site_logo')}}/{{$settings->site_logo}}" style=" width:100px;" alt=""/>
                  
                    @elseif($settings == null)
                     
                        <img src="{{asset('admin/img/demo_logo.png')}}" style="width:100px; padding-left: 35px" alt=""/>
                    
                    @endif
		</div>
			</div>

				
			
		</div>
		<!-- <div style="float:left; width:70%; text-align: center;">
					>
		</div> -->
		<div>
			<h3 style="padding:0px; text-align: center; margin: 0px">{{ settings->site_name }}</h3>
			<h5 style="padding:0px; text-align: center; margin: 0px">FINANCIAL REPORT</h5>
			<p style="padding: 0px; margin: 0px; text-align: center;">Collection Date: {{ (isset($from_date) && $from_date !== NULL)? $from_date: 'All'}} to {{(isset($to_date) && $to_date !== NULL)? $to_date: 'All'}}</p>
		</div>
		<div style="height:500px;">
			@php 
			$grand_total = 0.0;
			$fiscal_year_id = '';
			$business_month_id = '';
			$total = 0.0; 
			$i = 1;
			@endphp
			@foreach($collected_fees as $index => $cf)
			@if($fiscal_year_id != $cf->fiscal_year_id || $business_month_id != $cf->business_month_id)

			@php 
			$fiscal_year_id = $cf->fiscal_year_id;
			$business_month_id = $cf->business_month_id;
			@endphp

			<br>
			<table  style="page-break-inside:avoid">
				<tr style="width:100%;font-size: 12px; font-weight: bold; border:none;">
					<td colspan="2" style="border:none;" ><b>Fiscal Year : </b>{{ $cf->business_month->fiscal_year->year }}</td>
					<td colspan="2" style="border:none; text-align: right"><b>Business Month : </b>{{$cf->business_month->month_name}}</td>
				</tr>
				<tr>
					<th width="50px">SL#</th>
					<th>Class</th>
					<th>Section</th>
					<th>Amount</th>
				</tr>
				@endif
				<tr>
					<td>{{($i<10)?'0'.$i:$i}}</td>
					<td>{{$cf->section_student->section->level_enroll->level->class_name}}</td>
					<td>{{$cf->section_student->section->section_name}}</td>
					<td style="text-align:right;">{{$cf->total_collected}}</td>
				</tr>

				@php 
				$i++; 
				$total += $cf->total_collected; 
				$grand_total+= $cf->total_collected;
				@endphp
				@if(!isset($collected_fees[($index+1)]) || $fiscal_year_id != $collected_fees[($index+1)]->fiscal_year_id || $business_month_id != $collected_fees[($index+1)]->business_month_id)
				<tr>
					<td style="text-align:right;" colspan="3"><b>Total = </b></td>
					<td style="text-align:right;"><b> {{ $total }} </b></td>
				</tr>
			</table>
			@php
			$i= 1;
			$total = 0;
			@endphp
			@endif

			@endforeach
			<br>
			<div style="float:right;">
				<table style="border:none; font-size:14px">
					<tr>
						<td style="text-align: left; border:none; font-weight: bold" >Grand Total = <strong><?php echo number_format((float)$grand_total, 2, '.', '').' BDT.'; ?></strong><br></td>
					</tr>
				</table>
			</div>
		</div>

	</div>
</div>
</body>

</html>