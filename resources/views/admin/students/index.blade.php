@section('heading')
    Students
@endsection

@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div>
                        @include('layouts.flash_message')
                    </div>
                    <div class="panel-body">
                        <div>
                        <div class="header" style="width: 50%; float: left">
                            <h4 class="title">All Students</h4>
                            <p class="category">All students of all classes</p>
                            <br>
                        </div>
                        <div style="width: 50%;float: right; text-align: right" >
                            
                            <a href="{{route('students.create_old')}}" class="btn btn-success btn-fill btn-wd">Add Old Student</a>
                        </div>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table id="studentDataTable" class="table table-striped">
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var studentDataTable = null;
        window.addEventListener("load", function () {
            studentDataTable = $('#studentDataTable').DataTable({
                dom: '<"row"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                initComplete: function () {

                },
                lengthMenu: [[10, 20, 50, -1], [10, 20, 50, 'All']],
                buttons: [
                    {
                        text: 'Add+',
                        attr: {
                            'id': 'addBranch',
                            'class': "btn btn-info btn-fill btn-wd",
                        },
                        action: function (e, dt, node, config) {
                            //This will send the page to the location specified
                            window.location.href = jsUtlt.siteUrl('/students/create');
                        }
                    }
                ],
                columnDefs : [
                    { responsivePriority: 1, targets: 12 },                                                                                          
                ],
                columns: [
                    {
                        'title': '#SL',
                        'name': 'id',
                        'data': 'id',
                        'width': '20px',
                        'render': function (data, type, row, ind) {
                            var pageInfo = studentDataTable.page.info();
                            return (ind.row + 1) + pageInfo.start;
                        }
                    },
                    {
                        'title': 'Action',
                        'name': 'action',
                        'data': 'id',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                        $return = '<div class="dropdown"><a class="btn btn-outline-primary btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a><div class="dropdown-menu dropdown-menu-right">'+
                        '<a class="dropdown-item" data-id = ' + data +' href="'+jsUtlt.siteUrl('/students/' + data)+'"><i class="fa fa-eye"></i>View</a>'+
                        '<a class="dropdown-item" data-id = ' + data + ' href="'+jsUtlt.siteUrl('/students/' + data)+'/edit"><i class="fa fa-edit"></i>Edit</a>'+
                        '<a class="dropdown-item"><form action="'+jsUtlt.siteUrl('/students/' + data)+'" method="post">@csrf<input type="hidden" name="_method" value="delete" /><button class="btn-link pl-2"><i style="color:#000;" class="fa fa-trash text-info">  Delete</i></button></form></a>'+
                        '</div></div>';
                        return $return;
                        }
                    },
                    {
                        'title': 'Name',
                        'name': 'name',
                        'data': 'name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Branch',
                        'name': 'branchName',
                        'data': 'branchName',
                        'width': '30px',
                    }, 
                    {
                        'title': 'Global ID',
                        'name': 'roll_no',
                        'data': 'roll_no',
                        'width': '30px',
                    }, 
                    {
                        'title': 'Session',
                        'name': 'sessionName',
                        'data': 'sessionName',
                        'width': '30px',
                    }, 
                    {
                        'title': 'Class',
                        'name': 'class_name',
                        'data': 'class_name',
                        'width': '30px',
                    },  
                    {
                        'title': 'Section',
                        'name': 'section_name',
                        'data': 'section_name',
                        'width': '30px',
                    },
                    {
                        'title': 'Father',
                        'name': 'fathers_name',
                        'data': 'fathers_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Gender',
                        'name': 'gender',
                        'data': 'gender',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Contact No.',
                        'name': 'contact_no',
                        'data': 'contact_no',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Image',
                        'name': 'student_photo',
                        'data': 'student_photo',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return '<img height="42" width="42" src="'+data+'" alt="something">';
                        }
                    },
                    /*{
                        'title': 'Class',
                        'name': 'level_id',
                        'data': 'level.class_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },*/
                    {
                        'title': 'Status',
                        'name': 'status',
                        'data': 'status',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return (data) ? 'Enable' : '<span class="text-danger">Disable</span>';
                        }
                    }
                ],
                serverSide: true,
                processing: true,
                ordering: false,
                responsive:true,
                ajax: {
                    url: jsUtlt.siteUrl("/student/get-data-json"),
                    dataSrc: 'data'
                }
            });
        });
    </script>
    
@endsection
