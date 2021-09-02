@section('heading')
    Fees Books
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
                    <div class="header">
                        <h4 class="title">Fees Books</h4>
                        <p class="category">Fees Books Details</p>
                        <br>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table id="feesBooksDataTable" class="table table-striped">
                        </table>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var feesBooksDataTable = null;
        window.addEventListener("load", function () {
            feesBooksDataTable = $('#feesBooksDataTable').DataTable({
                dom: '<"row"<"col-md-3"B><"col-md-3"l><"col-md-6"f>>rtip',
                initComplete: function () {

                },
                lengthMenu: [[10, 20, -1], [10, 20, 'All']],
                buttons: [
                    {
                        text: 'Add+',
                        attr: {
                            'id': 'addFeesBook',
                            'class': "btn btn-info btn-fill btn-wd",
                        },
                        action: function (e, dt, node, config) {
                            //This will send the page to the location specified
                            window.location.href = jsUtlt.siteUrl('/fees_books/create');
                        }
                    }
                ],
                columns: [
                    {
                        'title': '#SL',
                        'name': 'id',
                        'data': 'id',
                        'width': '10%',
                        'render': function (data, type, row, ind) {
                            var pageInfo = feesBooksDataTable.page.info();
                            return (ind.row + 1) + pageInfo.start;

                        }
                    },
                    {
                        'title': 'Action',
                        'name': 'action',
                        'data': 'id',
                        'width': '10%',
                        'render': function (data, type, row, ind) {
                        $return = '<div class="dropdown"><a class="btn btn-outline-primary btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a><div class="dropdown-menu dropdown-menu-right">'+
                        '<a class="dropdown-item" data-id = ' + data +' href="'+jsUtlt.siteUrl('/fees_books/' + data)+'"><i class="fa fa-eye"></i>View</a>'+
                        '<a class="dropdown-item" data-id = ' + data + ' href="'+jsUtlt.siteUrl('/fees_books/' + data)+'/edit"><i class="fa fa-edit"></i>Edit</a>'+
                        '<a class="dropdown-item"><form action="'+jsUtlt.siteUrl('/fees_books/' + data)+'" method="post">@csrf<input type="hidden" name="_method" value="delete" /><button class="btn-link pl-2"><i style="color:#000;" class="fa fa-trash text-info">  Delete</i></button></form></a>'+
                        '</div></div>';
                        return $return;
                        }
                    },
                    {
                        'title': 'Branch',
                        'name': 'branch.name',
                        'data': 'branch.name',
                        'width': '10%',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Assigned User',
                        'name': 'teacher.teacher_name',
                        'data': 'teacher.teacher_name',
                        'width': '30%',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Total leaf',
                        'name': 'total_leaf',
                        'data': 'total_leaf',
                        'width': '15%',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Prefix',
                        'name': 'prefix.prefix',
                        'data': 'prefix.prefix',
                        'width': '10%',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Leaf Start no',
                        'name': 'leaf_start_number',
                        'data': 'leaf_start_number',
                        'width': '40%',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Leaf End no',
                        'name': 'leaf_end_number',
                        'data': 'leaf_end_number',
                        'width': '40%',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    }
                ],
                serverSide: true,
                processing: true,
                ordering: false,
                ajax: {
                    url: jsUtlt.siteUrl("/fees_book/get-data-json"),
                    dataSrc: 'data'
                }
            });
        });
    </script>
@endsection
