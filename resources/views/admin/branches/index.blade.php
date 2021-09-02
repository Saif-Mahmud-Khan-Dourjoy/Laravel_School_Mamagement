@section('heading')
    Branches
@endsection
@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
             <div class="row">
                <div class="col-md-12">
                    <div class="card card-plain">

                        <div>
                            @include('layouts.flash_message')
                        </div>

                        <div class="panel-body">
                            <div class="header">
                                <h4 class="title">All Branches</h4>
                                <p class="category">All branches appear here</p>
                                <br>
                            </div>
                       
                            <div class="content table-responsive table-full-width">
                                <table id="branchDataTable" class="table table-striped">
                                </table>

                            </div>
            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var branchDataTable = null;
        window.addEventListener("load", function () {
            branchDataTable = $('#branchDataTable').DataTable({
                dom: '<"row"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                initComplete: function () {

                },
                lengthMenu: [[5, 10, -1], [5, 10, 'All']],
                buttons: [
                    {
                        text: 'Add+',
                        attr: {
                            'id': 'addBranch',
                            'class': "btn btn-info btn-fill btn-wd",
                        },
                        action: function (e, dt, node, config) {
                            //This will send the page to the location specified
                            window.location.href = jsUtlt.siteUrl('/branches/create');
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
                            var pageInfo = branchDataTable.page.info();
                            return (ind.row + 1) + pageInfo.start;
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
                        'title': 'Address',
                        'name': 'address',
                        'data': 'address',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Email',
                        'name': 'email',
                        'data': 'email',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    
                    {
                        'title': 'Contact No',
                        'name': 'contact_no',
                        'data': 'contact_no',
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
                        'render': function (data, type, row, ind) {
                            $return = '<div class="dropdown"><a class="btn btn-outline-primary btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a><div class="dropdown-menu dropdown-menu-right">'+
                            '<a class="dropdown-item" data-id = ' + data +' href="'+jsUtlt.siteUrl('/branches/' + data)+'"><i class="fa fa-eye"></i>View</a>'+
                            '<a class="dropdown-item" data-id = ' + data +' href="'+jsUtlt.siteUrl('/branches/' + data)+'/edit"><i class="fa fa-edit"></i>Edit</a>'+
                            '<a class="dropdown-item"><form action="'+jsUtlt.siteUrl('/branches/' + data)+'" method="post">@csrf<input type="hidden" name="_method" value="delete" /><button class="btn-link pl-2"><i style="color:#000;" class="fa fa-trash text-info">  Delete</i></button></form></a>'+
                            '</div></div>';
                            return $return;
                        }
                    }
                ],
                serverSide: true,
                processing: true,
                ordering: false,
                ajax: {
                    url: jsUtlt.siteUrl("/branch/get-data-json"),
                    dataSrc: 'data'
                }
            });
        });
    </script>
@endsection
<!-- jsUtlt.siteUrl('ajax/view_members_datatable') -->
