
<div class="row">
<div class="col-md-10">
        <div class="form-group"> 
            {!! Form::label('description','Name of modual') !!}
            {!! Form::text('modual', isset($permission->modual) ? $permission->modual : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name','Permission Name') !!}
            {!! Form::text('name', isset($permission->name) ? $permission->name : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group"> 
            {!! Form::label('description','Name of Description') !!}
            {!! Form::text('description', isset($permission->description) ? $permission->description : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>


