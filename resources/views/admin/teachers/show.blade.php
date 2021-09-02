

@section('heading')

Teacher Profile

@endsection


@extends('layouts.app')

@section('content')
<div class="content">
    <?php
    $sections = \App\Section::where('teacher_id', $teacher->id)->get();
    $section_subject_teachers = \App\SectionSubjectTeacher::where('teacher_id', $teacher->id)->get();
    //dd($sections);
    ?>
    <div class="row">
        <div class="col-md-4 col-md-offset-1" style="padding-top: 5px">
            <div class="card card-user">
              <div class="image">
                <!-- <img src="../assets/img/damir-bosnjak.jpg" alt="..."> -->
                <!-- <img height="42" width="42" src="'$student->student_photo'" alt="something"> -->
            </div>
            <div class="card-body">
                <div class="author">

                    <!-- <img class="avatar border-gray" src="'$student->student_photo'" alt="hi"> -->
                    <img class="avatar border-gray" src="{{asset($teacher->teacher_photo)}}" alt="profile Pic" >
                    
                    <h5 class="title">{{$teacher->teacher_name}}</h5>
                    <label>{{$teacher->teacher_name_bangla}}</label>
                    <p class="description">{{$teacher->nationality}}</p>                 
                </div>
                
            </div>
            <div class="card-footer">
                <hr>
                <div class="button-container">

                  <div class="row" style="padding-left: 2.5em">
                    <div class="col-lg-4 col-md-6 col-6 ml-auto">
                      <h5>{{$teacher->religion}}
                        <br>
                        <small>Religion</small>
                    </h5>
                </div>
                <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                  <h5>{{$teacher->marital_status}}
                    <br>
                    <small>Marital Status</small>
                </h5>
            </div>
            <div class="col-lg-3 mr-auto">
              <h5>{{$teacher->salary}}
                <br>
                <small>Salary</small>
            </h5>
        </div>
    </div>
</div>
</div>
</div>
<div class="card card-user">
  <div class="card-body">
      <div class="card-header">
       <h5 class="card-title" style="text-align: center; padding: 10px;">Change Password</h5>
   </div>
   <div class="container">
                <!--  <div style="width:25%">
                  @if(session('errorMsg'))
                    <div class="alert alert-icon alert-danger alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                        <i class="mdi mdi-check-all"></i>
                        <strong>Sorry!!</strong> {{session('errorMsg')}}
                      </button>
                    </div>
                  @endif
              </div>  --> 
              <div style="width:29%">
                 @if(session()->has('successMsg'))
                 <div class="alert alert-icon alert-success alert-dismissible fade in text-center">
                    <button style="position: relative; right: 1px; color: black; font-weight: bold" type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session()->get('successMsg') }}
                </div>
                @endif
                @if(session()->has('errorMsg'))
                <div class="alert alert-icon alert-danger alert-dismissible fade in text-center">
                    <button style="position: relative; right: 1px; color: black; font-weight: bold" type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session()->get('errorMsg') }}
                </div>
                @endif
            </div>
            <form method="post" action="{{route('password.update')}}" style="width: 320px;">
                {{csrf_field()}}
                <div class="form-group{{$errors->has('oldpassword') ? 'has-error' : ''}}">
                  <label for="oldpassword">Old Password:</label>
                  <input type="password" class="form-control" id="oldpassword" placeholder="Enter old password" name="oldpassword" required autofocus>

                  @if ($errors->has('oldpassword'))
                  <span class="help-block">
                    <strong>{{ $errors->first('oldpassword') }}</strong>
                </span>
                @endif

            </div>
            <div class="form-group">
              <label for="pwd">New Password:</label>
              <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" placeholder="Type new password" name="password" required>

              @if ($errors->has('password'))
              <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif

        </div>
        <button type="submit" style="margin-bottom: 15px;" class="btn btn-default">Change Password</button>
    </form>
