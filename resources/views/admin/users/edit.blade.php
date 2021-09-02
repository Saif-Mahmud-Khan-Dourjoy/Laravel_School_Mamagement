@section('heading')
Users
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
  <br>
  <div class="row">
    <div class="col-md-6 col-md-offset-2">
      <div class="panel panel-default">

        <div class="panel-heading"  style="background-color: #f2f2f2;">
          <h4 class="title" align="center">Users Information Form</h4>
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

        <div class="panel-body" >
          <div class="header">
            <h4 class="title">Edit Users info</h4>
          </div>
          <div style="padding-top: 25px;">
            {!! Form::open(['method' => 'PUT', 'url' => ['/users/'.$user->id]]) !!}

            
            {{ csrf_field() }}
            <div class="box-body">
              <div class="col-lg-offset-2 col-lg-9">
                <div class="form-group">
      <!-- <label for="name">User Name</label>
        <input type="text" class="form-control" id="name" name="name"  value="{{ old('name') }}"> -->
        {!! Form::label('user','Name of User') !!}
        {!! Form::text('name', isset($user->name) ? $user->name : null, ['class'=> 'form-control','id'=> 'name']) !!}
      </div>

      <div class="form-group">
      <!-- <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email"  value="{{ old('email') }}"> -->
        {!! Form::label('email','Name of Email') !!}
        {!! Form::text('email', isset($user->email) ? $user->email : null, ['class'=> 'form-control','id'=> 'email']) !!}
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group">

            {!! Form::label('Status','Status') !!}
            {!! Form::select('status', ['1' => 'Enable','0' => 'Disable'],isset($users->status) ? $users->status : null, ['class'=> 'form-control']) !!}

          </div>
        </div>
      </div>

      <div class="form-group">
        <label>Assign Role</label>
        <div class="row">
          @foreach ($roles as $role)
          <div class="col-md-4">
            
            <label ><input type="checkbox" {{in_array($role->id, $user_roles)? "checked":""}} name="role[]" value="{{ $role->id }}"> {{ $role->name }}</label>

          </div>
          @endforeach
        </div>
      </div>



      <div class="form-group">
        <div class="text-center">
          {!! Form::submit('Update', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
          {!! link_to(URL::previous(), 'Cancel', ['class' => 'btn btn-default btn-fill btn-wd']) !!}
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
</div>
</div>
</div>
@endsection
