@section('heading')
Roles
@endsection

@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="panel panel-default" >

                 <div class="panel-heading"  style="background-color: #f2f2f2;">
                    <h4 class="title" align="center">Roles Information Form</h4>
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

                <div class="panel-body">
                    <div class="header">
                        <h4 class="title">Edit Class</h4>
                    </div>
                    {!! Form::open(['method' => 'PUT', 'url' => ['/roles/'.$role->id]]) !!}

                    <div class="row"> 
                        <div class="col-md-4"> 
                            <div class="form-group">
                                {!! Form::label('name','Role Name') !!} {!! Form::text('name', isset($role->name) ? $role->name : null, ['class'=> 'form-control']) !!}
                            </div>
                        </div> 
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('description','Name of Description') !!} {!! Form::text('description', isset($role->description) ? $role->description : null, ['class'=> 'form-control']) !!} 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <h4 class="pt-3" style="text-align:center">Permissions</h4> <hr>
                            <div class="text-uppercase mb-3" style="font-size: 17px; text-align: center; font-weight: bold;">
                                 <strong><label><input class="group-all-check-all hidden" type="checkbox">Check All</label></strong>
                             </div>

                            <div class="row group-all">
                                <?php
                                $row = [
                                    '<div class="row">','','','','</div>'
                                ];
                                $countRow=0;
                                ?>
                                @foreach ($permissions as $module => $value)
                                    {!!$row[$countRow++]!!}
                                    <div class="col-md-3 group-parent">
                                        <ul style="list-style:none;">
                                            <li class="text-uppercase" style="font-size: 17px;"><strong><label><input class="group-checkbox hidden" type="checkbox">{{$module}}</label></strong></li>
                                            @foreach ($value as $permission)
                                                <?php
                                                    $chceked = "";
                                                    if (in_array($permission->id, $role_permission))
                                                        $chceked = "checked";
                                                ?>

                                                <li><label class="pr-3"><input class="sub-checkbox" type="checkbox" {{$chceked}} name="permission[]" value="{{$permission->id}}"> {{$permission->description}}</label></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    {!!$row[$countRow]!!}                
                                    <?php
                                    if($countRow == 4)
                                        $countRow = 0;
                                    ?>
                                @endforeach
                                <?php
                                if($countRow != 4)
                                    echo $row[4];
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="text-center">
                            {!! Form::submit('Update', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(window).on("load",function(){
         $('input:checkbox.group-checkbox').click(function () {
            var array = [];
            var parent = $(this).closest('.group-parent');
            $(parent).find('.sub-checkbox').prop("checked", $(this).prop("checked"))
        });

        $(document).on('click', '.group-all-check-all', function() {
            if($('.group-all-check-all').is(':checked')){
                $('.group-all input[type="checkbox"]').prop('checked', true);
            }
            else{
                $('.group-all input[type="checkbox"]').prop('checked', false);
            }
        });
    });
</script>
@endsection


