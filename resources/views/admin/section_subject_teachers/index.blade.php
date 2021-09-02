@section('heading')
    Section Enroll
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-10">
                <div class="card card-plain">

                    <div>
                        @include('layouts.flash_message')
                    </div>
                    <div class="panel-body">
                        <div class="header">
                            <h4 class="title">All Subjects</h4>
                            <p class="category">All Subjects enrolled to specific sections</p>
                            <br>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table id="sectionSubjectEnrollDataTable" class="table table-striped">
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var sectionSubjectEnrollDataTable = null;
        window.addEventListener("load", function () {
            sectionSubjectEnrollDataTable = $('#sectionSubjectEnrollDataTable').DataTable({
                dom: '<"row"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                initComplete: function () {

                },
                lengthMenu: [[10, 10, -1], [5, 10, 'All']],
                buttons: [
                    {
                        text: 'Add+',
                        attr: {
                            'id': 'addClass',
                            'class': "btn btn-info btn-fill btn-wd",
                        },
                        action: function (e, dt, node, config) {
                            //This will send the page to the location specified
                            window.location.href = jsUtlt.siteUrl('/sections');
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
                            var pageInfo = sectionSubjectEnrollDataTable.page.info();
                            return (ind.row + 1) + pageInfo.start;

                        }
                    },
                    {
                        'title': 'Section',
                        'name': 'section.section_name',
                        'data': 'section.section_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Class',
                        'name': 'section.level_enroll.level.class_name',
                        'data': 'section.level_enroll.level.class_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Subject',
                        'name': 'subject.subject_name',
                        'data': 'subject.subject_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    
                    
                    {
                        'title': 'Action',
                        'name': 'action',
                        'data': 'id',
                        'width': '30px',
                        // 'render': function (data, type, row, ind) {
                        //     return '<span><form action="'+jsUtlt.siteUrl('/sectionSubjectTeachers/' + data)+'" method="POST">@csrf<input type="hidden" name="_method" value="DELETE"> <button class="btn btn-sm btn-danger">delete</button> </form></span>';
                        // }
                        'render': function (data, type, row, ind) {
                            $return = '<div class="dropdown"><a class="btn btn-outline-primary btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a><div class="dropdown-menu dropdown-menu-right">'+
                            '<a class="dropdown-item" data-id = ' + data +' href="'+jsUtlt.siteUrl('/sectionSubjectTeachers/' + data)+'/edit"><i class="fa fa-edit"></i>Edit Term Marks</a>'+
                            '<a class="dropdown-item"><form action="'+jsUtlt.siteUrl('/sectionSubjectTeachers/' + data)+'" method="post">@csrf<input type="hidden" name="_method" value="delete" /><button class="btn-link pl-2"><i style="color:#000;" class="fa fa-trash text-info">  Delete</i></button></form></a>'+
                            '</div></div>';
                            return $return;
                        }
                    }

                ],
                serverSide: true,
                processing: true,
                ajax: {
                    url: jsUtlt.siteUrl("/section_subject_enroll/get-data-json"),
                    dataSrc: 'data'
                }

            });
        });
    </script>
@endsection
