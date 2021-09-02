<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('teachers','Choose User to Assign:') !!}<span class="text-danger">&#9733;</span>
            {!! Form::select('teacher_id', $teachers, isset($fees_book->teacher_id) ? $fees_book->teacher_id :null, ['class'=> 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('branches','Choose Branch:') !!}<span class="text-danger">&#9733;</span>
            {!! Form::select('branch_id', $branches, isset($fees_book->branch_id) ? $fees_book->branch_id :null, ['class'=> 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('total_leaf','Total Leaf Number:') !!}<span class="text-danger">&#9733;</span>
            {!! Form::number('total_leaf', isset($fees_book->total_leaf) ? $fees_book->total_leaf :null, ['class'=> 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('prefixes','Prefix:') !!}<span class="text-danger">&#9733;</span>
            {!! Form::select('prefix_id', $prefixes, isset($fees_book->prefix_id) ? $fees_book->prefix_id :null, ['class'=> 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('leaf_start_number','Leaf Start Number:') !!}<span class="text-danger">&#9733;</span>
            {!! Form::number('leaf_start_number', isset($fees_book->leaf_start_number) ? $fees_book->leaf_start_number :null, ['min'=>'0', 'class'=> 'form-control']) !!}
        </div>
    </div>
</div>
{!! Form::hidden('creator_user_id', request()->user()->id, ['class'=> 'form-control']) !!}