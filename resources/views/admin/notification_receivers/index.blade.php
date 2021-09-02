@section('heading')
   Notification Receivers
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
                        <h5 class="title"><strong>Notification Receivers List</strong></h5>
                        <br>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table id="notificationReceiverDataTable" class="table table-striped">
                        </table>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var notificationReceiverDataTable = null;
        window.addEventListener("load", function () {
            notificationReceiverDataTable = $('#notificationReceiverDataTable').DataTable({
                dom: '<"row"<"col-md-3"B><"col-md-3"l><"col-md-6"f>>rtip',
                initComplete: function () {

                },
                lengthMenu: [[10, 20, -1], [10, 20, 'All']],
                buttons: [
                    {
                        text: 'Add+',
                        attr: {
                            'id': 'addNR',
                            'class': "btn btn-info btn-fill btn-wd",
                        },
                        action: function (e, dt, node, config) {

                            window.location.href = jsUtlt.siteUrl('/notification-receivers/create');
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
                            var pageInfo = notificationReceiverDataTable.page.info();
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
                        'title': 'Email',
                        'name': 'email',
                        'data': 'email',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
	                  {
	                    'title': 'Phone',
	                    'name': 'phone',
	                    'data': 'phone',
	                    'width': '30px',
	                    'render': function (data, type, row, ind) {
	                        return data;
	                    }
                    },
                     {
                        'title': 'Type',
                        'name': 'notification_type.type_name',
                        'data': 'notification_type.type_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Status',
                        'name': 'status',
                        'data': 'status',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            if(data == 1){
                                return "On";
                            }else{
                                return "Off";
                            }
                        }
                    },
                    {
                        'title': 'Action',
                        'name': 'action',
                        'data': 'id',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                        $return = '<div class="dropdown"><a class="btn btn-outline-primary btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a><div class="dropdown-menu dropdown-menu-right">'+
                        '<a class="dropdown-item" data-id = ' + data + ' href="'+jsUtlt.siteUrl('/notification-receivers/' + data)+'/edit"><i class="fa fa-edit"></i>Edit</a>'+
                        '<a class="dropdown-item"><form action="'+jsUtlt.siteUrl('/notification-receivers/' + data)+'" method="post">@csrf<input type="hidden" name="_method" value="delete" /><button class="btn-link pl-2"><i style="color:#000;" class="fa fa-trash text-info">  Delete</i></button></form></a>'+
                        '</div></div>';
                        return $return;
                        }
                    }
                ],
                serverSide: true,
                processing: true,
                ordering: false,
                ajax: {
                    url: jsUtlt.siteUrl("/notification-receivers"),
                    dataSrc: 'data'
                }
            });
        });
    </script>
@endsection

