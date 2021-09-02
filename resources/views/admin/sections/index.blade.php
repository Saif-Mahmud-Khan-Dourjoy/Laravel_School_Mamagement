@section('heading')
    Sections
@endsection

@extends('layouts.app')

@section('content')
    <div class="content">
        <?php
        $sectionIndexURL = \Request::fullUrl();
        Session::put('sectionIndexURL', $sectionIndexURL);
        //dd(Session::get('sectionIndexURL'));
        ?>
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div>
                        @include('layouts.flash_message')
                    </div>
                    <div class="header">
                        <h4 class="title">All Sections</h4>
                        <p class="category">All sections belonging to every class</p>
                        <br>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table id="sectionDataTable" class="table table-striped">
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var sectionDataTable = null;
        window.addEventListener("load", function () {
            sectionDataTable = $('#sectionDataTable').DataTable({
                dom: '<"row"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                initComplete: function () {

                },
                lengthMenu: [[10, 20, 50, -1], [10, 20, 50, 'All']],
                buttons: [
                    {
                        text: 'Add+',
                        attr: {
                            'id': 'addSection',
                            'class': "btn btn-info btn-fill btn-wd",
                        },
                        action: function (e, dt, node, config) {
                            //This will send the page to the location specified
                            window.location.href = jsUtlt.siteUrl('/sections/create');
                        }
                    }
                ],
                columns: [
                    {
                        'title': '#SL',
                        'name': 'id',
                        'data': 'id',
                        'width': '20px',
                        'render': function (data, type, row, ind) {
                            var pageInfo = sectionDataTable.page.info();
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
                        '<a class="dropdown-item" data-id = ' + data +' href="'+jsUtlt.siteUrl('/sections/' + data)+'"><i class="fa fa-eye text-info"></i>View</a>'+
                        '<a class="dropdown-item" data-id = ' + data + ' href="'+jsUtlt.siteUrl('/sections/' + data)+'/edit"><i class="fa fa-edit text-warning"></i>Edit</a>'+
                        '<a class="dropdown-item"  data-id = ' + data + ' href="'+jsUtlt.siteUrl('/section/assign_student/'+ data)+'" target="_blank"><i class="fa fa-user-plus text-success"></i>Student++</a>'+
                        '<a class="dropdown-item"  data-id = ' + data + ' href="'+jsUtlt.siteUrl('/section/assign_subject/'+ data)+'" target="_blank"><i class="fa fa-book text-success"></i>Subject++</a>'+
                        '<a class="dropdown-item"  data-id = ' + data + ' href="'+jsUtlt.siteUrl('/section_student/view_attendance/'+ data)+'" target="_blank"><i class="fa fa-check-square-o text-danger"></i>Attendance</a>'+
                        '<a class="dropdown-item"><form action="'+jsUtlt.siteUrl('/sections/' + data)+'" method="post">@csrf<input type="hidden" name="_method" value="delete" /><button class="btn-link pl-2"><i style="color:#000;" class="fa fa-trash text-danger">  Delete</i></button></form></a>'+
                        '</div></div>';
                        return $return;
                        }
                    },
                    {
                        'title': 'Name',
                        'name': 'section_name',
                        'data': 'section_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },

                    {
                        'title': 'Class',
                        'name': 'level_id',
                        'data': 'level_enroll.level.class_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Session',
                        'name': 'session_id',
                        'data': 'level_enroll.session.name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Class Teacher',
                        'name': 'teacher_id',
                        'data': 'teacher.teacher_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    }
                ],
                serverSide: true,
                processing: true,
                ordering: false,
                ajax: {
                    url: jsUtlt.siteUrl("/section/get-data-json"),
                    dataSrc: 'data'
                }
            });
        });
    </script>
@endsection
