<div class="m-1 p-4" style="border-style: solid;">

    {!! Form::open(['method' => 'PUT', 'url' => ['/students/'.$student->id], 'files'=>'true']) !!}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('name','Name of Student') !!} <span class="text-danger">&#9733;</span>
                {!! Form::text('name', isset($student->name) ? $student->name : null, ['class'=> 'form-control']) !!}
            </div>
        </div> 
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('name_bangla','Name of Student(Bangla)') !!} <span class="text-danger">&#9733;</span>
                {!! Form::text('name_bangla', isset($student->name_bangla) ? $student->name_bangla : null, ['class'=> 'form-control']) !!}
            </div>
        </div>   
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('roll_no','Global ID.') !!} <span class="text-danger">&#9733;</span>
                {!! Form::text('roll_no', (isset($student->roll_no) && $student->roll_no != 0) ? $student->roll_no : date('YmdHis').rand(1000,9999), ['class'=> 'form-control', 'readonly' => '']) !!}
            </div>
        </div>     
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('gvt_unique_id','Government Unique Id') !!}
                {!! Form::text('gvt_unique_id', isset($student->gvt_unique_id) ? $student->gvt_unique_id : null, ['class'=> 'form-control']) !!}
         </div>
     </div>
 </div>
 <div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('fathers_name','Father Name(English)') !!} <span class="text-danger">&#9733;</span>
            {!! Form::text('fathers_name', isset($student->fathers_name) ? $student->fathers_name : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('fathers_name_bangla','Father Name(Bangla)') !!} <span class="text-danger">&#9733;</span>
            {!! Form::text('fathers_name_bangla', isset($student->fathers_name_bangla) ? $student->fathers_name_bangla : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('father_nid','Father Nid Number') !!}
            {!! Form::text('father_nid', isset($student->father_nid_num) ? $student->father_nid_num : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
     <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('mothers_name','Mother Name(English)') !!} <span class="text-danger">&#9733;</span>
            {!! Form::text('mothers_name', isset($student->mothers_name) ? $student->mothers_name : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('mothers_name_bangla','Mother Name(Bangla)') !!} <span class="text-danger">&#9733;</span>
            {!! Form::text('mothers_name_bangla', isset($student->mothers_name_bangla) ? $student->mothers_name_bangla : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('mother_nid','Mother Nid Number') !!}
            {!! Form::text('mother_nid', isset($student->mother_nid_num) ? $student->mother_nid_num : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('father_profession','Father Profession') !!} 
            {!! Form::text('father_profession', isset($student->father_profession) ? $student->father_profession : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('mother_profession','Mother Profession') !!}
            {!! Form::text('mother_profession', isset($student->mother_profession) ? $student->mother_profession: null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <!-- <div class="form-group">
            {!! Form::label('blood_group','Blood Group') !!}
            {!! Form::text('blood_group', isset($student->blood_group) ? $student->blood_group : null, ['class'=> 'form-control']) !!}
        </div> -->

        <div class="form-group">
            {!! Form::label('blood_group','Blood Group') !!}
            {!! Form::select('blood_group', array('A+ (A positive)' => 'A+ (A positive)','A− (A negative)' => 'A− (A negative)','B+ (B positive)' => 'B+ (B positive)','B− (B negative)' => 'B− (B negative)','AB+ (AB positive)' => 'AB+ (AB positive)','AB− (AB negative)' => 'AB− (AB negative)','O+ (O positive)' => 'O+ (O positive)','O− (O negative)' => 'O− (O negative)','Unknown' => 'Unknown'),isset($student->blood_group) ? $student->blood_group : null, ['class'=> 'form-control']) !!}
        </div>
    </div>     
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('scholarship','Scholarship') !!}
            {!! Form::text('scholarship', isset($student->scholarship) ? $student->scholarship :null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('local_guardian_name','Local Guardian Name') !!}
            {!! Form::text('local_guardian_name', isset($student->local_guardian_name) ? $student->local_guardian_name : null, ['class'=> 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('student_guardian_relationship','Local Guardian and student relationship') !!}
            {!! Form::text('student_guardian_relationship', isset($student->student_guardian_relationship) ? $student->student_guardian_relationship : null, ['class'=> 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('local_guardian_cell','Local Guardian Phone Number') !!}
            {!! Form::text('local_guardian_cell', isset($student->local_guardian_cell) ? $student->local_guardian_cell : null, ['class'=> 'form-control']) !!}
        </div>

    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('local_guardian_address','Local Guardian Address') !!}
            {!! Form::textarea('local_guardian_address', isset($student->local_guardian_address) ? $student->local_guardian_address : null, ['class'=> 'form-control']) !!}
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('date_of_birth','Date of Birth') !!} <span class="text-danger">&#9733;</span>
            {!! Form::date('date_of_birth', isset($student->date_of_birth) ? $student->date_of_birth : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">

            {!! Form::label('nationality','Nationality') !!} <span class="text-danger">&#9733;</span>
            {!! Form::text('nationality', isset($student->nationality) ? $student->nationality : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">

            {!! Form::label('religion','Religion') !!} <span class="text-danger">&#9733;</span>
            {!! Form::select('religion', array('Islam' => 'Islam','Hindu' => 'Hindu','Buddhist' => 'Buddhist','Christian' => 'Christian','Other' => 'Other'),isset($student->religion) ? $student->religion : null, ['class'=> 'form-control']) !!}

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('admission_date','Admission Date') !!} <span class="text-danger">&#9733;</span>
            {!! Form::date('admission_date', isset($student->admission_date) ? $student->admission_date : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">

            {!! Form::label('gender','Student Gender') !!} <span class="text-danger">&#9733;</span>
            {!! Form::select('gender', array('Male' => 'Male','Female' => 'Female','Other' => 'Other'),isset($student->gender) ? $student->gender : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">

            {!! Form::label('contact_no','Contact no.') !!} <span class="text-danger">&#9733;</span>
            {!! Form::text('contact_no', isset($student->contact_no) ? $student->contact_no : null, ['class'=> 'form-control']) !!}

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('fathers_cell','Father\'s Contact no.') !!} <span class="text-danger">&#9733;</span>
            {!! Form::text('fathers_cell', isset($student->fathers_cell) ? $student->fathers_cell : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('mothers_cell','Mother\'s Contact no.') !!} <span class="text-danger">&#9733;</span>
            {!! Form::text('mothers_cell', isset($student->mothers_cell) ? $student->mothers_cell : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="birth_place">Birth Place</label> <span class="text-danger">&#9733;</span>
            <input class="form-control" type="text" name="birth_place" value="{{isset($student->birth_place) ? $student->birth_place : null}}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('birth_certificate_number','Birth Certificate Number') !!} <span class="text-danger">&#9733;</span>
            {!! Form::text('birth_certificate_number', isset($student->birth_certificate_number) ? $student->birth_certificate_number : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('admission_class','Admission Class') !!} <span class="text-danger">&#9733;</span>
            {!! Form::text('admission_class', isset($student->admission_class) ? $student->admission_class : null, ['class'=> 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('admission_department','Admission Department') !!}
            {!! Form::text('admission_department', isset($student->admission_department) ? $student->admission_department : null, ['class'=> 'form-control']) !!}
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('admission_type','Admission Type') !!} <span class="text-danger">&#9733;</span>
            {!! Form::text('admission_type', isset($student->admission_type) ? $student->admission_type : null, ['class'=> 'form-control']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('previous_school_name','Previous School Name') !!} <span class="text-danger">&#9733;</span>
            {!! Form::text('previous_school_name', isset($student->previous_school_name) ? $student->previous_school_name : null, ['class'=> 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('previous_school_address','Previous School Address') !!} <span class="text-danger">&#9733;</span>
            {!! Form::textarea('previous_school_address', isset($student->previous_school_address) ? $student->previous_school_address : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>

    <!-- <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('present_address','Present Address of Student') !!}
                {!! Form::textarea('present_address', isset($student->present_address) ? $student->present_address : null, ['class'=> 'form-control present_address']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">

                {!! Form::label('permanent_address','Permanent Address of Student') !!}
                {!! Form::textarea('permanent_address', isset($student->permanent_address) ? $student->permanent_address : null, ['class'=> 'form-control permanent_address']) !!}

            </div>
        </div>
    </div> -->
    <div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('previous_school_class','Previous School Class') !!}
            {!! Form::text('previous_school_class', isset($student->previous_school_class) ? $student->previous_school_class : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('previous_school_testimonial_number','Previous School Testimonial Number') !!}
            {!! Form::text('previous_school_testimonial_number', isset($student->previous_school_testimonial_number) ? $student->previous_school_testimonial_number : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('previous_school_testimonial_date','Previous School Testimonial Date') !!}
            {!! Form::date('previous_school_testimonial_date', isset($student->previous_school_testimonial_date) ? $student->previous_school_testimonial_date : null, ['class'=> 'form-control ']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('tc_number','TC Number') !!}
            {!! Form::text('tc_number', isset($student->tc_number) ? $student->tc_number : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('tc_date','TC Date') !!}
            {!! Form::date('tc_date', isset($student->tc_date) ? $student->tc_date : null, ['class'=> 'form-control ']) !!}
        </div>
    </div>
</div>
    
    <div class="row">
        <div class="col-md-12"><p>Present Address</p></div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('village','Village') !!}
                {!! Form::text('village', isset($student->present->village) ? $student->present->village : null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('post_office','Post Office') !!}
                {!! Form::text('post_office',isset($student->present->post_office) ? $student->present->post_office : null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('upazila','Thana/Upazila') !!}
                {!! Form::text('upazila', isset($student->present->upazila) ? $student->present->upazila : null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('district','District') !!}
                {!! Form::text('district',isset($student->present->district) ? $student->present->district : null, ['class'=> 'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12"><p>Permanent Address</p></div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('village_name','Village') !!}
                {!! Form::text('village_name', isset($student->permanent->village) ? $student->permanent->village : null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('post_office_name','Post Office') !!}
                {!! Form::text('post_office_name', isset($student->permanent->post_office) ? $student->permanent->post_office : null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('upazila_name','Thana/Upazila') !!}
                {!! Form::text('upazila_name', isset($student->permanent->upazila) ? $student->permanent->upazila : null, ['class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('district_name','District') !!}
                {!! Form::text('district_name', isset($student->permanent->district) ? $student->permanent->district : null, ['class'=> 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">

                {!! Form::label('Status','Status') !!}
                {!! Form::select('status', ['1' => 'Enable','0' => 'Disable'],isset($student->status) ? $student->status : null, ['class'=> 'form-control']) !!}

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('student_photo','Choose image') !!} <span class="text-danger">&#9733;</span>
                {!! Form::file('student_photo') !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('birth_certificate_image','Choose birth certificate image') !!}
                {!! Form::file('birth_certificate_image') !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <div class="text-center">
                {!! Form::submit('Update', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                {!! link_to(URL::previous(), 'Cancel', ['class' => 'btn btn-default btn-fill btn-wd']) !!}
            </div>
        </div>
    </div>

    {!! Form::close() !!}
</div>
<div class="row">
    <div class="col-md-12">
        <div class="header">
            <h4 class="title">Edit Public Exam Information</h4>
        </div>
        <div id="public_exam_section">
           @foreach ($student->public_exam as $info)
           {!! Form::open(['method' => 'PUT', 'url' => ['/publicExams/'.$info->id], 'files'=>'true']) !!}
           <div class="common">

            <div class="col-md-12 my-2 child1"  style="border-style: solid;">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('exam_name','Exam Name') !!} <span class="text-danger">&#9733;</span>
                        {!! Form::text('exam_name', isset($info->exam_name) ? $info->exam_name : null, ['class'=> 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('year','Year') !!}
                        {!! Form::text('year', isset($info->year) ? $info->year : null, ['class'=> 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('public_roll_no','Roll No.') !!}
                        {!! Form::text('public_roll_no', isset($info->roll_no) ? $info->roll_no : null, ['class'=> 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('reg_no','Reg No.') !!}
                        {!! Form::text('reg_no', isset($info->reg_no) ? $info->reg_no : null, ['class'=> 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('board','Board') !!}
                        {!! Form::text('board', isset($info->board) ? $info->board : null, ['class'=> 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('department','Department') !!}
                        {!! Form::text('department', isset($info->department) ? $info->department : null, ['class'=> 'form-control']) !!}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('result','Result') !!}
                        {!! Form::text('result', isset($info->result) ? $info->result : null, ['class'=> 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="text-center">
                            {!! Form::submit('Update', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                            {!! link_to(URL::previous(), 'Cancel', ['class' => 'btn btn-default btn-fill btn-wd']) !!}
                            <span>
                                {!! Form::open(['method' => 'DELETE', 'url' => ['/publicExams/'.$info->id], 'files'=>'true']) !!}
                                {!! Form::submit('Delete', array('class'=> 'btn btn-danger btn-fill btn-wd')) !!}
                                {!! Form::close() !!}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {!! Form::close() !!}
        @endforeach
    </div>

</div>

</div>

<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add More</button>




