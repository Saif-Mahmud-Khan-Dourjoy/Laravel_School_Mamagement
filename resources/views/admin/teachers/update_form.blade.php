
<div class="col-md-12"  style="border-style: solid";>
	{!! Form::open(['method' => 'POST', 'url' => ['/teachers/basic_info/'.$teacher->id], 'files'=>'true']) !!}
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				{!! Form::label('teacher_name','Name of Teacher') !!} <span class="text-danger">&#9733;</span>
				{!! Form::text('teacher_name', isset($teacher->teacher_name) ? $teacher->teacher_name : null, ['class'=> 'form-control']) !!}
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				{!! Form::label('teacher_name_bangla','Name of Teacher Bangla') !!} <span class="text-danger">&#9733;</span>
				{!! Form::text('teacher_name_bangla', isset($teacher->teacher_name_bangla) ? $teacher->teacher_name_bangla : null, ['class'=> 'form-control']) !!}
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				{!! Form::label('teacher_global_id','Teacher Global ID') !!} 
				{!! Form::text('teacher_global_id', (isset($teacher->teacher_global_id) && $teacher->teacher_global_id != 0) ? $teacher->teacher_global_id : date('YmdHis').rand(1000,9999), ['class'=> 'form-control', 'readonly' => ''])!!}
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				{!! Form::label('email','Email') !!}<span class="text-danger">&#9733;</span>
				{!! Form::email('email', isset($teacher->user->email) ? $teacher->user->email : null, ['class'=> 'form-control']) !!}

			</div>
		</div>
		<div class="col-md-4">
        <div class="form-group">

            {!! Form::label('gender','Teacher Gender') !!} <span class="text-danger">&#9733;</span>
            {!! Form::select('gender', array('Male' => 'Male','Female' => 'Female','Other' => 'Other'), $gender->gender,['class'=> 'form-control']) !!}
        </div>
    </div>
		<div class="col-md-4">
			<div class="form-group">
				{!! Form::label('contact_no','Contact no.') !!}<span class="text-danger">&#9733;</span>
				{!! Form::text('contact_no', isset($teacher->contact_no) ? $teacher->contact_no : null, ['class'=> 'form-control']) !!}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				{!! Form::label('date_of_birth','Date of Birth') !!}<span class="text-danger">&#9733;</span>
				{!! Form::date('date_of_birth', isset($teacher->date_of_birth) ? $teacher->date_of_birth : null, ['class'=> 'form-control']) !!}
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				{!! Form::label('nationality', 'Nationality') !!}<span class="text-danger">&#9733;</span>
				{!! Form::text('nationality', isset($teacher->nationality) ? $teacher->nationality : null, ['class'=> 'form-control']) !!}
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				{!! Form::label('religion','Religion') !!} <span class="text-danger">&#9733;</span>
				{!! Form::select('religion', array('Islam' => 'Islam','Hindu' => 'Hindu','Buddhist' => 'Buddhist','Christian' => 'Christian','Other' => 'Other'),isset($teacher->religion) ? $teacher->religion : null, ['class'=> 'form-control']) !!}
			</div>
			<!-- <div class="form-group">
				{!! Form::label('religion', 'Religion') !!}
				{!! Form::text('religion', isset($teacher->religion) ? $teacher->religion : null, ['class'=> 'form-control']) !!}
			</div> -->
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				{!! Form::label('fathers_name','Fathers Name') !!}<span class="text-danger">&#9733;</span>
				{!! Form::text('fathers_name', isset($teacher->fathers_name) ? $teacher->fathers_name : null, ['class'=> 'form-control']) !!}
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				{!! Form::label('mothers_name','Mothers Name') !!}<span class="text-danger">&#9733;</span>
				{!! Form::text('mothers_name', isset($teacher->mothers_name) ? $teacher->mothers_name : null, ['class'=> 'form-control']) !!}
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				{!! Form::label('salary','Salary') !!}<span class="text-danger">&#9733;</span>
				{!! Form::text('salary', isset($teacher->salary) ? $teacher->salary : null, ['class'=> 'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('designation','Designation') !!}<span class="text-danger">&#9733;</span>
				{!! Form::text('designation', isset($teacher->designation) ? $teacher->designation : null, ['class'=> 'form-control']) !!}
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label('marital_status','Marital Status') !!}<span class="text-danger">&#9733;</span>
				<br>
				<div class="radio-inline">
					@if(isset($teacher))
					@if($teacher->marital_status=='Married')
					{!! Form::radio('marital_status', 'Married', 'true') !!} Married
					<br>
					{!! Form::radio('marital_status', 'Single') !!} Single
					@else
					{!! Form::radio('marital_status', 'Married') !!} Married
					<br>
					{!! Form::radio('marital_status', 'Single', 'true') !!} Single
					@endif
					@else
					{!! Form::radio('marital_status', 'Married') !!} Married
					<br>
					{!! Form::radio('marital_status', 'Single') !!} Single
					@endif
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="form-group">
				{!! Form::label('spouse_name','Name of Spouse') !!}
				{!! Form::text('spouse_name', isset($teacher->spouse_name) ? $teacher->spouse_name : null, ['class'=> 'form-control']) !!}
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				{!! Form::label('teacher_subject','Teacher Subject') !!}
				{!! Form::text('teacher_subject', isset($teacher->subject) ? $teacher->subject : null, ['class'=> 'form-control']) !!}
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				{!! Form::label('blood_group','Blood Group') !!}
				{!! Form::text('blood_group', isset($teacher->blood_group) ? $teacher->blood_group : null, ['class'=> 'form-control present_address']) !!}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				{!! Form::label('teacher_joining_date','Joining Date') !!} <span class="text-danger">&#9733;</span>
				{!! Form::date('teacher_joining_date', isset($teacher->joining_date) ? $teacher->joining_date : null, ['class'=> 'form-control present_address']) !!}
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				{!! Form::label('nid_number','NID Number') !!}
				{!! Form::text('nid_number', isset($teacher->nid_number) ? $teacher->nid_number : null, ['class'=> 'form-control']) !!}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				{!! Form::label('present_address','Present Address') !!} <span class="text-danger">&#9733;</span>
				{!! Form::textarea('present_address', isset($teacher->present_address) ? $teacher->present_address : null, ['class'=> 'form-control present_address']) !!}
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				{!! Form::label('permanent_address','Permanent Address') !!} <span class="text-danger">&#9733;</span>
				{!! Form::textarea('permanent_address', isset($teacher->permanent_address) ? $teacher->permanent_address : null, ['class'=> 'form-control permanent_address']) !!}
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				{!! Form::label('teacher_comment','Comment') !!}
				{!! Form::textarea('teacher_comment', isset($teacher->comment) ? $teacher->comment : null, ['class'=> 'form-control']) !!}
			</div>
		</div> 
		<div class="row">
			<div class="col-md-12">
				<div class="form-group p-2">
					{!! Form::label('teacher_photo','Choose image') !!}
					{!! Form::file('teacher_photo') !!}
				</div>
			</div>
		</div> 
	</div>
	<div class="form-group col-md-12">
		<div class="text-center">
			{!! Form::submit('Update', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
			<a href="{{route('teachers.index')}}" class="btn btn-default btn-fill btn-wd"> Cancel</a>  
		</div>
		{!! Form::close() !!}
	</div>
</div>



<div class="row">
	<div class="col-md-12">
		<span style="font-weight: bold;">Bank Account Information</span>
		<span>{!! Form::checkbox('bank_check', null, null, array('id'=>'bank1', 'onclick'=>'myFunction1()' )) !!}</span>



		<div class="col-md-12" id="bank_account"  style="border-style: solid;">
			{!! Form::open(['method' => 'POST', 'url' => ['/teachers/bank_acc/'.$teacher->bank_account->id]]) !!}
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('account_holder_name','Account Holder Name') !!} <span class="text-danger">&#9733;</span>
					{!! Form::text('account_holder_name', isset($teacher->bank_account->account_holder_name) ? $teacher->bank_account->account_holder_name : null, ['class'=> 'form-control']) !!}
				</div>
			</div> 
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('bank_name','Bank Name') !!} <span class="text-danger">&#9733;</span>
					{!! Form::text('bank_name', isset($teacher->bank_account->bank_name) ? $teacher->bank_account->bank_name : null, ['class'=> 'form-control']) !!}
				</div>
			</div> 
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('branch_name','Branch Name') !!}<span class="text-danger">&#9733;</span>
					{!! Form::text('branch_name', isset($teacher->bank_account->branch_name) ? $teacher->bank_account->branch_name : null, ['class'=> 'form-control']) !!}
				</div>
			</div> 
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('account_number','Account Number') !!} <span class="text-danger">&#9733;</span>
					{!! Form::text('account_number', isset($teacher->bank_account->account_number) ? $teacher->bank_account->account_number : null, ['class'=> 'form-control']) !!}
				</div>
			</div>

			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('account_type','Account Type') !!}<span class="text-danger">&#9733;</span>
					{!! Form::text('account_type', isset($teacher->bank_account->account_type) ? $teacher->bank_account->account_type : null, ['class'=> 'form-control']) !!}
				</div>
			</div> 
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('routing_number','Routing Number') !!} <span class="text-danger">&#9733;</span>
					{!! Form::text('routing_number', isset($teacher->bank_account->routing_number) ? $teacher->bank_account->routing_number : null, ['class'=> 'form-control']) !!}
				</div>
			</div> 
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('comment','Comment') !!}
					{!! Form::textarea('comment', isset($teacher->bank_account->comment) ? $teacher->bank_account->comment : null, ['class'=> 'form-control']) !!}
				</div>
			</div>

			<div class="form-group mt-3 col-md-12">
				<div class="text-center">
					{!! Form::submit('Update', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
					<a href="{{route('teachers.index')}}" class="btn btn-default btn-fill btn-wd"> Cancel</a>  
				</div>
				{!! Form::close() !!}
			</div>

		</div>
	</div>
</div>



<div class="row">
	<div class="col-md-12">

		<span style="font-weight: bold;">Mobile Bank Account Information</span> 
		{!! Form::checkbox('mobile_check', null, null, array('id'=>'mobileBank', 'onclick'=>'myFunction()' )) !!}

		<div class="col-md-12" id='mobile' style="border-style: solid;">
			{!! Form::open(['method' => 'POST', 'url' => ['/teachers/mbl_acc/'.$teacher->mobile_bank_account->id]]) !!} 
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('mobile_account_holder_name','Account Holder Name') !!} <span class="text-danger">&#9733;</span>
					{!! Form::text('mobile_account_holder_name', isset($teacher->mobile_bank_account->mobile_account_holder_name) ? $teacher->mobile_bank_account->mobile_account_holder_name : null, ['class'=> 'form-control']) !!}
				</div>
			</div> 
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('mobile_bank_name','Mobile Bank Name') !!} <span class="text-danger">&#9733;</span>
					{!! Form::text('mobile_bank_name', isset($teacher->mobile_bank_account->mobile_bank_name) ? $teacher->mobile_bank_account->mobile_bank_name : null, ['class'=> 'form-control']) !!}
				</div>
			</div> 

			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('mobile_account_number','Account Number(Mobile Number)') !!} <span class="text-danger">&#9733;</span>
					{!! Form::text('mobile_account_number', isset($teacher->mobile_bank_account->mobile_account_number) ? $teacher->mobile_bank_account->mobile_account_number : null, ['class'=> 'form-control']) !!}
				</div>
			</div>

			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('mobile_account_type','Account Type') !!} <span class="text-danger">&#9733;</span>
					{!! Form::text('mobile_account_type', isset($teacher->mobile_bank_account->mobile_account_type) ? $teacher->mobile_bank_account->mobile_account_type : null, ['class'=> 'form-control']) !!}
				</div>
			</div> 
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('mobile_routing_number','Routing Number') !!}
					{!! Form::text('mobile_routing_number', isset($teacher->mobile_bank_account->mobile_routing_number) ? $teacher->mobile_bank_account->mobile_routing_number : null, ['class'=> 'form-control']) !!}
				</div>
			</div> 
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('mobile_comment','Comment') !!}
					{!! Form::textarea('mobile_comment', isset($teacher->mobile_bank_account->mobile_comment) ? $teacher->mobile_bank_account->mobile_comment : null, ['class'=> 'form-control']) !!}
				</div>
			</div>
			<div class="form-group mt-3 col-md-12">
				<div class="text-center">
					{!! Form::submit('Update', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
					<a href="{{route('teachers.index')}}" class="btn btn-default btn-fill btn-wd"> Cancel</a>  
				</div>
				{!! Form::close() !!}
			</div>
		</div> 
	</div>
</div> 



<div class="row">
	<div class="col-md-12">
		<span style="font-weight: bold;">Educational Qualification</span> 
		{!! Form::checkbox('edu_check', null, null, array('id'=>'edu', 'onclick'=>'education()' )) !!}
		<div id='edu_id'>
			<div class="mb-2 text-right"><button type="button" class="btn btn-info " data-toggle="modal" data-target="#EduModal">Add More</button></div>


			@foreach($teacher->education as $edu )
			<div class="col-md-12 mb-2"  style="border-style: solid;">
				{!! Form::open(['method' => 'POST', 'url' => ['/teachers/edu_info/'.$edu->id]]) !!} 

				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('degree_name','Degree Name') !!} <span class="text-danger">&#9733;</span>
						{!! Form::text('degree_name', isset($edu->degree_name) ? $edu->degree_name : null, ['class'=> 'form-control']) !!}
					</div>
				</div> 

				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('passing_year','Passing Year') !!}<span class="text-danger">&#9733;</span>
						{!! Form::text('passing_year', isset($edu->passing_year) ? $edu->passing_year : null, ['class'=> 'form-control']) !!}
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('result','Result') !!} <span class="text-danger">&#9733;</span>
						{!! Form::text('result', isset($edu->result) ? $edu->result : null, ['class'=> 'form-control']) !!}
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('institute_name','Institute Name') !!} <span class="text-danger">&#9733;</span>
						{!! Form::text('institute_name', isset($edu->institute_name) ? $edu->institute_name : null, ['class'=> 'form-control']) !!}
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('subject','Subject') !!} <span class="text-danger">&#9733;</span>
						{!! Form::text('subject', isset($edu->subject) ? $edu->subject : null, ['class'=> 'form-control']) !!}
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('education_board','Education Board') !!}
						{!! Form::text('education_board', isset($edu->education_board) ? $edu->education_board : null, ['class'=> 'form-control']) !!}
					</div>
				</div>


				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('education_comment','Comment') !!}
						{!! Form::textarea('education_comment', isset($edu->comment) ? $edu->comment : null, ['class'=> 'form-control']) !!}
					</div>
				</div>
				<div class="form-group mt-3 col-md-12">
					<div class="text-center">
						{!! Form::submit('Update', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
						<a href="{{route('teachers.index')}}" class="btn btn-default btn-fill btn-wd"> Cancel</a>
						<a href="{{route('delete.edu_info',$edu->id)}}" class="btn btn-danger btn-fill btn-wd">Delete</a> 
					</div>
					{!! Form::close() !!}
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>



<div class="row">
	<div class="col-md-12">
		<span style="font-weight: bold;" >Training Info</span>
		{!! Form::checkbox('Training',null,null,array('id'=>'training_info','onclick'=>'trainingFunc()')) !!}
		<div id="training_div">
			<div class="mb-2 text-right"><button type="button" class="btn btn-info " data-toggle="modal" data-target="#TrainingModal">Add More</button></div>
			@foreach($teacher->training as $training)
			<div class="col-md-12 mb-2"  style="border-style: solid;" >
				{!! Form::open(['method' => 'POST', 'url' => ['/teachers/training_info/'.$training->id]]) !!} 
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('institute_name','Institute Name') !!} <span class="text-danger">&#9733;</span>
						{!! Form::text('institute_name',isset( $training->institute_name)? $training->institute_name : null,['class'=> 'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('subject','Subject')!!} <span class="text-danger">&#9733;</span>
						{!! Form::text('subject',isset( $training->subject)? $training->subject:null,['class'=>'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('training_place','Training Place')!!} <span class="text-danger">&#9733;</span>
						{!! Form::text('training_place',isset( $training->training_place)? $training->training_place:null,['class'=>'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('starting_date','Starting Date')!!} <span class="text-danger">&#9733;</span>
						{!! Form::date('starting_date',isset( $training->starting_date)? $training->starting_date:null,['class'=>'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('ending_date','Ending Date')!!} <span class="text-danger">&#9733;</span>
						{!! Form::date('ending_date',isset( $training->ending_date)? $training->ending_date:null,['class'=>'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('expiration','Expiration')!!} <span class="text-danger">&#9733;</span>
						{!! Form::text('expiration',isset( $training->expiration)? $training->expiration:null,['class'=>'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('comment','Comment')!!}
						{!! Form::textarea('comment',isset( $training->comment)? $training->comment:null,['class'=>'form-control'])!!}

					</div>
				</div>
				<div class="form-group mt-3 col-md-12">
					<div class="text-center">
						{!! Form::submit('Update', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
						<a href="{{route('teachers.index')}}" class="btn btn-default btn-fill btn-wd"> Cancel</a> 
						<a href="{{route('delete.training_info',$training->id)}}" class="btn btn-danger btn-fill btn-wd">Delete</a> 
					</div>
					{!! Form::close() !!}
				</div>

			</div>
			@endforeach
		</div>

	</div>

</div>

<div class="row">
	<div class="col-md-12">
		<span style="font-weight: bold;">Previous School Info</span>
		{!! Form::checkbox('prev_school',null,null,array('id'=>'prev_school_info','onclick'=>'prev_school_info_Func()')) !!}
		<div id="prev_school_info_div">
			<div class="mb-2 text-right"><button type="button" class="btn btn-info " data-toggle="modal" data-target="#PrevSclModal">Add More</button></div>
			@foreach($teacher->previous_school as $prev_scl ) 	
			<div class="col-md-12 mb-2"  style="border-style: solid;" >
				{!! Form::open(['method' => 'POST', 'url' => ['/teachers/prev_scl_info/'.$prev_scl->id]]) !!} 
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('institute_name','Institute Name') !!} <span class="text-danger">&#9733;</span>
						{!! Form::text('institute_name',isset( $prev_scl->institute_name)? $prev_scl->institute_name : null,['class'=> 'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('designation','Designation')!!} <span class="text-danger">&#9733;</span>
						{!! Form::text('designation',isset( $prev_scl->designation)? $prev_scl->designation:null,['class'=>'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('appoiment_date','Appoiment Date')!!} 
						{!! Form::date('appoiment_date',isset( $prev_scl->appoiment_date)? $prev_scl->appoiment_date:null,['class'=>'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('joining_date','Joining Date')!!} <span class="text-danger">&#9733;</span>
						{!! Form::date('joining_date',isset( $prev_scl->joining_date)? $prev_scl->joining_date:null,['class'=>'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('mpo_date','Mpo Date')!!}
						{!! Form::date('mpo_date',isset( $prev_scl->mpo_date)? $prev_scl->mpo_date:null,['class'=>'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('exemption_date','Exemption date')!!} <span class="text-danger">&#9733;</span>
						{!! Form::date('exemption_date',isset( $prev_scl->exemption_date)? $prev_scl->exemption_date:null,['class'=>'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('comment','Comment')!!}
						{!! Form::textarea('comment',isset( $prev_scl->comment)? $prev_scl->comment:null,['class'=>'form-control'])!!}

					</div>
				</div>
				<div class="form-group mt-3 col-md-12">
					<div class="text-center">
						{!! Form::submit('Update', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
						<a href="{{route('teachers.index')}}" class="btn btn-default btn-fill btn-wd"> Cancel</a>
						<a href="{{route('delete.prev_scl_info',$prev_scl->id)}}" class="btn btn-danger btn-fill btn-wd">Delete</a>  
					</div>
					{!! Form::close() !!}
				</div>

			</div>
			@endforeach
		</div>

	</div> 
</div>

<div class="row">
	<div class="col-md-12">
		<span style="font-weight: bold;">NTRCA Info</span>
		{!! Form::checkbox('ntrca',null,null,array('id'=>'ntrca_info','onclick'=>'ntrca_info_Func()')) !!}
		<div id="ntrca_info_div">
			<div class="mb-2 text-right"><button type="button" class="btn btn-info " data-toggle="modal" data-target="#NtrcaModal">Add More</button></div>
			@foreach($teacher->ntrca_info as $ntrca) 
			<div class="col-md-12 mb-2"  style="border-style: solid;" >
				{!! Form::open(['method' => 'POST', 'url' => ['/teachers/ntrca_info/'.$ntrca->id]]) !!}
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('registation_no','Registation No') !!} <span class="text-danger">&#9733;</span>
						{!! Form::text('registation_no',isset( $ntrca->registation_no)? $ntrca->registation_no : null,['class'=> 'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('roll_no','Roll No')!!} <span class="text-danger">&#9733;</span>
						{!! Form::text('roll_no',isset( $ntrca->roll_no)? $ntrca->roll_no:null,['class'=>'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('subject','Subject')!!} <span class="text-danger">&#9733;</span>
						{!! Form::text('subject',isset( $ntrca->subject)? $ntrca->subject:null,['class'=>'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('passing_year','Passing Year')!!} <span class="text-danger">&#9733;</span>
						{!! Form::number('passing_year',isset( $ntrca->passing_year)? $ntrca->passing_year:null,['class'=>'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('appoiment_date','Appoiment Date')!!} <span class="text-danger">&#9733;</span>
						{!! Form::date('appoiment_date',isset( $ntrca->appoiment_date)? $ntrca->appoiment_date:null,['class'=>'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('joining_date','Joining Date')!!} <span class="text-danger">&#9733;</span>
						{!! Form::date('joining_date',isset( $ntrca->joining_date)? $ntrca->joining_date:null,['class'=>'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('comment','Comment')!!}
						{!! Form::textarea('comment',isset( $ntrca->comment)? $ntrca->comment:null,['class'=>'form-control'])!!}

					</div>
				</div>
				<div class="form-group mt-3 col-md-12">
					<div class="text-center">
						{!! Form::submit('Update', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
						<a href="{{route('teachers.index')}}" class="btn btn-default btn-fill btn-wd"> Cancel</a>
						<a href="{{route('delete.ntrca_info',$ntrca->id)}}" class="btn btn-danger btn-fill btn-wd">Delete</a>  
					</div>
					{!! Form::close() !!}
				</div>

			</div>
			@endforeach
		</div> 
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<span style="font-weight: bold;">Scale Change Info</span>
		{!! Form::checkbox('scale_change',null,null,array('id'=>'scale_change_info','onclick'=>'scale_change_info_Func()')) !!}
		<div id="scale_change_info_div">
			<div class="mb-2 text-right"><button type="button" class="btn btn-info " data-toggle="modal" data-target="#ScaleChangeModal">Add More</button></div>
			@foreach($teacher->scale_changing as $scale)
			<div class="col-md-12 mb-2"  style="border-style: solid;" >
				{!! Form::open(['method' => 'POST', 'url' => ['/teachers/scale_chng_info/'.$scale->id]]) !!} 
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('salary_grade','Salary Grade') !!}
						{!! Form::text('salary_grade',isset( $scale->salary_grade)? $scale->salary_grade : null,['class'=> 'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('present_salary_scale','Present Salary Scale')!!}
						{!! Form::text('present_salary_scale',isset( $scale->present_salary_scale)? $scale->present_salary_scale:null,['class'=>'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('first_mpo_joining_date','First Mpo Joining Date')!!}
						{!! Form::date('first_mpo_joining_date',isset( $scale->first_mpo_joining_date)? $scale->first_mpo_joining_date:null,['class'=>'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('first_high_scale_date','First high Scale Date')!!}
						{!! Form::date('first_high_scale_date',isset( $scale->first_high_scale_date)? $scale->first_high_scale_date:null,['class'=>'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('second_high_scale_date','Second High Scale Date')!!}
						{!! Form::date('second_high_scale_date',isset( $scale->second_high_scale_date)? $scale->second_high_scale_date:null,['class'=>'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('first_time_scale_date','First Time Scale Date')!!}
						{!! Form::date('first_time_scale_date',isset( $scale->first_time_scale_date)? $scale->first_time_scale_date:null,['class'=>'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('second_time_scale_date','Second Time Scale Date')!!}
						{!! Form::date('second_time_scale_date',isset( $scale->second_time_scale_date)? $scale->second_time_scale_date:null,['class'=>'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('bed_scale_date','Bed_scale_date')!!}
						{!! Form::date('bed_scale_date',isset( $scale->bed_scale_date)? $scale->bed_scale_date:null,['class'=>'form-control'])!!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('comment','Comment')!!}
						{!! Form::textarea('comment',isset( $scale->comment)? $scale->comment:null,['class'=>'form-control'])!!}

					</div>
				</div>
				<div class="form-group mt-3 col-md-12">
					<div class="text-center">
						{!! Form::submit('Update', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
						<a href="{{route('teachers.index')}}" class="btn btn-default btn-fill btn-wd"> Cancel</a>  
						<a href="{{route('delete.scale_changing_info',$scale->id)}}" class="btn btn-danger btn-fill btn-wd">Delete</a>
					</div>
					{!! Form::close() !!}
				</div>

			</div>
			@endforeach

		</div> 
	</div>
</div>













<script>
	myFunction();
	myFunction1();
	education();
	trainingFunc();
	prev_school_info_Func();
	ntrca_info_Func();
	scale_change_info_Func();
	function myFunction() {
		var checkBox = document.getElementById("mobileBank");
		var text = document.getElementById("mobile");
		if (checkBox.checked == true){
			text.style.display = "block";
		} 
		else {
			text.style.display = "none";
		}
	}
	function myFunction1(){
		var check = document.getElementById("bank1");
		var tex = document.getElementById("bank_account");
		if (check.checked == true){
			tex.style.display = "block";
		} 
		else {
			tex.style.display = "none";
		}
	}

	function education(){
		var check1 = document.getElementById("edu");
		var tex1 = document.getElementById("edu_id");
		if (check1.checked == true){
			tex1.style.display = "block";
		} 
		else {
			tex1.style.display = "none";
		}
	}

	function trainingFunc(){
		var training_check= document.getElementById('training_info');
		var training_div=document.getElementById('training_div');

		if(training_check.checked==true){
			training_div.style.display="block";
		}
		else{
			training_div.style.display="none";
		}
	}
	function prev_school_info_Func(){
		var prev_school_info_check= document.getElementById('prev_school_info');
		var prev_school_info_div=document.getElementById('prev_school_info_div');

		if(prev_school_info_check.checked==true){
			prev_school_info_div.style.display="block";
		}
		else{
			prev_school_info_div.style.display="none";
		}
	}

	function ntrca_info_Func(){
		var ntrca_check= document.getElementById('ntrca_info');
		var ntrca_info_div=document.getElementById('ntrca_info_div');

		if(ntrca_check.checked==true){
			ntrca_info_div.style.display="block";
		}
		else{
			ntrca_info_div.style.display="none";
		}
	}

	function scale_change_info_Func(){
		var scale_change_info_check= document.getElementById('scale_change_info');
		var scale_change_info_div=document.getElementById('scale_change_info_div');

		if(scale_change_info.checked==true){
			scale_change_info_div.style.display="block";
		}
		else{
			scale_change_info_div.style.display="none";
		}
	}       

</script>


