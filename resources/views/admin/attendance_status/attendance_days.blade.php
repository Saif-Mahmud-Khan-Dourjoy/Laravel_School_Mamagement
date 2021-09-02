@section('heading')
Attendance System
@endsection
@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel-heading" style="background-color: #f2f2f2;">
                <h5 class="title" align="center"><strong>Attendance Days</strong></h5>
            </div>
        </div>
  
        <div class="row pt-4 px-3 text-center">
            <div class="col-md-4">
                <p>Session: {{$session->name}}</p>
            </div>
            <div class="col-md-4">
                <p>Class:{{$level->class_name}}</p>
            </div>
            <div class="col-md-4">
                <p>Section:{{$section->section_name}}</p>
            </div>
        </div>
        <hr>
        <div class="row m-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                @if(isset($working_days))
                <tbody>
                    @foreach($working_days as $working_day)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{$working_day->date}}</td>
                        
                        <td>
                            <form method="post" action="{{route('attendance.delete',$working_day->id)}}">
                                @csrf
                                <button  type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <!-- <button type="button" class="btn btn-danger btn-fill" data-toggle="modal" data-target="#dltbtn">Delete</button> -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                @endif
                
            </table>
        </div>

    </div>
</div>



@endsection

@section('modal-parts') 

@endsection
