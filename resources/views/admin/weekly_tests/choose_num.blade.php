@section('heading')
Weekly Test
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <?php
    $url = Session::get('viewSubjectsURL');
    $chooseNumURL = \Request::fullUrl();
    Session::put('chooseNumURL', $chooseNumURL);
    ?>
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <div class="card card-plain">
                <div>
                    @include('layouts.flash_message')
                </div>

                <div class="panel panel-default">
                    <div class="header">
                        <h4 class="title text-center">Weekly Test - {{$subject->subject_name}}</h4>
                        <br>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['method' => 'GET', 'url' => '/weekly_test/mark']) !!}
                        {!! Form::hidden('term_id', $term_id, ['class'=> 'form-control']) !!}
                        <div class="row" style="align-content: center">
                            <div class="col-md-4">
                                <div class="form-group">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" style="text-align: center">
                                    {!! Form::label('weekly_test_number','Add Weekly Test Number') !!}
                                    {!! Form::number('weekly_test_number', null, ['class'=> 'form-control', 'min' => 1]) !!}
                                    {!! Form::hidden('sec_sub_teach_id', $sec_sub_teach->id, ['class'=> 'form-control']) !!}
                                    {!! Form::hidden('level_id', $sec_sub_teach->subject_id, ['class'=> 'form-control']) !!}
                                    {!! Form::hidden('section_id', $sec_sub_teach->section_id, ['class'=> 'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="">
                                {!! Form::submit('Proceed', array('class'=> 'btn btn-info btn-fill pull-right')) !!}
                                {{ Form::close() }}
                                {!! Form::open(['method' => 'POST', 'url' => $url]) !!}
                                
                                {!! Form::hidden('level_id', Session::get('level_id'), ['class'=> 'form-control']) !!}
                                {!! Form::hidden('section_id', Session::get('section_id'), ['class'=> 'form-control']) !!}
                                 {!! Form::hidden('session_id', Session::get('session_id'), ['class'=> 'form-control']) !!}
                                {!! Form::hidden('term_id', Session::get('term_id'), ['class'=> 'form-control']) !!}
                                {!! Form::submit('Back', array('class'=> 'btn pull-back')) !!}

                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default p-3">
                    <div class="content table-responsive table-full-width">
                        <table id="weeklyTestDataTable" class="table table-striped">
                        </table>
                    </div>
                </div>

               
            </div>
        </div>
    </div>
       <script type="text/javascript">
        var weeklyTestDataTable = null;
        student_data = <?php echo json_encode($student_subject_results); ?>;
        window.addEventListener("load", function () {
            weeklyTestDataTable = $('#weeklyTestDataTable').DataTable({
                dom: '<"row"<"col-md-6"l><"col-md-6 pull-right"f>>rtip',
                initComplete: function () {

                },
                lengthMenu: [[5, 10, -1], [5, 10, 'All']],
                columns: [
                    {
                        'title' : '#SL', data : "id", width: 20,render : function(data, type, row, col){
                            return (col.row + 1);
                        }
                    },
                    {
                        'title': 'Subject Name',
                        'name': 'section_subject_teacher.subject.subject_name',
                        'data': 'section_subject_teacher.subject.subject_name',
                        'width': '30px'
                    },
                    {
                        'title': 'Weekly Test Number',
                        'name': 'weekly_test_number',
                        'data': 'weekly_test_number',
                        'width': '30px'
                    },
                    
                    {
                        'title': 'Action',
                        'name': 'action',
                        'data': 'id',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            $return = '<div class="dropdown"><a class="btn btn-outline-primary btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a><div class="dropdown-menu dropdown-menu-right">'+
                            '<a class="dropdown-item" data-id = ' + data +' href="'+jsUtlt.siteUrl('/weekly_test/view_by_number/' + data)+'"><i class="fa fa-eye"></i>View</a>'+
                            '<a class="dropdown-item" data-id = ' + data +' href="'+jsUtlt.siteUrl('/weeklytests/'+data+'/edit')+'"><i class="fa fa-edit"></i>Edit</a>'+
                            '<a class="dropdown-item"><form action="'+jsUtlt.siteUrl('/weeklytests/' + data)+'" method="post">@csrf<input type="hidden" name="_method" value="delete" /><button class="btn-link pl-2"><i style="color:#000;" class="fa fa-trash text-info">  Delete</i></button></form></a>'+
                            '</div></div>';
                            return $return;
                        }
                    }
                ],
                serverSide: false,
                processing: true,
                ordering: true,
                data:student_data
            });
        });
    </script>
    @endsection
