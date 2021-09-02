<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name','Name of Branch') !!}<span class="text-danger">&#9733;</span>
            {!! Form::text('name', isset($branch->name) ? $branch->name : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('contact_no','Contact no.') !!}<span class="text-danger">&#9733;</span>
            {!! Form::text('contact_no', isset($branch->contact_no) ? $branch->contact_no : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('address','Address') !!}<span class="text-danger">&#9733;</span>
            {!! Form::textarea('address', isset($branch->address) ? $branch->address : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('areas','Choose area:') !!}<span class="text-danger">&#9733;</span>

            {!! Form::select('area_id', $areas, isset($branch->area_id) ? $branch->area_id :null, ['class'=> 'form-control']) !!}

        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('email','Email') !!}<span class="text-danger">&#9733;</span>
            {!! Form::text('email', isset($branch->email) ? $branch->email : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    
</div>
