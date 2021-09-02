@section('heading')
Attendance System
@endsection
@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            	
                
               <!--  <div class="alert alert-success " id="mess">
                    
                    <div id="msg"></div>
                </div> -->

                <div class="row pt-4 px-3">

                    <div class="col-md-3">
                        <p>Session: {{$session->name}}</p>
                    </div>
                    <div class="col-md-3">
                        <p>Class:{{$level->class_name}}</p>
                    </div>
                    <div class="col-md-3">
                        <p>Section:{{$section->section_name}}</p>
                    </div>
                    <div class="col-md-3">
                        <p>Date:{{$class_date}}</p>
                    </div>

                    
                </div>
                <div class="px-3">
                 <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Roll</th>
                      <th scope="col">Name</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
              <tbody>
                @foreach($attendance_status_data as $asd)
                @php
                if($asd->section_id == $section->id){

                @endphp
                <tr>
                  <th>{{ $loop->iteration }}</th>
                  <td>{{$asd->roll}}</td>
                  @php
                  $student=\App\Student::where('id',$asd->student_id)->first();
                  @endphp

                  <td>{{$student->name}}</td>
                  <td><input data-id="{{$asd->id}}" class="toggle-class" type="checkbox" data-toggle="toggle" data-on="Present" data-off="Absent" data-onstyle="btn btn-fill btn-success" data-offstyle="btn btn-fill btn-danger" {{$asd->status?'checked':''}}>

                  </td>
                </tr>

                @php
                }
                @endphp
              @endforeach
          </tbody>
      </table>
  </div>

</div>
</div>
</div>
</div>
<script type="text/javascript">

    $(document).ready(function(){



        $('.toggle-class').on('change',function(){
            var id=$(this).data('id');
            var status=$(this).prop('checked')==true? 1:0;
              

              
            $.ajax({

              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url:'attendance_status' ,
              type: "POST",
          
              data: {

                'status': status,
                'id':id

            },
            success: function(data) {
              
               // $('#msg').html("Updaated");

                
               
          },
          error:function(){
              alert('Error');
          }

      });

        });
    });
</script>
@endsection
