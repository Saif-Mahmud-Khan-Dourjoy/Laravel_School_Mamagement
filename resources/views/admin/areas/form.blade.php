<div class="form-group">
	{!! Form::label('name','Area Name') !!}
	{!! Form::text('name', isset($area->name) ? $area->name : null, ['class'=> 'form-control']) !!}
</div>