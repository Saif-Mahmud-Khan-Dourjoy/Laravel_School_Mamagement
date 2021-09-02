@section('heading')
Studentes
@endsection


@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">

                    <div class="panel-heading"  style="background-color: #f2f2f2;">
                        <h4 class="title" align="center">Studensts Information Form</h4>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li> {{ $error }} </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                     <div>
                        @include('layouts.flash_message')
                    </div>

                    <div class="panel-body">
                        <div class="header">
                            <h4 class="title">Edit Student details</h4>
                        </div>
                        

                        @include('admin.students.form_update')

                        


                     
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal-parts')

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center">Public Exam Information</h4>
        </div>
        <!-- <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li> {{ $error }} </li>
                @endforeach
            </ul>
        </div> -->
        <div class="">
           {!! Form::open(['method' => 'POST', 'url' => ['/publicExam/store/'.$student->id], 'files'=>'true']) !!}
            <div class="">
            
                <div class="col-md-12 my-2 child1">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('exam_name','Exam Name') !!}<span class="text-danger">&#9733;</span>
                            {!! Form::text('exam_name', null, ['class'=> 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('year','Year') !!}<span class="text-danger">&#9733;</span>
                            {!! Form::text('year', null, ['class'=> 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('public_roll_no','Roll No.') !!}<span class="text-danger">&#9733;</span>
                            {!! Form::text('public_roll_no', null, ['class'=> 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('reg_no','Reg No.') !!}
                            {!! Form::text('reg_no',null, ['class'=> 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('board','Board') !!}
                            {!! Form::text('board', null, ['class'=> 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('department','Department') !!}
                            {!! Form::text('department',null, ['class'=> 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('result','Result') !!}
                            {!! Form::text('result', null, ['class'=> 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="text-center">
                                {!! Form::submit('Submit', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {!! Form::close() !!}
          
        </div>
        <div class="modal-footer">
          
        </div>
        
      </div>
      
    </div>
  </div>

@endsection