</div>
</div>  
</div>         
</div>
<div class="col-md-6" style="padding-top: 5px">
    <div class="card card-user" style="padding-top: 5px; padding-left: 20px; padding-right: 10px">
      <div class="card-header">
        <h5 class="card-title">Profile Details</h5>
    </div>
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    {!! Form::label('contact_no','Contact no.') !!}
                    {!! Form::label('contact_no', isset($teacher->contact_no) ? $teacher->contact_no : null, ['class'=> 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-6 px-1">
              <div class="form-group">
                {!! Form::label('date_of_birth','Date of Birth:') !!}
                {!! Form::label('date_of_birth', isset($teacher->date_of_birth) ? $teacher->date_of_birth : null, ['class'=> 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 p4-1">
          <div class="form-group">
            <label for="email">Email Address:</label>
            <label class="form-control">{{ isset($teacher->user->email) ? $teacher->user->email : null }}</label>
        </div>
    </div>
</div>   
<div class="row">
    <div class="col-md-6 pr-1">
      <div class="form-group">
        {!! Form::label('designation','Designation') !!}
        {!! Form::label('designation', isset($teacher->designation) ? $teacher->designation : null, ['class'=> 'form-control']) !!}
    </div>
</div>

<div class="col-md-6 px-1">
  <div class="form-group">
    {!! Form::label('nationality', 'Nationality') !!}
    {!! Form::text('nationality', isset($teacher->nationality) ? $teacher->nationality : null, ['class'=> 'form-control']) !!}
</div>
</div>
</div>



<div class="row">
    <div class="col-md-6 pr-1">
      <div class="form-group">
        {!! Form::label('fathers_name','Fathers Name:') !!}
        {!! Form::label('fathers_name', isset($teacher->fathers_name) ? $teacher->fathers_name : null, ['class'=> 'form-control']) !!}

    </div>
</div>
<div class="col-md-6 pl-1">
  <div class="form-group">
    {!! Form::label('mothers_name','Mothers Name:') !!}
    {!! Form::label('mothers_name', isset($teacher->mothers_name) ? $teacher->mothers_name : null, ['class'=> 'form-control']) !!}
</div>
</div>
</div>
<div class="row">
    <div class="col-md-6 p4-1">
      <div class="form-group">
       {!! Form::label('spouse_name','Name of Spouse') !!}
       {!! Form::text('spouse_name', isset($teacher->spouse_name) ? $teacher->spouse_name : null, ['class'=> 'form-control']) !!}
   </div>
</div>
  <div class="col-md-6 p4-1">
      <div class="form-group">
       {!! Form::label('gender','Gender') !!}
       {!! Form::text('gender', isset($teacher->gender) ? $teacher->gender : null, ['class'=> 'form-control']) !!}
   </div>
</div>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('blood_group','Blood Group') !!}
            {!! Form::label('blood_group', isset($teacher->blood_group) ? $teacher->blood_group : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6 pr-1">
      <div class="form-group">
        {!! Form::label('subject','Subject') !!}
        {!! Form::label('subject', isset($teacher->subject) ? $teacher->subject : null, ['class'=> 'form-control']) !!}
    </div>
</div>
<div class="col-md-6 pr-1">
  <div class="form-group">
    {!! Form::label('joining_date','Joining Date') !!}
    {!! Form::label('joining_date', isset($teacher->joining_date) ? $teacher->joining_date : null, ['class'=> 'form-control']) !!}
</div>
</div>
<div class="col-md-6 pr-1">
  <div class="form-group">
    {!! Form::label('nid_number','NID Number') !!}
    {!! Form::label('nid_number', isset($teacher->nid_number) ? $teacher->nid_number : null, ['class'=> 'form-control']) !!}
</div>
</div>

</div>

<div class="row">

    <div class="col-md-12">
      <div class="form-group">
        {!! Form::label('present_address','Present Address:') !!}
        {!! Form::textarea('present_address', isset($teacher->present_address) ? $teacher->present_address : null, ['class'=> 'form-control','readonly']) !!}
    </div>
</div>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="form-group">
        {!! Form::label('permanent_address','Permanent Address:') !!}
        {!! Form::textarea('permanent_address', isset($teacher->permanent_address) ? $teacher->permanent_address : null, ['class'=> 'form-control','disabled']) !!}
    </div>
</div>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="form-group">
        {!! Form::label('comment','Comment') !!}
        {!! Form::textarea('comment', isset($teacher->comment) ? $teacher->comment : null, ['class'=> 'form-control','disabled']) !!}
    </div>
</div>
</div>
<div class="row">
    <div class="col-md-12">
        <span style="font-weight: bold;">Bank Account Information</span>
        <span>{!! Form::checkbox('bank_check', null, null, array('id'=>'bank1', 'onclick'=>'myFunction1()' )) !!}</span>

        <div class="col-md-12" id="bank_account" style="border-style: solid;">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('account_holder_name','Account Holder Name') !!}
                    {!! Form::label('account_holder_name', isset($teacher->bank_account->account_holder_name) ? $teacher->bank_account->account_holder_name : null, ['class'=> 'form-control']) !!}
                </div>
            </div> 
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('bank_name','Bank Name') !!}
                    {!! Form::label('bank_name', isset($teacher->bank_account->bank_name) ? $teacher->bank_account->bank_name : null, ['class'=> 'form-control']) !!}
                </div>
            </div> 
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('branch_name','Branch Name') !!}
                    {!! Form::label('branch_name', isset($teacher->bank_account->branch_name) ? $teacher->bank_account->branch_name : null, ['class'=> 'form-control']) !!}
                </div>
            </div> 
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('account_number','Account Number') !!}
                    {!! Form::label('account_number', isset($teacher->bank_account->account_number) ? $teacher->bank_account->account_number : null, ['class'=> 'form-control']) !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('account_type','Account Type') !!}
                    {!! Form::label('account_type', isset($teacher->bank_account->account_type) ? $teacher->bank_account->account_type : null, ['class'=> 'form-control']) !!}
                </div>
            </div> 
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('routing_number','Routing Number') !!}
                    {!! Form::label('routing_number', isset($teacher->bank_account->routing_number) ? $teacher->bank_account->routing_number : null, ['class'=> 'form-control']) !!}
                </div>
            </div> 
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('comment','Comment') !!}
                    {!! Form::label('comment', isset($teacher->bank_account->comment) ? $teacher->bank_account->comment : null, ['class'=> 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <span style="font-weight: bold;">Mobile Bank Account Information</span> 
        {!! Form::checkbox('mobile_check', null, null, array('id'=>'mobileBank', 'onclick'=>'myFunction()' )) !!}
        
        <div class="col-md-12" id='mobile' style="border-style: solid;">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('mobile_account_holder_name','Account Holder Name') !!}
                    {!! Form::label('mobile_account_holder_name', isset($teacher->mobile_bank_account->mobile_account_holder_name) ? $teacher->mobile_bank_account->mobile_account_holder_name : null, ['class'=> 'form-control']) !!}
                </div>
            </div> 
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('mobile_bank_name','Mobile Bank Name') !!}
                    {!! Form::label('mobile_bank_name', isset($teacher->mobile_bank_account->mobile_bank_name) ? $teacher->mobile_bank_account->mobile_bank_name : null, ['class'=> 'form-control']) !!}
                </div>
            </div> 
            
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('mobile_account_number','Account Number(Mobile Number)') !!}
                    {!! Form::label('mobile_account_number', isset($teacher->mobile_bank_account->mobile_account_number) ? $teacher->mobile_bank_account->mobile_account_number : null, ['class'=> 'form-control']) !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('mobile_account_type','Account Type') !!}
                    {!! Form::label('mobile_account_type', isset($teacher->mobile_bank_account->mobile_account_type) ? $teacher->mobile_bank_account->mobile_account_type : null, ['class'=> 'form-control']) !!}
                </div>
            </div> 
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('mobile_routing_number','Routing Number') !!}
                    {!! Form::label('mobile_routing_number', isset($teacher->mobile_bank_account->mobile_routing_number) ? $teacher->mobile_bank_account->mobile_routing_number : null, ['class'=> 'form-control']) !!}
                </div>
            </div> 
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('mobile_comment','Comment') !!}
                    {!! Form::label('mobile_comment', isset($teacher->mobile_bank_account->mobile_comment) ? $teacher->mobile_bank_account->mobile_comment : null, ['class'=> 'form-control']) !!}
                </div>
            </div>
        </div> 
    </div>
