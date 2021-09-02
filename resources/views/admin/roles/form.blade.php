<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('name','Role Name') !!}<span class="text-danger">&#9733;</span>
            {!! Form::text('name', isset($role->name) ? $role->name : null, ['class'=> 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group"> 
            {!! Form::label('description','Name of Description') !!}<span class="text-danger">&#9733;</span>
            {!! Form::text('description', isset($role->description) ? $role->description : null, ['class'=> 'form-control']) !!}
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
                            <li><label class="pr-3"><input class="sub-checkbox" type="checkbox" name="permission[]" value="{{$permission->id}}"> {{$permission->description}}</label></li>
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



