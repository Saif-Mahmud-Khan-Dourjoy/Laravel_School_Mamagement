<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Financial Report of {{isset($collected_fees[0]) ? $collected_fees[0]->student->name:""}}</title>

	<style>
		table {
			border-collapse: collapse;
			width:100%;
		}

		table, th, td {
			border: 1px solid black;
			padding: 5px;
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
		<div style="margin-bottom: 20px; width:100%; height:3.5cm; text-align: center;">
			

			<div style="margin-bottom: 5px;   text-align: center;  height:1.7 cm;">
			
				@php
                $settings = \App\GeneralSetting::get('site_logo')->first();
				$sts = \App\GeneralSetting::first();
                @endphp
                <div class="logo" style="text-align: center;">
                    @if($settings != null)
                 
                        <img src="{{asset('site_logo')}}/{{$settings->site_logo}}" style="width:80px;" alt=""/>
              
                    @elseif($settings == null)
                 
                        <img src="{{asset('admin/img/demo_logo.png')}}" style="width:80px;" alt=""/>
             
                    @endif
				</div>
			</div>
			<div style="width:100%; height:1.7 cm;">
				<h3 style="margin:0px; padding:0px">{{ $sts->site_name }}</h3>
				<address style="margin:0px; padding:0px">
					{{isset($collected_fees[0]) ? $collected_fees[0]->section_student->section->level_enroll->branch->name: "" }},{{isset($collected_fees[0]) ? $collected_fees[0]->section_student->section->level_enroll->branch->address: "" }}
				</address>
				<span style="margin:0px; padding:0px">
					Phone:{{isset($collected_fees[0]) ? $collected_fees[0]->section_student->section->level_enroll->branch->contact_no: "" }}
				</span>
			</div>
		</div>
	</div>

		
		<div>
			<table class="head_table" style="border:none">
				<tr>
					<td style="text-align: right;"><b>Session:</b> {{isset($collected_fees[0]) ? $collected_fees[0]->section_student->section->level_enroll->session->name:""}}</td>
					<!-- <td  style="text-align: right;"><b>Date:</b> {{isset($collected_fees[0]) ? $collected_fees[0]->collection_date:""}}</td> -->
				</tr>
			</table>

			<table class="head_table">
				<tr>
					<td style="border-right:1px dotted;"><b>Name:</b> {{isset($student) ? $student->name:""}}</td>
					<td style="border-right:1px dotted;"><b>Class:</b> {{isset($collected_fees[0]) ? $collected_fees[0]->section_student->section->level_enroll->level->class_name:""}}</td>
				</tr>
				<tr>
					<td style="border-right:1px dotted;"><b>Class Roll:</b> {{isset($collected_fees[0]) ? $collected_fees[0]->section_student->roll:""}}</td>
					<td style="border-right:1px dotted;"><b>Section:</b> {{isset($collected_fees[0]) ? $collected_fees[0]->section_student->section->section_name:""}}</td>
				</tr>
			
			</table>
				<br>
				

			<table>
				<tr>
					<th>SL#</th>
					<th>Business Month</th>
					<th>Collection Date</th>
					<!-- <th width="400px">Fees Types/Head</th> -->
					<th>Discount</th>
					<th>Total Due</th>
					<th>Total Collected</th>
				</tr>
				@php $i = 1; $total = 0.0; @endphp
				@foreach($collected_fees as $cf)
				
				<tr>
					<td>{{$i}}</td>
					<td>{{$cf->business_month->month_name}}</td>
					<td>{{$cf->collection_date}}</td>
					<td style="text-align: right">{{$cf->discount_amount}}</td>
					<td style="text-align: right" >{{$cf->total_due}}</td>
					<td style="text-align: right">{{$cf->total_collected}}</td>
					
					@php $i++; $total += $cf->total_collected; @endphp
				</tr>
				@endforeach
				    
					<td colspan="5" style="text-align: right" >Total = </td>
					<td style="text-align: right">{{ $total }}</td>
				
			</table>
		</div>
	</body>

	</html>