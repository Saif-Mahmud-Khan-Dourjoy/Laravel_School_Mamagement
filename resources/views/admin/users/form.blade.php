 
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



    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" name="password"  value="{{ old('password') }}">
    </div>

    <div class="form-group">
      <label for="password_confirmation">Confirm Passowrd</label>
      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" >
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

          <label ><input type="checkbox" name="role[]" value="{{ $role->id }}"> {{ $role->name }}</label>

        </div>
        @endforeach
      </div>
    </div>

