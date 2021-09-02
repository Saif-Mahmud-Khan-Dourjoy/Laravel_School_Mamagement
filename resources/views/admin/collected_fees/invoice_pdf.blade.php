<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Invoice</title>

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
		<div class="col" style="padding-right: 5%; border-right: 1px solid">
		<div style="margin-bottom: 20px; width:100%; height:60px;">
			<div class="logo" style="float:left; width:15%">
				 {{-- <img src="{{asset('admin')}}/img/favicon-final.png" style="width:80px;height:70px;"/> --}}
				@if($settings != null)
					<img src="{{url('').'/site_logo/'.$settings->site_logo}}" style="width:80px; height:70px;"/>
				@endif
			</div>
			<div style="float:left; width:84%; text-align: center;">
				<h3 style="margin:0px; padding:0px">{{$settings->site_name}}</h3>
				<address style="margin:0px; padding:0px">{{$section_student->section->level_enroll->branch->address}}</address>
				<span style="margin:0px; padding:0px">Phone: {{$settings->phone_1}} | {{$settings->phone_2}}</span><br>
				<div>
					<img src="{{asset('admin/img/mailicon.png')}}" style="width:15px;height:13px; vertical-align: middle;"/>
					<span style="text-align: center; margin:0px; padding:0px; font-size: 12px;">{{$settings->email_1}}</span>
				</div>
				<div>
					<img src="{{asset('admin/img/webicon.png')}}" style="width:15px;height:13px;vertical-align: middle;"/>
					<span style="text-align: center; margin:0px; padding:0px; font-size: 12px;"> {{$settings->website}} |</span>
					<img src="{{asset('admin/img/facebook.png')}}" style="width:15px;height:13px;vertical-align: middle;"/> 
					<span style="text-align: center; margin:0px; padding:0px; font-size: 12px;"> {{$settings->facebook}}</span>
				</div>
			</div>
		</div>
			<div style="height:440px;">
				<table class="head_table" style="border:none">
					@if($collected->invoice_id != null)
					<tr>
						<td></td>
						<td  style="text-align: right;"><b>Receipt No:</b><span style="border: 1px dotted;">{{ucfirst($section_student->section->level_enroll->branch->name[0])}}-{{$collected->invoice_id}}</span></td>
					</tr>
					@endif
					<tr>
						<td><b>Session:</b> {{$section_student->section->level_enroll->session->name}}</td>
						<td  style="text-align: right;"><b>Date:</b> {{$collected->collection_date}}</td>
					</tr>
				</table>
				
				<table class="head_table">
					<tr>
						<td style="border-right:1px dotted;"><b>Name:</b> {{$section_student->student->name}}</td>
						<td style="border-right:1px dotted;"><b>Class:</b> {{$section_student->section->level_enroll->level->class_name}}</td>
					</tr>
					<tr>
						<td style="border-right:1px dotted;"><b>Class Roll:</b> {{$section_student->roll}}</td>
						<td style="border-right:1px dotted;"><b>Section:</b> {{$section_student->section->section_name}}</td>
					</tr>
					<tr>
						<td style="border-right:1px dotted;"><b>Shift:</b> {{$section_student->section->level_enroll->shift->shift_name}}</td>
						<td style="border-right:1px dotted;"><b>Month:</b> {{$business_month}}</td>
					</tr>
				</table>
				<br>
				<table>
					<tr>
						<th width="10%">SL#</th>
						<th>Fees Types</th>
						<th>Taka</th>
					</tr>
					@php $i = 1; $total = 0.0; @endphp
					@foreach($section_wise_fees as $value)
					<tr>
						<td>{{$i}}</td>
						<td>{{$value->fees_type->fees_type_name}}</td>
						<td style="text-align: right">{{$value->amount}}</td>
					</tr>
					@php $i++; $total+=$value->amount; @endphp
					@endforeach
					<tr>
						<td colspan="2">Total Payable Amount</td>
						<td style="text-align: right">{{sprintf("%.2f", $total-$collected->discount_amount)}}</td>
					</tr>
					<tr>
						<td colspan="2">Due</td>
						<td style="text-align: right">{{sprintf("%.2f", $collected->total_due)}}</td>
					</tr>
					<tr>
						<td colspan="2">Advanced</td>
						<td style="text-align: right">{{sprintf("%.2f", $collected->total_advanced)}}</td>
					</tr>
					<tr>
						<td colspan="2">Discount Amount</td>
						<td style="text-align: right">{{sprintf("%.2f", $collected->discount_amount)}}</td>
					</tr>
					<tr>
						<td colspan="2"><b>Total</b></td>
						<td style="text-align: right"><b>{{sprintf("%.2f", $collected->total_collected)}}</b></td>
					</tr>
					<tr>
						<td colspan="3"><b>Total Paid in Word: ({{$collected->total_collected_word}} Only)</b></td>
					</tr>
				</table>
			</div>
			<div style="float:left; margin-left:5%; margin-bottom: 15px; text-align: center; width:100%">
				<div style="float:left; width:33%">
					...............<br>
					Parents/Student
				</div>
				<div style="float:left; width:33%">
					...............<br>
					Cashier
				</div>
				<div style="float:left; width:33%">
					................<br>
					Officer
				</div>
			</div>
			 <div width="100%" style="float:left; font-size:10px; text-align:center;">
			 	<div style="width: 33%; text-align: center; border: 1px dotted; padding:2px; float:left; font-size:10px;">
				Print Date<br>
				{{date('M d Y')}}
				</div>
				<div  style="width: 33%;">
					
				</div>
                <div style="width: 33%; float:right;">
                    <h4 style="margin-top: 5px;margin-bottom: 0px; padding-top: 5px;">Student Copy</h4>
                </div>
             </div>
		</div>
		<div class="col" style="margin-left: 5%;">
			<div style="margin-bottom: 20px; width:100%; height:60px;">
			<div class="logo" style="float:left; width:15%;">
				 {{-- <img src="{{asset('admin')}}/img/favicon-final.png" style="width:80px;height:70px;"/> --}}
				 @if($settings != null)
					<img src="{{url('').'/site_logo/'.$settings->site_logo}}" style="width:80px; height:70px;"/>
				@endif
			</div>
			<div style="float:left; width:84%; text-align: center;">
				<h3 style="margin:0px; padding:0px">{{$settings->site_name}}</h3>
				<address style="margin:0px; padding:0px">{{$section_student->section->level_enroll->branch->address}}</address>
				<span style="margin:0px; padding:0px">Phone: {{$settings->phone_1}} | {{$settings->phone_2}}</span><br>
				<div>
					<img src="{{asset('admin/img/mailicon.png')}}" style="width:15px;height:13px; vertical-align: middle;"/>
					<span style="text-align: center; margin:0px; padding:0px; font-size: 12px;">{{$settings->email_1}}</span>
				</div>
				<div>
					<img src="{{asset('admin/img/webicon.png')}}" style="width:15px;height:13px;vertical-align: middle;"/>
					<span style="text-align: center; margin:0px; padding:0px; font-size: 12px;"> {{$settings->website}} |</span>
					<img src="{{asset('admin/img/facebook.png')}}" style="width:15px;height:13px;vertical-align: middle;"/> 
					<span style="text-align: center; margin:0px; padding:0px; font-size: 12px;"> {{$settings->facebook}}</span>
				</div>
			</div>
		</div>
			<div style="height:430px;">
				<table class="head_table" style="border:none">
					@if($collected->invoice_id != null)
					<tr>
						<td></td>
						<td  style="text-align: right;"><b>Receipt No:</b><span style="border: 1px dotted;">{{ucfirst($section_student->section->level_enroll->branch->name[0])}}-{{$collected->invoice_id}}</span></td>
					</tr>
					@endif
					<tr>
						<td><b>Session:</b> {{$section_student->section->level_enroll->session->name}}</td>
						<td  style="text-align: right;"><b>Date:</b> {{$collected->collection_date}}</td>
					</tr>
				</table>
				
				<table class="head_table">
					<tr>
						<td style="border-right:1px dotted;"><b>Name:</b> {{$section_student->student->name}}</td>
						<td style="border-right:1px dotted;"><b>Class:</b> {{$section_student->section->level_enroll->level->class_name}}</td>
					</tr>
					<tr>
						<td style="border-right:1px dotted;"><b>Class Roll:</b> {{$section_student->roll}}</td>
						<td style="border-right:1px dotted;"><b>Section:</b> {{$section_student->section->section_name}}</td>
					</tr>
					<tr>
						<td style="border-right:1px dotted;"><b>Shift:</b> {{$section_student->section->level_enroll->shift->shift_name}}</td>
						<td style="border-right:1px dotted;"><b>Month:</b> {{$business_month}}</td>
					</tr>
				</table>
				<br>
				<table>
					<tr>
						<th width="10%">SL#</th>
						<th>Fees Types</th>
						<th>Taka</th>
					</tr>
					@php $i = 1; $total = 0.0; @endphp
					@foreach($section_wise_fees as $value)
					<tr>
						<td>{{$i}}</td>
						<td>{{$value->fees_type->fees_type_name}}</td>
						<td style="text-align: right">{{$value->amount}}</td>
					</tr>
					@php $i++; $total+=$value->amount; @endphp
					@endforeach
					<tr>
						<td colspan="2">Total Payable Amount</td>
						<td style="text-align: right">{{sprintf("%.2f", $total-$collected->discount_amount)}}</td>
					</tr>
					<tr>
						<td colspan="2">Due</td>
						<td style="text-align: right">{{sprintf("%.2f", $collected->total_due)}}</td>
					</tr>
					<tr>
						<td colspan="2">Advanced</td>
						<td style="text-align: right">{{sprintf("%.2f", $collected->total_advanced)}}</td>
					</tr>
					<tr>
						<td colspan="2">Discount Amount</td>
						<td style="text-align: right">{{sprintf("%.2f", $collected->discount_amount)}}</td>
					</tr>
					<tr>
						<td colspan="2"><b>Total</b></td>
						<td style="text-align: right"><b>{{sprintf("%.2f", $collected->total_collected)}}</b></td>
					</tr>
					<tr>
						<td colspan="3"><b>Total Paid in Word: ({{$collected->total_collected_word}} Only)</b></td>
					</tr>
				</table>
			</div>
			<div style="float:left; margin-left:5%; margin-bottom: 25px; text-align: center; width:100%">
				<div style="float:left; width:33%">
					...............<br>
					Parents/Student
				</div>
				<div style="float:left; width:33%">
					...............<br>
					Cashier
				</div>
				<div style="float:left; width:33%">
					...............<br>
					Officer
				</div>
			</div>
			 <div width="100%" style="float:left; font-size:10px; text-align:center;">
			 	<div style="width: 33%; text-align: center; border: 1px dotted; padding:2px; float:left; font-size:10px;">
				Print Date<br>
				{{date('M d Y')}}
				</div>
				<div  style="width: 33%;">
					
				</div>
                <div style="width: 33%; float:right;">
                    <h4 style="margin-top: 5px;margin-bottom: 0px; padding-top: 5px;">Office Copy</h4>
                </div>
             </div>
		</div>
	</div>

</body>

</html>