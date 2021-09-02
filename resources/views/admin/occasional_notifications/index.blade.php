@section('heading')
   Occasional Notification
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
                        <h5 class="title"><strong>Occasional Notification List</strong></h5>
                        <br>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table id="ocNotificationDataTable" class="table table-striped">
                        </table>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var ocNotificationDataTable = null;
        window.addEventListener("load", function () {
            ocNotificationDataTable = $('#ocNotificationDataTable').DataTable({
                dom: '<"row"<"col-md-3"B><"col-md-3"l><"col-md-6"f>>rtip',
                initComplete: function () {

                },
                lengthMenu: [[10, 20, -1], [10, 20, 'All']],
                buttons: [
                    {
                        text: 'Add+',
                        attr: {
                            'id': 'addON',
                            'class': "btn btn-info btn-fill btn-wd",
                        },
                        action: function (e, dt, node, config) {

                            window.location.href = jsUtlt.siteUrl('/occasional-notifications/create');
                        }
                    }
                ],
                columns: [
                    {
                        'title': '#SL','name': 'id','data': 'id','width': '10%',
                        'render': function (data, type, row, ind) {
                            var pageInfo = ocNotificationDataTable.page.info();
                            return (ind.row + 1) + pageInfo.start;

                        }
                    },
                    {
                        'title': 'Occasion','name': 'name','data': 'name','width': '10%',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Date','name': 'date','data': 'date','width': '15%',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Send To','name': 'send_to','data': 'send_to','width': '20%','render': function (data, type, row, ind) {
                            if(data == 1){
                                return "Students";
                            }else if(data == 2){
                                return "Teachers";
                            }else{
                                return "Both";
                            }
                        }
                    },
	                  {
	                    'title': 'Text','name': 'text','data': 'text','width': '35%',
	                    'render': function (data, type, row, ind) {
	                        return data;
	                    }
                    },
                    {
                        'title': 'Status','name': 'status','data': 'status','width': '10%',
                        'render': function (data, type, row, ind) {
                            if(data == 1){
                                return "On";
                            }else{
                                return "Off";
                            }
                        }
                    },
                    {
                        'title': 'Action','name': 'action', 'data': 'id','width': '10%',
                        'render': function (data, type, row, ind) {
                        $return = '<div class="dropdown"><a class="btn btn-outline-primary btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a><div class="dropdown-menu dropdown-menu-right">'+
                        '<a class="dropdown-item" data-id = ' + data + ' href="'+jsUtlt.siteUrl('/occasional-notifications/' + data)+'/edit"><i class="fa fa-edit"></i>Edit</a>'+
                        '<a class="dropdown-item"><form action="'+jsUtlt.siteUrl('/occasional-notifications/' + data)+'" method="post">@csrf<input type="hidden" name="_method" value="delete" /><button class="btn-link pl-2"><i style="color:#000;" class="fa fa-trash text-info">  Delete</i></button></form></a>'+
                        '</div></div>';
                        return $return;
                        }
                    }
                ],
                serverSide: true,
                processing: true,
                ordering: false,
                ajax: {
                    url: jsUtlt.siteUrl("/occasional-notifications"),
                    dataSrc: 'data'
                }
            });
        });
    </script>
@endsection

