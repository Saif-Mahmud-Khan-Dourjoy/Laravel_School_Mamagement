<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('teacher_name','Name of Teacher') !!}<span class="text-danger">&#9733;</span>
            {!! Form::text('teacher_name', isset($teacher->teacher_name) ? $teacher->teacher_name : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('teacher_name_bangla','Name of Teacher (Bangla)') !!}<span class="text-danger">&#9733;</span>
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

          @if(empty($teacher->user->password))


          {!! Form::label('password','Password') !!}<span class="text-danger">&#9733;</span>
          {!! Form::password('password', ['class'=> 'awesome form-control']) !!}
          @endif
      </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">

        {!! Form::label('gender','Teacher Gender') !!} <span class="text-danger">&#9733;</span>
        {!! Form::select('gender', array('Male' => 'Male','Female' => 'Female','Other' => 'Other'),isset($teacher->gender) ? $teacher->gender : null, ['class'=> 'form-control']) !!}
    </div>
</div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('date_of_birth','Date of Birth') !!}<span class="text-danger">&#9733;</span>
            {!! Form::date('date_of_birth', isset($teacher->date_of_birth) ? $teacher->date_of_birth : null, ['class'=> 'form-control','id'=>'birth_date']) !!}
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
            {!! Form::label('religion', 'Religion') !!}<span class="text-danger">&#9733;</span>
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
            {!! Form::label('salary','Salary') !!}<span class="text-danger">&#9733;</span>
            {!! Form::text('salary', isset($teacher->salary) ? $teacher->salary : null, ['class'=> 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('designation','Designation') !!} <span class="text-danger">&#9733;</span>
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
            {!! Form::select('blood_group', array('A+ (A positive)' => 'A+ (A positive)','A− (A negative)' => 'A− (A negative)','B+ (B positive)' => 'B+ (B positive)','B− (B negative)' => 'B− (B negative)','AB+ (AB positive)' => 'AB+ (AB positive)','AB− (AB negative)' => 'AB− (AB negative)','O+ (O positive)' => 'O+ (O positive)','O− (O negative)' => 'O− (O negative)','Unknown' => 'Unknown'),isset($student->blood_group) ? $student->blood_group : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('teacher_joining_date','Joining Date') !!}<span class="text-danger">&#9733;</span>
            {!! Form::date('teacher_joining_date', isset($teacher->joining_date) ? $teacher->joining_date : null, ['id'=>'joining_date','class'=> 'form-control present_address',"onchange"=>"dateCheck()"]) !!}
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
            {!! Form::label('present_address','Present Address') !!}<span class="text-danger">&#9733;</span>
            {!! Form::textarea('present_address', isset($teacher->present_address) ? $teacher->present_address : null, ['class'=> 'form-control present_address']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('permanent_address','Permanent Address') !!}<span class="text-danger">&#9733;</span>
            {!! Form::textarea('permanent_address', isset($teacher->permanent_address) ? $teacher->permanent_address : null, ['class'=> 'form-control permanent_address']) !!}
        </div>
    </div> 
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('teacher_comment','Comment') !!}
            {!! Form::textarea('teacher_comment', isset($teacher->comment) ? $teacher->teacher_comment : null, ['class'=> 'form-control']) !!}
        </div>
    </div> 

</div>


<div class="row">
    <div class="col-md-12">
        <span style="font-weight: bold;">Bank Account Information</span>
        <span>{!! Form::checkbox('bank_check', null, null, array('id'=>'bank1', 'onclick'=>'myFunction1()' )) !!}</span>



        <div class="col-md-12" id="bank_account"  style="border-style: solid;">
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('account_holder_name','Account Holder Name') !!} <span class="text-danger">&#9733;</span>
                    {!! Form::text('account_holder_name', isset($teacher->bank_account->account_holder_name) ? $teacher->bank_account->account_holder_name : null, ['class'=> 'form-control']) !!}
                </div>
            </div> 
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('bank_name','Bank Name') !!}
                    <span class="text-danger">&#9733;</span>
                    {!! Form::text('bank_name', isset($teacher->bank_account->bank_name) ? $teacher->bank_account->bank_name : null, ['class'=> 'form-control']) !!}
                </div>
            </div> 
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('branch_name','Branch Name') !!} <span class="text-danger">&#9733;</span>
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
                    {!! Form::label('account_type','Account Type') !!} <span class="text-danger">&#9733;</span>
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
                    {!! Form::label('bank_comment','Comment') !!}
                    {!! Form::textarea('bank_comment', isset($teacher->bank_account->comment) ? $teacher->bank_account->comment : null, ['class'=> 'form-control']) !!}
                </div>
            </div>
        </div>

    </div>
