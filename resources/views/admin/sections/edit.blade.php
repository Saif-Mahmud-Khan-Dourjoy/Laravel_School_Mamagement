@section('heading')
Sections
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading"  style="background-color: #f2f2f2;">
                        <h4 class="title" align="center">Sections Information Form</h4>
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
                            <h4 class="title">Edit Section info</h4>
                        </div>
                         {!! Form::open(['method' => 'PUT', 'url' => ['/sections/'.$section->id]]) !!}

                        @include('admin.sections.form')

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
    <script type="text/javascript">
        var levels = <?php echo json_encode($classes)?>;
        var section = <?php echo json_encode($section)?>;
        window.addEventListener("load", function(){
            $('#teacher').select2();

            var level_html = '';
            $.each(levels, function(index, value){
                if(value.session_id == section.level_enroll.session_id){
                    if(value.id == section.level_enroll.id){
                        level_html += '<option value="'+value.id+'" selected>'+value.level.class_name+'</option>';
                    }else{
                        level_html += '<option value="'+value.id+'">'+value.level.class_name+'</option>';
                    }
                }
            });
            $('#level_enroll').html(level_html);

            $('#session').change(function(){
                let session_id = $(this).val();
                level_html = '<option value="" disabled selected>Select Class</option>';
                $.each(levels, function(index, value){
                    if(value.session_id == session_id){
                        level_html += '<option value="'+value.id+'">'+value.level.class_name+'</option>';
                    }
               });
                $('#level_enroll').html(level_html);
            });
        });
    </script>
@endsection