</div>




<div class="row">
    <div class="col-md-12">
        <span style="font-weight: bold;">Educational Qualification</span> 
        {!! Form::checkbox('edu_check', null, null, array('id'=>'edu', 'onclick'=>'education()' )) !!}
        <div id='edu_id'>
            @foreach($teacher->education as $edu)
            <div class="col-md-12 mb-2"  style="border-style: solid;">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('degree_name','Degree Name') !!}
                        {!! Form::label('degree_name', isset($edu->degree_name) ? $edu->degree_name : null, ['class'=> 'form-control']) !!}
                    </div>
                </div> 

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('passing_year','Passing Year') !!}
                        {!! Form::label('passing_year', isset($edu->passing_year) ? $edu->passing_year : null, ['class'=> 'form-control']) !!}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('result','Result') !!}
                        {!! Form::label('result', isset($edu->result) ? $edu->result : null, ['class'=> 'form-control']) !!}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('institute_name','Institute Name') !!}
                        {!! Form::label('institute_name', isset($edu->institute_name) ? $edu->institute_name : null, ['class'=> 'form-control']) !!}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('subject','Subject') !!}
                        {!! Form::label('subject', isset($edu->subject) ? $edu->subject : null, ['class'=> 'form-control']) !!}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('education_board','Education Board') !!}
                        {!! Form::label('education_board', isset($edu->education_board) ? $edu->education_board : null, ['class'=> 'form-control']) !!}
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('education_comment','Comment') !!}
                        {!! Form::label('education_comment', isset($edu->comment) ? $edu->comment : null, ['class'=> 'form-control']) !!}
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <span style="font-weight: bold;">Training Info</span>
        {!! Form::checkbox('Training',null,null,array('id'=>'training_info','onclick'=>'trainingFunc()')) !!}
        <div id="training_div" > 
         @foreach($teacher->training as $training)
         <div class="col-md-12 mb-2"  style="border-style: solid;" >
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('institute_name','Institute Name') !!}
                    {!! Form::label('institute_name',isset( $training->institute_name)? $training->institute_name : null,['class'=> 'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('subject','Subject')!!}
                    {!! Form::label('subject',isset( $training->subject)? $training->subject:null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('training_place','Training Place')!!}
                    {!! Form::label('training_place',isset( $training->training_place)? $training->training_place:null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('starting_date','Starting Date')!!}
                    {!! Form::label('starting_date',isset( $training->starting_date)? $training->starting_date:null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('ending_date','Ending Date')!!}
                    {!! Form::label('ending_date',isset( $training->ending_date)? $training->ending_date:null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('expiration','Expiration')!!}
                    {!! Form::label('expiration',isset( $training->expiration)? $training->expiration:null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('comment','Comment')!!}
                    {!! Form::label('comment',isset( $training->comment)? $training->comment:null,['class'=>'form-control'])!!}

                </div>
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
          @foreach($teacher->previous_school as $previous_school)
          <div class="col-md-12 mb-2"  style="border-style: solid;" >
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('institute_name','Institute Name') !!}
                    {!! Form::label('institute_name',isset( $previous_school->institute_name)? $previous_school->institute_name : null,['class'=> 'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('designation','Designation')!!}
                    {!! Form::label('designation',isset( $previous_school->designation)? $previous_school->designation:null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('appoiment_date','Appoiment Date')!!}
                    {!! Form::label('appoiment_date',isset( $previous_school->appoiment_date)? $previous_school->appoiment_date:null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('joining_date','Joining Date')!!}
                    {!! Form::label('joining_date',isset( $previous_school->joining_date)? $previous_school->joining_date:null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('mpo_date','Mpo Date')!!}
                    {!! Form::label('mpo_date',isset( $previous_school->mpo_date)? $previous_school->mpo_date:null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('exemption_date','Exemption date')!!}
                    {!! Form::label('exemption_date',isset( $previous_school->exemption_date)? $previous_school->exemption_date:null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('comment','Comment')!!}
                    {!! Form::label('comment',isset( $previous_school->comment)? $previous_school->comment:null,['class'=>'form-control'])!!}

                </div>
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
        <div  id="ntrca_info_div">
          @foreach($teacher->ntrca_info as $ntrca_info )
          <div class="col-md-12 mb-2" style="border-style: solid;" >
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('registation_no','Registation No') !!}
                    {!! Form::label('registation_no',isset( $ntrca_info->registation_no)? $ntrca_info->registation_no : null,['class'=> 'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('roll_no','Roll No')!!}
                    {!! Form::label('roll_no',isset( $ntrca_info->roll_no)? $ntrca_info->roll_no:null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('subject','Subject')!!}
                    {!! Form::label('subject',isset( $ntrca_info->subject)? $ntrca_info->subject:null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('passing_year','Passing Year')!!}
                    {!! Form::number('passing_year',isset( $ntrca_info->passing_year)? $ntrca_info->passing_year:null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('appoiment_date','Appoiment Date')!!}
                    {!! Form::label('appoiment_date',isset( $ntrca_info->appoiment_date)? $ntrca_info->appoiment_date:null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('joining_date','Joining Date')!!}
                    {!! Form::label('joining_date',isset( $ntrca_info->joining_date)? $ntrca_info->joining_date:null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('comment','Comment')!!}
                    {!! Form::label('comment',isset( $ntrca_info->comment)? $ntrca_info->comment:null,['class'=>'form-control'])!!}

                </div>
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
           @foreach($teacher->scale_changing as $scale_changing )
           <div class="col-md-12 mb-2"  style="border-style: solid;" >
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('salary_grade','Salary Grade') !!}
                    {!! Form::label('salary_grade',isset( $scale_changing->salary_grade)? $scale_changing->salary_grade : null,['class'=> 'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('present_salary_scale','Present Salary Scale')!!}
                    {!! Form::label('present_salary_scale',isset( $scale_changing->present_salary_scale)? $scale_changing->present_salary_scale:null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('first_mpo_joining_date','First Mpo Joining Date')!!}
                    {!! Form::label('first_mpo_joining_date',isset( $scale_changing->first_mpo_joining_date)? $scale_changing->first_mpo_joining_date:null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('first_high_scale_date','First high Scale Date')!!}
                    {!! Form::label('first_high_scale_date',isset( $scale_changing->first_high_scale_date)? $scale_changing->first_high_scale_date:null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('second_high_scale_date','Second High Scale Date')!!}
                    {!! Form::label('second_high_scale_date',isset( $scale_changing->second_high_scale_date)? $scale_changing->second_high_scale_date:null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('first_time_scale_date','First Time Scale Date')!!}
                    {!! Form::label('first_time_scale_date',isset( $scale_changing->first_time_scale_date)? $scale_changing->first_time_scale_date:null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('second_time_scale_date','Second Time Scale Date')!!}
                    {!! Form::label('second_time_scale_date',isset( $scale_changing->second_time_scale_date)? $scale_changing->second_time_scale_date:null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('bed_scale_date','Bed_scale_date')!!}
                    {!! Form::label('bed_scale_date',isset( $scale_changing->bed_scale_date)? $scale_changing->bed_scale_date:null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('comment','Comment')!!}
                    {!! Form::label('comment',isset( $scale_changing->comment)? $scale_changing->comment:null,['class'=>'form-control'])!!}

                </div>
            </div>

        </div>
        @endforeach
    </div>

</div> 
</div>

<div class="row">
    <div class="col-md-6 pr-1">
      <div class="form-group">
        {!! Form::label('class_teacher','Class Teacher of Section:') !!}
        @foreach($sections as $section)
        <?php
        $level_enroll = \App\LevelEnroll::find($section->level_enroll_id);
        ?>
        {!! Form::label('class_teacher', isset($section->section_name) ? $section->section_name : null, ['class'=> 'form-control']) !!} 
        @endforeach

    </div>
</div>
<div class="col-md-6 pl-1">
    <div class="form-group">
        {!! Form::label('','(Class:)') !!}
        @foreach($sections as $section)
        <?php
        $level_enroll = \App\LevelEnroll::find($section->level_enroll_id);
        $level = \App\Level::find($level_enroll->level_id);
        ?>

        {!! Form::label('class_name', isset($level->class_name) ? $level->class_name : null, ['class'=> 'form-control']) !!}
        @endforeach
    </div>
</div>
</div>
<div class="row">
    <div class="col-md-6 pl-1">
      <div class="form-group">
        {!! Form::label('subject_teacher','Subject Teacher of:') !!}
        @foreach($section_subject_teachers as $section_subject_teacher)

        <?php
        $subject = \App\Subject::find($section_subject_teacher->subject_id);
        ?>

        {!! Form::label('subject_teacher', isset($subject->subject_name) ? $subject->subject_name : null, ['class'=> 'form-control']) !!}

        @endforeach
    </div>
</div>
<div class="col-md-3 px-1">
  <div class="form-group">
    {!! Form::label('section','of Section:') !!}
    @foreach($section_subject_teachers as $section_subject_teacher)

    <?php
    $section = \App\Section::find($section_subject_teacher->section_id);
    ?>

    {!! Form::label('section_name', isset($section->section_name) ? $section->section_name : null, ['class'=> 'form-control']) !!}

    @endforeach
</div>
</div>
<div class="col-md-3 pr-1">
  <div class="form-group">
    {!! Form::label('class','of Class:') !!}
    @foreach($section_subject_teachers as $section_subject_teacher)

    <?php
    $section = \App\Section::find($section_subject_teacher->section_id);
    $level_enroll = \App\LevelEnroll::find($section->level_enroll_id);
    $level = \App\Level::find($level_enroll->level_id);
    ?>

    {!! Form::label('class_name', isset($level->class_name) ? $level->class_name : null, ['class'=> 'form-control']) !!}

    @endforeach
</div>
</div>
</div>       
</form>
</div>
</div>
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

@endsection 