</div>



<div class="row">
    <div class="col-md-12">

        <span style="font-weight: bold;">Mobile Bank Account Information</span> 
        {!! Form::checkbox('mobile_check', null, null, array('id'=>'mobileBank', 'onclick'=>'myFunction()' )) !!}


        <div class="col-md-12" id="mobile"  style="border-style: solid;">
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
        </div> 

    </div>
</div>




<div class="row">
    <div class="col-md-12">
        <span style="font-weight: bold;">Educational Qualification</span> 
        {!! Form::checkbox('edu_check', null, null, array('id'=>'edu', 'onclick'=>'education()' )) !!}
        <div id='edu_id'>

            <div class="text-right mb-2"><label id="add_edu_button" class="btn btn-info">Add</label><label id="minus_edu_button" class="btn btn-danger">Minus</label></div>

            <div id="add_edu_info">

                <div class="col-md-12 mb-2 edu_child" style="border-style: solid;">

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('degree_name','Degree Name') !!} <span class="text-danger">&#9733;</span>
                            {!! Form::text('degree_name[]', isset($teacher->education->degree_name) ? $teacher->education->degree_name : null, ['class'=> 'form-control']) !!}
                        </div>
                    </div> 

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('passing_year','Passing Year') !!} <span class="text-danger">&#9733;</span>
                            {!! Form::text('passing_year[]', isset($teacher->education->passing_year) ? $teacher->education->passing_year : null, ['class'=> 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('result','Result') !!} <span class="text-danger">&#9733;</span>
                            {!! Form::text('result[]', isset($teacher->education->result) ? $teacher->education->result : null, ['class'=> 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('edu_institute_name','Institute Name') !!} <span class="text-danger">&#9733;</span>
                            {!! Form::text('edu_institute_name[]', isset($teacher->education->institute_name) ? $teacher->education->institute_name : null, ['class'=> 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('edu_subject','Subject') !!} <span class="text-danger">&#9733;</span>
                            {!! Form::text('edu_subject[]', isset($teacher->education->subject) ? $teacher->education->subject : null, ['class'=> 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('education_board','Education Board') !!}
                            {!! Form::text('education_board[]', isset($teacher->education->education_board) ? $teacher->education->education_board : null, ['class'=> 'form-control']) !!}
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('education_comment','Comment') !!}
                            {!! Form::textarea('education_comment[]', isset($teacher->education->comment) ? $teacher->education->comment : null, ['class'=> 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div id="add_edu_info_more">

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <span style="font-weight: bold;">Training Info</span>
        {!! Form::checkbox('Training',null,null,array('id'=>'training_info','onclick'=>'trainingFunc()')) !!}
        <div id="training_div">
            <div class="text-right mb-2"><label id="add_training_button" class="btn btn-info">Add</label><label id="minus_training_button" class="btn btn-danger">Minus</label></div>
            <div id="add_training_info">

             <div class="col-md-12 mb-2 training_child"  style="border-style: solid;" >

                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('training_institute_name','Institute Name') !!} <span class="text-danger">&#9733;</span>
                        {!! Form::text('training_institute_name[]',isset( $teacher->training->institute_name)? $teacher->training->institute_name : null,['class'=> 'form-control'])!!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('training_subject','Subject')!!} <span class="text-danger">&#9733;</span>
                        {!! Form::text('training_subject[]',isset( $teacher->training->subject)? $teacher->training->subject:null,['class'=>'form-control'])!!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('training_place','Training Place')!!} <span class="text-danger">&#9733;</span>
                        {!! Form::text('training_place[]',isset( $teacher->training->training_place)? $teacher->training->training_place:null,['class'=>'form-control'])!!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('starting_date','Starting Date')!!} <span class="text-danger">&#9733;</span>
                        {!! Form::date('starting_date[]',isset( $teacher->training->starting_date)? $teacher->training->starting_date:null,['class'=>'form-control'])!!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('ending_date','Ending Date')!!} <span class="text-danger">&#9733;</span>
                        {!! Form::date('ending_date[]',isset( $teacher->training->ending_date)? $teacher->training->ending_date:null,['class'=>'form-control'])!!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('expiration','Expiration')!!} <span class="text-danger">&#9733;</span>
                        {!! Form::text('expiration[]',isset( $teacher->training->expiration)? $teacher->training->expiration:null,['class'=>'form-control'])!!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('training_comment','Comment')!!}
                        {!! Form::textarea('training_comment[]',isset( $teacher->training->comment)? $teacher->training->comment:null,['class'=>'form-control'])!!}

                    </div>
                </div>

            </div>
        </div>
        <div id="add_training_info_more">

        </div>

    </div> 
</div>
</div>

<div class="row">
    <div class="col-md-12">
        <span style="font-weight: bold;">Previous School Info</span>
        {!! Form::checkbox('prev_school',null,null,array('id'=>'prev_school_info','onclick'=>'prev_school_info_Func()')) !!}
        <div id="prev_school_info_div">

            <div class="text-right mb-2"><label id="add_prev_school_info_button" class="btn btn-info">Add</label><label id="minus_prev_school_info_button" class="btn btn-danger">Minus</label></div>
            <div id="add_prev_school_info">
                <div class="col-md-12 mb-2 prev_school_child" style="border-style: solid;" >
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('prev_scl_institute_name','Institute Name') !!} <span class="text-danger">&#9733;</span>
                            {!! Form::text('prev_scl_institute_name[]',isset( $teacher->previous_school->institute_name)? $teacher->previous_school->institute_name : null,['class'=> 'form-control'])!!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('prev_scl_designation','Designation')!!} <span class="text-danger">&#9733;</span>
                            {!! Form::text('prev_scl_designation[]',isset( $teacher->previous_school->designation)? $teacher->previous_school->designation:null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('prev_scl_appoiment_date','Appoiment Date')!!}
                            {!! Form::date('prev_scl_appoiment_date[]',isset( $teacher->previous_school->appoiment_date)? $teacher->previous_school->appoiment_date:null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('prev_scl_joining_date','Joining Date')!!} <span class="text-danger">&#9733;</span>
                            {!! Form::date('prev_scl_joining_date[]',isset( $teacher->previous_school->joining_date)? $teacher->previous_school->joining_date:null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('mpo_date','Mpo Date')!!}
                            {!! Form::date('mpo_date[]',isset( $teacher->previous_school->mpo_date)? $teacher->previous_school->mpo_date:null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('exemption_date','Exemption date')!!} <span class="text-danger">&#9733;</span>
                            {!! Form::date('exemption_date[]',isset( $teacher->previous_school->exemption_date)? $teacher->previous_school->exemption_date:null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('previous_school_comment','Comment')!!}
                            {!! Form::textarea('previous_school_comment[]',isset( $teacher->previous_school->comment)? $teacher->previous_school->comment:null,['class'=>'form-control'])!!}

                        </div>
                    </div>
                </div>

            </div>
            <div id="add_prev_school_info_more">

            </div>
        </div>

    </div> 
</div>


<div class="row">
    <div class="col-md-12">
        <span style="font-weight: bold;">NTRCA Info</span>
        {!! Form::checkbox('ntrca',null,null,array('id'=>'ntrca_info','onclick'=>'ntrca_info_Func()')) !!}
        <div id="ntrca_info_div">  
         <div class="text-right mb-2"><label id="add_ntrca_info_button" class="btn btn-info">Add</label><label id="minus_ntrca_info_button" class="btn btn-danger">Minus</label></div>
         <div id="add_ntrca_info">
             <div class="col-md-12 mb-2 ntrca_info_child" style="border-style: solid;" >
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('registation_no','Registation No') !!} <span class="text-danger">&#9733;</span>
                        {!! Form::text('registation_no[]',isset( $teacher->ntrca_info->registation_no)? $teacher->ntrca_info->registation_no : null,['class'=> 'form-control'])!!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('roll_no','Roll No')!!} <span class="text-danger">&#9733;</span>
                        {!! Form::text('roll_no[]',isset( $teacher->ntrca_info->roll_no)? $teacher->ntrca_info->roll_no:null,['class'=>'form-control'])!!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('ntrca_subject','Subject')!!} <span class="text-danger">&#9733;</span>
                        {!! Form::text('ntrca_subject[]',isset( $teacher->ntrca_info->subject)? $teacher->ntrca_info->subject:null,['class'=>'form-control'])!!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('ntrca_passing_year','Passing Year')!!} <span class="text-danger">&#9733;</span>
                        {!! Form::number('ntrca_passing_year[]',isset( $teacher->ntrca_info->passing_year)? $teacher->ntrca_info->passing_year:null,['class'=>'form-control'])!!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('ntrca_appoiment_date','Appoiment Date')!!} <span class="text-danger">&#9733;</span>
                        {!! Form::date('ntrca_appoiment_date[]',isset( $teacher->ntrca_info->appoiment_date)? $teacher->ntrca_info->appoiment_date:null,['class'=>'form-control'])!!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('ntrca_joining_date','Joining Date')!!} <span class="text-danger">&#9733;</span>
                        {!! Form::date('ntrca_joining_date[]',isset( $teacher->ntrca_info->joining_date)? $teacher->ntrca_info->joining_date:null,['class'=>'form-control'])!!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('ntrca_comment','Comment')!!}
                        {!! Form::textarea('ntrca_comment[]',isset( $teacher->ntrca_info->comment)? $teacher->ntrca_info->comment:null,['class'=>'form-control'])!!}

                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="add_ntrca_info_more">

    </div>
</div> 
</div>

<div class="row">
    <div class="col-md-12">
        <span style="font-weight: bold;">Scale Change Info</span>
        {!! Form::checkbox('scale_change',null,null,array('id'=>'scale_change_info','onclick'=>'scale_change_info_Func()')) !!}
        <div id="scale_change_info_div">
          <div class="text-right mb-2"><label id="add_scale_change_info_button" class="btn btn-info">Add</label><label id="minus_scale_change_info_button" class="btn btn-danger">Minus</label></div>
          <div id="add_scale_change_info">
              <div class="col-md-12 mb-2 scale_change_child"   style="border-style: solid;" >
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('salary_grade','Salary Grade') !!}
                        {!! Form::text('salary_grade[]',isset( $teacher->scale_changing->salary_grade)? $teacher->scale_changing->salary_grade : null,['class'=> 'form-control'])!!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('present_salary_scale','Present Salary Scale')!!}
                        {!! Form::text('present_salary_scale[]',isset( $teacher->scale_changing->present_salary_scale)? $teacher->scale_changing->present_salary_scale:null,['class'=>'form-control'])!!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('first_mpo_joining_date','First Mpo Joining Date')!!}
                        {!! Form::date('first_mpo_joining_date[]',isset( $teacher->scale_changing->first_mpo_joining_date)? $teacher->scale_changing->first_mpo_joining_date:null,['class'=>'form-control'])!!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('first_high_scale_date','First high Scale Date')!!}
                        {!! Form::date('first_high_scale_date[]',isset( $teacher->scale_changing->first_high_scale_date)? $teacher->scale_changing->first_high_scale_date:null,['class'=>'form-control'])!!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('second_high_scale_date','Second High Scale Date')!!}
                        {!! Form::date('second_high_scale_date[]',isset( $teacher->scale_changing->second_high_scale_date)? $teacher->scale_changing->second_high_scale_date:null,['class'=>'form-control'])!!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('first_time_scale_date','First Time Scale Date')!!}
                        {!! Form::date('first_time_scale_date[]',isset( $teacher->scale_changing->first_time_scale_date)? $teacher->scale_changing->first_time_scale_date:null,['class'=>'form-control'])!!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('second_time_scale_date','Second Time Scale Date')!!}
                        {!! Form::date('second_time_scale_date[]',isset( $teacher->scale_changing->second_time_scale_date)? $teacher->scale_changing->second_time_scale_date:null,['class'=>'form-control'])!!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('bed_scale_date','Bed_scale_date')!!}
                        {!! Form::date('bed_scale_date[]',isset( $teacher->scale_changing->bed_scale_date)? $teacher->scale_changing->bed_scale_date:null,['class'=>'form-control'])!!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('scale_comment','Comment')!!}
                        {!! Form::textarea('scale_comment[]',isset( $teacher->scale_changing->comment)? $teacher->scale_changing->comment:null,['class'=>'form-control'])!!}

                    </div>
                </div>

            </div>
        </div>
        <div id="add_scale_change_info_more">

        </div>
    </div>

</div> 

</div> 









<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('teacher_photo','Choose image') !!}  <span class="text-danger">&#9733;</span>
            {!! Form::file('teacher_photo') !!}
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
    function  dateCheck(){
        var birth_date=$('#birth_date').val();
        var joining_date=$('#joining_date').val();

        if(birth_date>joining_date){

            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Joining Date Should be greater than date of birth',
              footer: ''
          })
            $('#joining_date').val(" "); 

        }

    }
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

<script type="text/javascript">
    $(document).ready(function(){
        var present_value= $(".present_address").val();
        if(present_value == ""){
            $(".present_address").html("Village: \n\nDistrict: \n\nThana: \n\nP.O:  ");
        }
        var permanent_value= $(".permanent_address").val();
        if(permanent_value == ""){
            $(".permanent_address").html("Village: \n\nDistrict: \n\nThana: \n\nP.O:  ");
        }

    })
</script>
<script type="text/javascript">
    $("#add_training_button").click(function(){
        var training_html=$("#add_training_info").html();
        $("#add_training_info_more").append(training_html);
    })

    $("#minus_training_button").click(function(){

        $("#add_training_info_more .training_child:last-child").remove();
    })

    $("#add_edu_button").click(function(){
        var edu_html=$("#add_edu_info").html();
        $("#add_edu_info_more").append(edu_html);
        
    })

    $("#minus_edu_button").click(function(){

        $("#add_edu_info_more .edu_child:last-child").remove();
    })

    $("#add_prev_school_info_button").click(function(){
        var prev_school=$("#add_prev_school_info").html();
        $("#add_prev_school_info_more").append(prev_school);
        
    })

    $("#minus_prev_school_info_button").click(function(){

        $("#add_prev_school_info_more .prev_school_child:last-child").remove();
    })

    $("#add_ntrca_info_button").click(function(){
        var ntrca=$("#add_ntrca_info").html();
        // alert(ntrca);
        $("#add_ntrca_info_more").append(ntrca);

        
    })

    $("#minus_ntrca_info_button").click(function(){

        $("#add_ntrca_info_more .ntrca_info_child:last-child").remove();
    })

    $("#add_scale_change_info_button").click(function(){
        var scale_change=$("#add_scale_change_info").html();
        // alert(scale_change);
        $("#add_scale_change_info_more").append(scale_change);

        
    })

    $("#minus_scale_change_info_button").click(function(){

        $("#add_scale_change_info_more .scale_change_child:last-child").remove();
    })


    


    
</script>
