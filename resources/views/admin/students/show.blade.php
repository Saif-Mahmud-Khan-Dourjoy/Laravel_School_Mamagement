@section('heading')

Student Profile

@endsection


@extends('layouts.app')

@section('content')
<div class="content">
  <?php
  $section_student = \App\SectionStudent::where('student_id', $student->id)->get()->first();

  if($section_student!= null) {
    $section = \App\Section::find($section_student->section_id);
    $level = \App\Level::find(\App\LevelEnroll::find($section->level_enroll_id)->level_id); 
  }
  else {
      //dd($section_student);
  }

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
            <img class="avatar border-gray" src="{{asset($student->student_photo)}}" alt="profile Pic" >

            <h5 class="title">{{$student->name}}</h5>
            <p class="description">{{$student->name_bangla}}</p>
            <p class="description">{{$student->roll_no}}</p>                 
          </div>

        </div>
        <div class="card-footer">
          <hr>
          <div class="button-container">

            <div class="row" style="padding-left: 3em">
              <div class="col-lg-4 col-md-6 col-6 ml-auto">

                <h5>{{isset($level->class_name) ? $level->class_name : null}}
                  <br>
                  <small>Class</small>
                </h5>
              </div>
              <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                <h5>{{isset($section->section_name) ? $section->section_name : null}}
                  <br>
                  <small>Section</small>
                </h5>
              </div>
              <div class="col-lg-3 mr-auto">
                <h5>{{$student->gender}}
                  <br>
                  <small>Gender</small>
                </h5>
              </div>
            </div>


          </div>
        </div>
      </div>

    </div>

    <div class="col-md-7" style="padding-top: 5px">
      <div class="card card-user" style="padding-top: 5px; padding-left: 20px; padding-right: 10px">
        <div class="card-header">
          <h5 class="card-title">Profile Details</h5>
        </div>
        <div class="card-body">
          <form>
            <div class="row">
              <div class="col-md-5 pr-1">
                <div class="form-group">
                  {!! Form::label('contact_no','Contact no.') !!}
                  {!! Form::label('contact_no', isset($student->contact_no) ? $student->contact_no : null, ['class'=> 'form-control']) !!}
                </div>
              </div>
              <div class="col-md-3 px-1">
                <div class="form-group">
                  {!! Form::label('nationality','Nationality:') !!}
                  {!! Form::label('nationality', isset($student->nationality) ? $student->nationality : null, ['class'=> 'form-control']) !!}
                </div>
              </div>
              <div class="col-md-4 pl-1">
                <div class="form-group">
                  {!! Form::label('religion','Religion:') !!}
                  {!! Form::label('religion', isset($student->religion) ? $student->religion : null, ['class'=> 'form-control']) !!}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  {!! Form::label('fathers_name','Fathers Name:') !!}
                  {!! Form::label('fathers_name', isset($student->fathers_name) ? $student->fathers_name : null, ['class'=> 'form-control']) !!}
                  {!! Form::label('fathers_name_bangla', isset($student->fathers_name_bangla) ? $student->fathers_name_bangla : null, ['class'=> 'form-control']) !!}

                </div>
              </div>
              <div class="col-md-6 pl-1">
                <div class="form-group">
                  {!! Form::label('mothers_name_bangla','Mothers Name:') !!}
                  {!! Form::label('mothers_name', isset($student->mothers_name) ? $student->mothers_name : null, ['class'=> 'form-control']) !!}
                  {!! Form::label('mothers_name', isset($student->mothers_name_bangla) ? $student->mothers_name_bangla : null, ['class'=> 'form-control']) !!}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  {!! Form::label('fathers_cell','Fathers Contact no.:') !!}
                  {!! Form::label('fathers_cell', isset($student->fathers_cell) ? $student->fathers_cell : null, ['class'=> 'form-control']) !!}

                </div>
              </div>
              <div class="col-md-6 pl-1">
                <div class="form-group">
                  {!! Form::label('mothers_cell','Mothers Contact no.') !!}
                  {!! Form::label('mothers_cell', isset($student->mothers_cell) ? $student->mothers_cell : null, ['class'=> 'form-control']) !!}
                </div>
              </div>
            </div>

            <div class="row">
              <p>Present Address</p>
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('village','Village:') !!}
                  {!! Form::label('village', isset($student->present->village) ? $student->present->village : null, ['class'=> 'form-control']) !!}
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('post_office','Post Office:') !!}
                  {!! Form::label('post_office', isset($student->present->post_office) ? $student->present->post_office : null, ['class'=> 'form-control']) !!}
                </div>
              </div>
              <div class="col-md-6"> 
                <div class="form-group">
                  {!! Form::label('upazila','Upazila:') !!}
                  {!! Form::label('upazila', isset($student->present->upazila) ? $student->present->upazila : null, ['class'=> 'form-control']) !!}
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('district','District:') !!}
                  {!! Form::label('district', isset($student->present->district) ? $student->present->district : null, ['class'=> 'form-control']) !!}
                </div>
              </div>
            </div>
            <div class="row">
              <p>Permanent Address</p>
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('village','Village:') !!}
                  {!! Form::label('village', isset($student->permanent->village) ? $student->permanent->village : null, ['class'=> 'form-control']) !!}
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('post_office','Post Office:') !!}
                  {!! Form::label('post_office', isset($student->permanent->post_office) ? $student->permanent->post_office : null, ['class'=> 'form-control']) !!}
                </div>
              </div>
              <div class="col-md-6"> 
                <div class="form-group">
                  {!! Form::label('upazila','Upazila:') !!}
                  {!! Form::label('upazila', isset($student->permanent->upazila) ? $student->permanent->upazila : null, ['class'=> 'form-control']) !!}
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('district','District:') !!}
                  {!! Form::label('district', isset($student->permanent->district) ? $student->permanent->district : null, ['class'=> 'form-control']) !!}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  {!! Form::label('date_of_birth','Date of Birth:') !!}
                  {!! Form::label('date_of_birth', isset($student->date_of_birth) ? $student->date_of_birth : null, ['class'=> 'form-control']) !!}

                </div>
              </div>
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  {!! Form::label('blood_group','Blood Group:') !!}
                  {!! Form::label('blood_group', isset($student->blood_group) ? $student->blood_group : null, ['class'=> 'form-control']) !!}

                </div>
              </div>
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  {!! Form::label('scholarship','Scholarship:') !!}
                  {!! Form::label('scholarship', isset($student->scholarship) ? $student->scholarship : null, ['class'=> 'form-control']) !!}

                </div>
              </div>
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  {!! Form::label('father_nid_num','Father NID Number:') !!}
                  {!! Form::label('father_nid_num', isset($student->father_nid_num) ? $student->father_nid_num : null, ['class'=> 'form-control']) !!}

                </div>
              </div>
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  {!! Form::label('mother_nid_num','Mother NID Number:') !!}
                  {!! Form::label('mother_nid_num', isset($student->mother_nid_num) ? $student->mother_nid_num : null, ['class'=> 'form-control']) !!}

                </div>
              </div>

              <div class="col-md-6 pl-1">
                <div class="form-group">
                  {!! Form::label('admission_date','Date of Admission:') !!}
                  {!! Form::label('admission_date', isset($student->admission_date) ? $student->admission_date : null, ['class'=> 'form-control']) !!}
                </div>
              </div>
            </div>
            <div class="row">
              <p>More Info</p>
            </div>
            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  {!! Form::label('local_guardian_name','Local Guardian Name') !!}
                  {!! Form::label('local_guardian_name', isset($student->local_guardian_name) ? $student->local_guardian_name : null, ['class'=> 'form-control']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('student_guardian_relationship','Student Guardian Relationship:') !!}
                  {!! Form::label('student_guardian_relationship', isset($student->student_guardian_relationship) ? $student->student_guardian_relationship : null, ['class'=> 'form-control']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('local_guardian_cell','Local Guardian Mobile Number') !!}
                  {!! Form::label('local_guardian_cell', isset($student->local_guardian_cell) ? $student->local_guardian_cell : null, ['class'=> 'form-control']) !!}
                </div>

              </div>

              
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('local_guardian_address','Local Guardian Address:') !!}
                  {!! Form::textarea('local_guardian_address', isset($student->local_guardian_address) ? $student->local_guardian_address : null, ['class'=> 'form-control','disabled']) !!}
                </div>
              </div>

            </div>  


            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  {!! Form::label('previous_school_name','Previous School Name') !!}
                  {!! Form::label('previous_school_name', isset($student->previous_school_name) ? $student->previous_school_name : null, ['class'=> 'form-control']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('previous_school_address','Previous School Address') !!}
                  {!! Form::label('previous_school_address', isset($student->previous_school_address) ? $student->previous_school_address : null, ['class'=> 'form-control']) !!}
                </div>

              </div>

              <div class="col-md-6 pl-1">
                <div class="form-group">
                  {!! Form::label('admission_class','Admission Class') !!}
                  {!! Form::label('admission_class', isset($student->admission_class) ? $student->admission_class : null, ['class'=> 'form-control']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('admission_department','Admission Department') !!}
                  {!! Form::label('admission_department', isset($student->admission_department) ? $student->admission_department : null, ['class'=> 'form-control']) !!}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  {!! Form::label('admission_type','Admission Type') !!}
                  {!! Form::label('admission_type', isset($student->admission_type) ? $student->admission_type : null, ['class'=> 'form-control']) !!}
                </div>
              </div>
              <div class="col-md-6 pl-1">
                <div class="form-group">
                  {!! Form::label('added_by','Added By-') !!}
                  {!! Form::label('added_by', isset($student->added_by) ? $student->added_by : null, ['class'=> 'form-control']) !!}
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
                <div class="form-group">
                  {!! Form::label('previous_school_testimonial_number','Previous School Testimonial Number') !!}
                  {!! Form::text('previous_school_testimonial_number', isset($student->previous_school_testimonial_number) ? $student->previous_school_testimonial_number : null, ['class'=> 'form-control']) !!}
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('previous_school_testimonial_date','Previous School Testimonial Date') !!}
                  {!! Form::date('previous_school_testimonial_date', isset($student->previous_school_testimonial_date) ? $student->previous_school_testimonial_date : null, ['class'=> 'form-control ']) !!}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('tc_number','TC Number') !!}
                  {!! Form::text('tc_number', isset($student->tc_number) ? $student->tc_number : null, ['class'=> 'form-control']) !!}
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('tc_date','TC Date') !!}
                  {!! Form::date('tc_date', isset($student->tc_date) ? $student->tc_date : null, ['class'=> 'form-control ']) !!}
                </div>
              </div>
               <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('previous_school_class','Previous School Class') !!}
                  {!! Form::text('previous_school_class', isset($student->previous_school_class) ? $student->previous_school_class : null, ['class'=> 'form-control']) !!}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <p>Pubic Exam Information</p>
              </div>
              @php
              $public_exam_count = \App\PublicExam::where('student_id', $student->id)->count();
              if($public_exam_count>0){


                @endphp

                <div class="col-md-12">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Exam Name</th>
                        <th scope="col">Year</th>
                        <th scope="col">Roll No</th>
                        <th scope="col">Registation No</th>
                        <th scope="col">Board</th>
                        <th scope="col">Dept.</th>
                        <th scope="col">Result</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($student->public_exam as $info)
                      <tr>
                        <td>{{ $info->exam_name }}</td>
                        <td>{{ $info->year }}</td>
                        <td>{{ $info->roll_no }}</td>
                        <td>{{ $info->reg_no }}</td>
                        <td>{{ $info->board }}</td>
                        <td>{{ $info->department }}</td>
                        <td>{{ $info->result }}</td>
                      </tr>
                      @endforeach
                      <tbody>
                      </table>
                    </div>


                    @php
                  }
                  else{

                    @endphp


                    <div class="border p-4 m-4 text-center">
                      <p>No Data Found!</p>
                    </div>


                    @php
                  }
                  @endphp
                  
                </div>



              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    @endsection
