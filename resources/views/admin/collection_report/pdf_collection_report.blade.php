<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Collection Report</title>
	<style>
		table {
			border-collapse: collapse;
			width:100%;
		}

		table, th, td {
			border: 1px solid black;
			padding: 5px;
		}
	</style>
</head>
<body>
	<div class="row">
		<div style="margin-bottom: 20px; width:100%; height:60px;">
			<div class="logo" style="float:left; width:15%; margin-right: -15px;">
				 <img src="{{asset('site_logo')}}/{{$settings->site_logo}}" style="width:80px;height:70px; margin-top:15px;"/>
			</div>
			<div style="float:left; width:80%; text-align: center;">
				<h3 style="margin:0px; padding:0px">{{$settings->site_name}}</h3>
				<address style="margin:0px; padding:0px">{{$settings->address_1}}</address>
				<span style="margin:0px; padding:0px">Phone:  {{$settings->phone_1}} | {{$settings->phone_2}}</span><br>
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
	</div>

		@php
			if(isset($search_for['session_id'])){
				$session = \App\Session::where('id', $search_for['session_id'])->first('name');
			}

			if(isset($search_for['level_id'])){
				$level = \App\Level::where('id', $search_for['level_id'])->first('class_name');
			}

			if(isset($search_for['section_id'])){
				$section = \App\Section::where('id', $search_for['section_id'])->first();
				$teacher = \App\Teacher::where('id', $section->teacher_id)->first('teacher_name');
			}

			if(isset($search_for['section_student_id'])){
				$student = \App\Student::where('id', $search_for['section_student_id'])->first('name');
			}

			if(isset($search_for['fiscal_year_id'])){
				$fiscal_year = \App\FiscalYear::where('id', $search_for['fiscal_year_id'])->first('year');
			}

			if(isset($search_for['business_month_id'])){
				$business_month = \App\BusinessMonth::where('id', $search_for['business_month_id'])->first('month_name');
			}
			
		@endphp
		{{-- {{dd($teacher)}} --}}

	{{-- Report-1: student wise collection report for specific year --}}	

		@if(isset($search_for['session_id']) == true
			&& isset($search_for['level_id']) == true
			&& isset($search_for['section_id']) == true
			&& isset($search_for['section_student_id']) == true
			&& isset($search_for['fiscal_year_id']) == true
			&& isset($search_for['business_month_id']) == false
			&& isset($search_for['collection_type']) == true)

			

			<div class="row">

				@if($search_for['collection_type'] == 1)
					<p style="text-align: center; font-size: 15px;"><b>Collection Report</b>
					<strong>of {{ucfirst($student->name)}}</strong></p>

				@elseif($search_for['collection_type'] == 2)
					<p style="text-align: center; font-size: 15px;"><b>Yearly Due Report</b>
					<strong>of {{ucfirst($student->name)}}</strong></p>
				@endif
				
				<table style="border: none; margin-bottom: 20px;">
					<tr style="border:none;">
						<td style="border:none;">
							<p style="text-align: left; font-size: 13px;"><strong>Session:</strong> {{$session->name}}</p>
						</td>
						<td style="border:none;">
							<p style="text-align: left; font-size: 13px;"><strong>Class:</strong> {{$level->class_name}}</p>
						</td>
						<td style="border:none;">
							<p style="text-align: left; font-size: 13px;"><strong>Section:</strong> {{$section->section_name}}</p>
						</td>
						<td style="border:none;">
							<p style="text-align: left; font-size: 13px;"><strong>Year:</strong> {{$fiscal_year->year}}</p>
						</td>
					</tr>				
				</table>
			</div>
			<div>
				<table width="100%">
					<thead>
						<tr>
							@if($search_for['collection_type'] == 1)
								<th style="">SL#</th>
								<th style="">Month</th>
								<th style="">Due Amount</th>
								<th style="">Collected Amount</th>

							@elseif($search_for['collection_type'] == 2)
								<th style="">SL#</th>
								<th style="">Month</th>
								<th style="">Due Amount</th>
							@endif
						</tr>
					</thead>
					<tbody>
						@php
							$i = 1;
							$total_collected = 0;
							$total_due = 0;
							$grand_collection = 0;
							$grand_due = 0;
						@endphp
						@foreach($collections as $month => $collection)
							@php
								foreach($collection as $total => $data){
									$total_collected += $data->total_collected;
									$total_due += $data->total_due;	
								}
								$grand_collection += $total_collected;
								$grand_due += $total_due;
							@endphp
							<tr>
								<td style="text-align: center;">{{$i}}</td>
								<td style="text-align: center;">{{$month}}</td>
								<td style="text-align: center;">{{sprintf("%.2f", $total_due)}}</td>

								@if($search_for['collection_type'] == 1)
									<td style="text-align: center;">{{sprintf("%.2f", $total_collected)}}</td>
								@endif

							</tr>
							@php
								$i++;
								$total_collected = 0;
								$total_due = 0;
							@endphp
						@endforeach
						<tr>

								<td colspan="2" style="text-align: right;"><strong>Total =</strong></td>
								<td style="text-align: center;">{{sprintf("%.2f", $grand_due)}}</td>

								@if($search_for['collection_type'] == 1)
									<td style="text-align: center;">{{sprintf("%.2f", $grand_collection)}}</td>
								@endif
						</tr>
					</tbody>
				</table>

				@if($search_for['collection_type'] == 1)
						@php
							if($grand_collection == 0.00){
								$grand_collection = 0;
							}
						@endphp
					<p style="padding-top: 30px;"><strong>Total Yearly Collection is {{ucwords($numberTransformer->toWords($grand_collection))}} Taka.</strong></p>

				@elseif($search_for['collection_type'] == 2)
						@php
							if($grand_due == 0.00){
								$grand_due = 0;
							}
						@endphp
					<p style="padding-top: 30px;"><strong>Total Yearly Due is {{ucwords($numberTransformer->toWords($grand_due))}} Taka.</strong></p>
				@endif
			</div>
			{{-- End of Report-1  --}}

	{{-- Report-2: session or branch  wise collection report for specific year--}}	

			
		@elseif(isset($search_for['session_id']) == true
				&& isset($search_for['level_id']) == false
				&& isset($search_for['section_id']) == false
				&& isset($search_for['section_student_id']) == false
				&& isset($search_for['fiscal_year_id']) == true
				&& isset($search_for['business_month_id']) == false
				&& isset($search_for['collection_type']) == true)

			<div class="row">
				<p style="text-align: center; font-size: 15px;">
				@if($search_for['collection_type'] == 1)
					<b>Collection Report</b>
				@elseif($search_for['collection_type'] == 2)
					<b>Due Report</b>
				@endif
					<strong>For {{$session->name}}</strong><br><small>{{$fiscal_year->year}}</small></p>
			</div>
			<div>
				<table width="100%">
					<thead>
						<tr>
							<th style="">SL#</th>
							<th style="">Class Teacher</th>
							<th style="">Class</th>
							<th style="">Section</th>
							{{-- <th style="">Expected Amount</th> --}}
							<th style="">Due Amount</th>
							@if($search_for['collection_type'] == 1)
								<th style="">Collected Amount</th>
							@endif
						</tr>
					</thead>
					<tbody>
						@php
							$i = 1;
							$total_collected = 0;
							$total_due = 0;
							$grand_collection = 0;
							$grand_due = 0;
						@endphp
						@foreach($collections as $key => $collection)
							@php
								$sections = $collection->groupBy('section_name');
							@endphp
							@foreach($sections as $section_name => $details)
									@php
											foreach($details as $detail){
												$total_collected += $detail->total_collected;
												$total_due += $detail->total_due;
											}
									@endphp
									<tr>
										<td style="text-align: center;">@php echo $i; @endphp</td>
										<td style="text-align: left;">{{$detail->teacher_name}}</td>
										<td style="text-align: center;">{{$key}}</td>
										<td style="text-align: center;">{{$section_name}}</td>
									{{-- 	<td style="text-align: center;"></td> --}}
										<td style="text-align: center;">{{sprintf("%.2f", $total_due)}}</td>
										@if($search_for['collection_type'] == 1)
											<td style="text-align: center;">{{sprintf("%.2f", $total_collected)}}</td>
										@endif
									</tr>
									@php
										$grand_collection += $total_collected;
										$grand_due += $total_due;
									@endphp
							@endforeach
						@php
							$i++;
							$total_collected = 0;
							$total_due = 0;
						@endphp
						@endforeach
							<tr>
								<td colspan="3" style="text-align: right;"><strong>Total =</strong></td>
								<td></td>
								<td style="text-align: center;">{{sprintf("%.2f", $grand_due)}}</td>
								@if($search_for['collection_type'] == 1)
								<td style="text-align: center;">{{sprintf("%.2f", $grand_collection)}}</td>
								@endif
							</tr>
					</tbody>
				</table>
				@if($search_for['collection_type'] == 1)
					@php
						if($grand_collection == 0.00){
							$grand_collection = 0;
						}
					@endphp
					<p style="padding-top: 30px;"><strong>Total Collection is {{ucwords($numberTransformer->toWords($grand_collection))}} Taka.</strong></p>
				@elseif($search_for['collection_type'] == 2)
					@php
						if($grand_due == 0.00){
							$grand_due = 0;
						}
					@endphp
					<p style="padding-top: 30px;"><strong>Total Due is {{ucwords($numberTransformer->toWords($grand_due))}} Taka.</strong></p>
				@endif

			</div>
			{{-- End of Report-2  --}}

	{{-- Report-3: class wise collection report for specific year --}}	

			@elseif(isset($search_for['session_id']) == true
				&& isset($search_for['level_id']) == true
				&& isset($search_for['section_id']) == true
				&& isset($search_for['section_student_id']) == false
				&& isset($search_for['fiscal_year_id']) == true
				&& isset($search_for['business_month_id']) == false
				&& isset($search_for['collection_type']) == true)

				<div class="row">
				
					<p style="text-align: center; font-size: 15px;"><b>Yearly 
						@if($search_for['collection_type'] == 1) 
							Collection Report</b>
						@elseif($search_for['collection_type'] == 2)
							Due Report</b>
						@endif 
					<strong>of Class {{$level->class_name}}</strong><br><small><strong>Class Teacher- </strong>{{$teacher->teacher_name}}</small>
				</p>
				<table style="border: none; margin-bottom: 20px;">
					<tr style="border:none;">
						<td style="border:none;">
							<p style="text-align: left; font-size: 13px;"><strong>Session:</strong> {{$session->name}}</p>
						</td>
						<td style="border:none;">
							<p style="text-align: left; font-size: 13px;"><strong>Section:</strong> {{$section->section_name}}</p>
						</td>
						<td style="border:none;">
							<p style="text-align: left; font-size: 13px;"><strong>Year:</strong> {{$fiscal_year->year}}</p>
						</td>
					</tr>				
				</table>
			</div>
			<div>
				<table width="100%">
					<thead>
						<tr>
							<th style="">SL#</th>
							<th style="">Student Name</th>
							<th style="">Roll</th>
							<th style="">Due Amount</th>

							@if($search_for['collection_type'] == 1) 
								<th style="">Collected Amount</th>
							@elseif($search_for['collection_type'] == 2)
								<th style="">Contact No</th>
							@endif
						</tr>
					</thead>
					<tbody>
						@php
							$i = 1;
							$total_collected = 0;
							$total_due = 0;
							$grand_collection = 0;
							$grand_due = 0;
						@endphp
						@foreach($collections as $student_name => $collection)
							@php
								$collection = $collection->groupBy('roll');
							@endphp
							@foreach($collection as $roll => $collection)
								@php
									foreach($collection as $total => $data){
										$total_collected += $data->total_collected;
										$total_due += $data->total_due;	
									}
								@endphp
								<tr>
									<td style="text-align: center;">{{$i}}</td>
									<td style="text-align: left; padding-left: 15px;">{{$student_name}}</td>
									<td style="text-align: center;">{{$roll}}</td>
									<td style="text-align: center;">{{sprintf("%.2f", $total_due)}}</td>

									@if($search_for['collection_type'] == 1)
										<td style="text-align: center;">{{sprintf("%.2f", $total_collected)}}</td>
									@elseif($search_for['collection_type'] == 2)
										<td style="text-align: center;">{{$data->contact_no}}</td>
									@endif
								</tr>
									@php
										$grand_collection += $total_collected;
										$grand_due += $total_due;
									@endphp
								@endforeach
							@php
								$i++;
								$total_collected = 0;
								$total_due = 0;
							@endphp
						@endforeach
						<tr>
							<td colspan="3" style="text-align: right;"><strong>Total =</strong></td>
							<td style="text-align: center;">{{sprintf("%.2f", $grand_due)}}</td>
							@if($search_for['collection_type'] == 1)
							<td style="text-align: center;">{{sprintf("%.2f", $grand_collection)}}</td>
							@endif
						</tr>
					</tbody>
				</table>
				@if($search_for['collection_type'] == 1)
					@php
						if($grand_collection == 0.00){
							$grand_collection = 0;
						}
					@endphp
					<p style="padding-top: 30px;"><strong>Yearly Total Collection is {{ucwords($numberTransformer->toWords($grand_collection))}} Taka.</strong></p>
				@elseif($search_for['collection_type'] == 2)
					@php
						if($grand_due == 0.00){
							$grand_due = 0;
						}
					@endphp
					<p style="padding-top: 30px;"><strong>Yearly Total Due is {{ucwords($numberTransformer->toWords($grand_due))}} Taka.</strong></p>
				@endif
			</div>
			{{-- End of Report-3 --}}

	{{-- Report-4: session wise monthly collection report for specific year --}}

		@elseif(isset($search_for['session_id']) == true
				&& isset($search_for['level_id']) == false
				&& isset($search_for['section_id']) == false
				&& isset($search_for['section_student_id']) == false
				&& isset($search_for['fiscal_year_id']) == true
				&& isset($search_for['business_month_id']) == true
				&& isset($search_for['collection_type']) == true)

		
			<div class="row">
				<p style="text-align: center; font-size: 15px;">
				@if($search_for['collection_type'] == 1)
					<b>Collection Report</b>
				@elseif($search_for['collection_type'] == 2)
					<b>Due Report</b>
				@endif
				<strong>of {{ucfirst($business_month->month_name)}} of {{ucfirst($session->name)}} Session</strong><br><small>{{$fiscal_year->year}}</small></p>

			</div>
			<div>
				<table width="100%">
					<thead>
						<tr>
							<th style="">SL#</th>
							<th style="">Class Teacher</th>
							<th style="">Class</th>
							<th style="">Section</th>
							{{-- <th style="">Expected Amount</th> --}}
							<th style="">Due Amount</th>
							@if($search_for['collection_type'] == 1)
								<th style="">Collected Amount</th>
							@endif
						</tr>
					</thead>
					<tbody>
						@php
							$i = 1;
							$total_collected = 0;
							$total_due = 0;
							$grand_collection = 0;
							$grand_due = 0;
						@endphp
						@foreach($collections as $key => $collection)
							@php
								$sections = $collection->groupBy('section_name');
							@endphp
							@foreach($sections as $section_name => $details)
									@php
											foreach($details as $detail){
												$total_collected += $detail->total_collected;
												$total_due += $detail->total_due;
											}
									@endphp
									<tr>
										<td style="text-align: center;">@php echo $i; @endphp</td>
										<td style="text-align: left;">{{$detail->teacher_name}}</td>
										<td style="text-align: center;">{{$key}}</td>
										<td style="text-align: center;">{{$section_name}}</td>
									{{-- 	<td style="text-align: center;"></td> --}}
										<td style="text-align: center;">{{sprintf("%.2f", $total_due)}}</td>
										@if($search_for['collection_type'] == 1)
											<td style="text-align: center;">{{sprintf("%.2f", $total_collected)}}</td>
										@endif
									</tr>
									@php
										$grand_collection += $total_collected;
										$grand_due += $total_due;
									@endphp
							@endforeach
						@php
							$i++;
							$total_collected = 0;
							$total_due = 0;
						@endphp
						@endforeach
							<tr>
								<td colspan="4" style="text-align: right;"><strong>Total =</strong></td>
								{{-- <td></td> --}}
								<td style="text-align: center;">{{sprintf("%.2f", $grand_due)}}</td>
								@if($search_for['collection_type'] == 1)
									<td style="text-align: center;">{{sprintf("%.2f", $grand_collection)}}</td>
								@endif
							</tr>
					</tbody>
				</table>
				@if($search_for['collection_type'] == 1)
					@php
						if($grand_collection == 0.00){
							$grand_collection = 0;
						}
					@endphp
					<p style="padding-top: 30px;"><strong>Total Collection is {{ucwords($numberTransformer->toWords($grand_collection))}} Taka.</strong></p>
				@elseif($search_for['collection_type'] == 2)
					@php
						if($grand_due == 0.00){
							$grand_due = 0;
						}
					@endphp
					<p style="padding-top: 30px;"><strong>Total Due is {{ucwords($numberTransformer->toWords($grand_due))}} Taka.</strong></p>
				@endif
			</div>
			{{-- End of Report-4 --}}

	{{-- Report-5: class wise collection report for specific year and specific Month --}}

			@elseif(isset($search_for['session_id']) == true
				&& isset($search_for['level_id']) == true
				&& isset($search_for['section_id']) == true
				&& isset($search_for['section_student_id']) == false
				&& isset($search_for['fiscal_year_id']) == true
				&& isset($search_for['business_month_id']) == true
				&& isset($search_for['collection_type']) == true)

				<div class="row">
				@if($search_for['collection_type'] == 1)
					<p style="text-align: center; font-size: 15px;"><b>Monthly Collection Report</b>
					<strong>of Class {{ucfirst($level->class_name)}}</strong><br><small><strong>Class Teacher-</strong> {{$teacher->teacher_name}}</small>

				@elseif($search_for['collection_type'] == 2)
					<p style="text-align: center; font-size: 15px;"><b>Monthly Due Report</b>
					<strong>of Class {{ucfirst($level->class_name)}}</strong><br><small><strong>Class Teacher-</strong> {{$teacher->teacher_name}}</small>
				@endif
				</p>
				<table style="border: none; margin-bottom: 20px;">
					<tr style="border:none;">
						<td style="border:none;">
							<p style="text-align: left; font-size: 13px;"><strong>Session:</strong> {{$session->name}}</p>
						</td>
						<td style="border:none;">
							<p style="text-align: left; font-size: 13px;"><strong>Section:</strong> {{$section->section_name}}</p>
						</td>
						<td style="border:none;">
							<p style="text-align: left; font-size: 13px;"><strong>Month:</strong> {{$business_month->month_name}}</p>
						</td>
						<td style="border:none;">
							<p style="text-align: left; font-size: 13px;"><strong>Year:</strong> {{$fiscal_year->year}}</p>
						</td>
					</tr>				
				</table>
			</div>
			<div>
				<table width="100%">
					<thead>
						<tr>
							<th style="">SL#</th>
							<th style="">Student Name</th>
							<th style="">Roll</th>
							<th style="">Due Amount</th>

							@if($search_for['collection_type'] == 1)
								<th style="">Collected Amount</th>
							@elseif($search_for['collection_type'] == 2)
								<th style="">Contact No</th>
							@endif
						</tr>
					</thead>
					<tbody>
						@php
							$i = 1;
							$total_collected = 0;
							$total_due = 0;
							$grand_collection = 0;
							$grand_due = 0;
						@endphp
						@foreach($collections as $student_name => $collection)
							@php
								$collection = $collection->groupBy('roll');
							@endphp
							@foreach($collection as $roll => $collection)
								@php
									foreach($collection as $total => $data){
										$total_collected += $data->total_collected;
										$total_due += $data->total_due;	
									}
								@endphp
								<tr>
									<td style="text-align: center;">{{$i}}</td>
									<td style="text-align: left; padding-left: 15px;">{{$student_name}}</td>
									<td style="text-align: center;">{{$roll}}</td>
									<td style="text-align: center;">{{sprintf("%.2f", $total_due)}}</td>

									@if($search_for['collection_type'] == 1)
										<td style="text-align: center;">{{sprintf("%.2f", $total_collected)}}</td>
									@elseif($search_for['collection_type'] == 2)
										<td style="text-align: center;">{{$data->contact_no}}</td>
									@endif

								</tr>
									@php
										$grand_collection += $total_collected;
										$grand_due += $total_due;
									@endphp
								@endforeach
							@php
								$i++;
								$total_collected = 0;
								$total_due = 0;
							@endphp
						@endforeach
						<tr>
							<td colspan="3" style="text-align: right;"><strong>Total =</strong></td>
							<td style="text-align: center;">{{sprintf("%.2f", $grand_due)}}</td>

							@if($search_for['collection_type'] == 1)
								<td style="text-align: center;">{{sprintf("%.2f", $grand_collection)}}</td>
							@endif
						</tr>
					</tbody>
				</table>
				@if($search_for['collection_type'] == 1)
					@php
						if($grand_collection == 0.00){
							$grand_collection = 0;
						}
					@endphp
					<p style="padding-top: 30px;"><strong>Total Collection of {{$business_month->month_name}} is {{ucwords($numberTransformer->toWords($grand_collection))}} Taka.</strong></p>
				@elseif($search_for['collection_type'] == 2)
					@php
						if($grand_due == 0.00){
							$grand_due = 0;
						}
					@endphp
					<p style="padding-top: 30px;"><strong>Total Due of {{$business_month->month_name}} is {{ucwords($numberTransformer->toWords($grand_due))}} Taka.</strong></p>
				@endif
			</div>
		{{-- End of Report-5 --}}

	{{-- Report-6: class wise collection report for specific year && specific month --}}	

		@elseif(isset($search_for['session_id']) == true
			&& isset($search_for['level_id']) == true
			&& isset($search_for['section_id']) == true
			&& isset($search_for['section_student_id']) == false
			&& isset($search_for['fiscal_year_id']) == true
			&& isset($search_for['business_month_id']) == true
			&& isset($search_for['collection_type']) == true)

				
				<div class="row">
				<p style="text-align: center; font-size: 15px;">
				@if($search_for['collection_type'] == 1)
					<b>Collection Report</b>
				@elseif($search_for['collection_type'] == 2)
					<b>Due Report</b>
				@endif
					<strong>of {{ucfirst($business_month->month_name)}} of {{ucfirst($session->name)}} Session</strong>
				</p>
				<table style="border: none; margin-bottom: 20px;">
					<tr style="border:none;">
						<td style="border:none;">
							<p style="text-align: left; font-size: 13px;"><strong>Class:</strong> {{$level->class_name}}</p>
						</td>
						<td style="border:none;">
							<p style="text-align: left; font-size: 13px;"><strong>Section:</strong> {{$section->section_name}}</p>
						</td>
						<td style="border:none;">
							<p style="text-align: left; font-size: 13px;"><strong>Class Teacher:</strong> {{$teacher->teacher_name}}</p>
						</td>
						<td style="border:none;">
							<p style="text-align: left; font-size: 13px;"><strong>Year:</strong> {{$fiscal_year->year}}</p>
						</td>
					</tr>				
				</table>
			</div>
			<div>
				<table width="100%">
					<thead>
						<tr>
							<th style="">SL#</th>
							<th style="">Student Name</th>
							<th style="">Roll</th>
							<th style="">Due Amount</th>

							@if($search_for['collection_type'] == 1)
								<th style="">Collected Amount</th>
							@endif
						</tr>
					</thead>
					<tbody>
						@php
							$i = 1;
							$total_collected = 0;
							$total_due = 0;
							$grand_collection = 0;
							$grand_due = 0;
						@endphp
						@foreach($collections as $student_name => $collection)
							@php
								$collection = $collection->groupBy('roll');
							@endphp
							@foreach($collection as $roll => $collection)
								@php
									foreach($collection as $total => $data){
										$total_collected += $data->total_collected;
										$total_due += $data->total_due;	
									}
								@endphp
								<tr>
									<td style="text-align: center;">{{$i}}</td>
									<td style="text-align: left; padding-left: 20px;">{{$student_name}}</td>
									<td style="text-align: center;">{{$roll}}</td>
									<td style="text-align: center;">{{sprintf("%.2f", $total_due)}}</td>

									@if($search_for['collection_type'] == 1)
										<td style="text-align: center;">{{sprintf("%.2f", $total_collected)}}</td>
									@endif
								</tr>
									@php
										$grand_collection += $total_collected;
										$grand_due += $total_due;
									@endphp
								@endforeach
							@php
								$i++;
								$total_collected = 0;
								$total_due = 0;
							@endphp
						@endforeach
						<tr>
							<td colspan="3" style="text-align: right;"><strong>Total =</strong></td>
							<td style="text-align: center;">{{sprintf("%.2f", $grand_due)}}</td>

							@if($search_for['collection_type'] == 1)
								<td style="text-align: center;">{{sprintf("%.2f", $grand_collection)}}</td>
							@endif
						</tr>
					</tbody>
				</table>
				@if($search_for['collection_type'] == 1)
					@php
						if($grand_collection == 0.00){
							$grand_collection = 0;
						}
					@endphp
					<p style="padding-top: 30px;"><strong>Total Collection is {{ucwords($numberTransformer->toWords($grand_collection))}} Taka.</strong></p>
				@elseif($search_for['collection_type'] == 2)
					@php
						if($grand_due == 0.00){
							$grand_due = 0;
						}
					@endphp
					<p style="padding-top: 30px;"><strong>Total Due is {{ucwords($numberTransformer->toWords($grand_due))}} Taka.</strong></p>
				@endif
			</div>
			{{-- End of Report-6 --}}


	{{-- Report-7: student wise collection report for specific year && specific Month --}}	

		@elseif(isset($search_for['session_id']) == true
			&& isset($search_for['level_id']) == true
			&& isset($search_for['section_id']) == true
			&& isset($search_for['section_student_id']) == true
			&& isset($search_for['fiscal_year_id']) == true
			&& isset($search_for['business_month_id']) == true
			&& isset($search_for['collection_type']) == true)


			<div class="row">

				@if($search_for['collection_type'] == 1)
					<p style="text-align: center; font-size: 15px;"><b>Monthly Collection Report</b>
					<strong>of {{ucfirst($student->name)}}</strong><br><small><strong>Class Teacher-</strong> {{$teacher->teacher_name}}</small><br><small>{{$fiscal_year->year}}</small>

				@elseif($search_for['collection_type'] == 2)
					<p style="text-align: center; font-size: 15px;"><b>Monthly Due Report</b>
					<strong>of {{ucfirst($student->name)}}</strong><br><small><strong>Class Teacher-</strong> {{$teacher->teacher_name}}</small><br><small>{{$fiscal_year->year}}</small>
				@endif
				</p>
				<table style="border: none; margin-bottom: 20px;">
					<tr style="border:none;">
						<td style="border:none;">
							<p style="text-align: left; font-size: 13px;"><strong>Session:</strong> {{$session->name}}</p>
						</td>
						<td style="border:none;">
							<p style="text-align: left; font-size: 13px;"><strong>Class:</strong> {{$level->class_name}}</p>
						</td>
						<td style="border:none;">
							<p style="text-align: left; font-size: 13px;"><strong>Section:</strong> {{$section->section_name}}</p>
						</td>
						<td style="border:none;">
							<p style="text-align: left; font-size: 13px;"><strong>Month:</strong> {{$business_month->month_name}}</p>
						</td>
					</tr>				
				</table>
			</div>
			<div>
				<table width="100%">
					<thead>
						<tr>
							<th style="">SL#</th>
							<th style="">Month</th>
							<th style="">Due Amount</th>

							@if($search_for['collection_type'] == 1)
								<th style="">Collected Amount</th>
							@endif
						</tr>
					</thead>
					<tbody>
						@php
							$i = 1;
							$total_collected = 0;
							$total_due = 0;
							$grand_collection = 0;
							$grand_due = 0;
						@endphp
						@foreach($collections as $month => $collection)
							@php
								foreach($collection as $total => $data){
									$total_collected += $data->total_collected;
									$total_due += $data->total_due;	
								}
								$grand_collection += $total_collected;
								$grand_due += $total_due;
							@endphp
							<tr>
								<td style="text-align: center;">{{$i}}</td>
								<td style="text-align: center;">{{$month}}</td>
								<td style="text-align: center;">{{sprintf("%.2f", $total_due)}}</td>

								@if($search_for['collection_type'] == 1)
									<td style="text-align: center;">{{sprintf("%.2f", $total_collected)}}</td>
								@endif
							</tr>
							@php
								$i++;
								$total_collected = 0;
								$total_due = 0;
							@endphp
						@endforeach
						<tr>
							<td colspan="2" style="text-align: right;"><strong>Total =</strong></td>
							<td style="text-align: center;">{{sprintf("%.2f", $grand_due)}}</td>

							@if($search_for['collection_type'] == 1)
								<td style="text-align: center;">{{sprintf("%.2f", $grand_collection)}}</td>
							@endif
						</tr>
					</tbody>
				</table>
				@if($search_for['collection_type'] == 1)
					@php
						if($grand_collection == 0.00){
							$grand_collection = 0;
						}
					@endphp
					<p style="padding-top: 30px;"><strong>Total Collection of {{$business_month->month_name}} is {{ucwords($numberTransformer->toWords($grand_collection))}} Taka.</strong></p>
				@elseif($search_for['collection_type'] == 2)
					@php
						if($grand_due == 0.00){
							$grand_due = 0;
						}
					@endphp
					<p style="padding-top: 30px;"><strong>Total Due of {{$business_month->month_name}} is {{ucwords($numberTransformer->toWords($grand_due))}} Taka.</strong></p>
				@endif
			</div>
			{{--End of Report-7 --}}
		@endif
</body>
</html>