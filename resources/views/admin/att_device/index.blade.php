@section('heading')
    Attendance Devices
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
                        <h4 class="title">Attendance Device</h4>
                        <p class="category">Attendance Device Details</p>
                        <br>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table id="att_deviceDataTable" class="table table-striped">
                        </table>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var att_deviceDataTable = null;
        window.addEventListener("load", function () {
            att_deviceDataTable = $('#att_deviceDataTable').DataTable({
                dom: '<"row"<"col-md-3"B><"col-md-3"l><"col-md-6"f>>rtip',
                initComplete: function () {

                },
                lengthMenu: [[10, 20, -1], [10, 20, 'All']],
                buttons: [
                    {
                        text: 'Add+',
                        attr: {
                            'id': 'addatt_device',
                            'class': "btn btn-info btn-fill btn-wd",
                        },
                        action: function (e, dt, node, config) {
                            //This will send the page to the location specified
                            window.location.href = jsUtlt.siteUrl('/attendancedevices/create');
                        }
                    }
                ],
                columns: [
                    {
                        'title': '#SL',
                        'name': 'id',
                        'data': 'id',
                        'width': '5%',
                        'render': function (data, type, row, ind) {
                            var pageInfo = att_deviceDataTable.page.info();
                            return (ind.row + 1) + pageInfo.start;

                        }
                    },
                    {
                        'title': 'Device Name',
                        'name': 'DeviceName',
                        'data': 'DeviceName',
                        'width': '10%',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'MachineNo',
                        'name': 'MachineNo',
                        'data': 'MachineNo',
                        'width': '10%',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Comm Type',
                        'name': 'CommType',
                        'data': 'CommType',
                        'width': '10%',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'IP Address',
                        'name': 'IPAddress',
                        'data': 'IPAddress',
                        'width': '10%',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Port',
                        'name': 'Port',
                        'data': 'Port',
                        'width': '10%',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Device Type',
                        'name': 'DeviceType',
                        'data': 'DeviceType',
                        'width': '10%',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Action',
                        'name': 'action',
                        'data': 'id',
                        'width': '10%',
                        'render': function (data, type, row, ind) {
                        $return = '<div class="dropdown"><a class="btn btn-outline-primary btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a><div class="dropdown-menu dropdown-menu-right">'+                        
                        '<a class="dropdown-item" data-id = ' + data + ' href="'+jsUtlt.siteUrl('/attendancedevices/' + data)+'/edit"><i class="fa fa-edit"></i>Edit</a>'+
                        '<a class="dropdown-item"><form action="'+jsUtlt.siteUrl('/attendancedevices/' + data)+'" method="post">@csrf<input type="hidden" name="_method" value="delete" /><button class="btn-link pl-2"><i style="color:#000;" class="fa fa-trash text-info">  Delete</i></button></form></a>'+
                        '</div></div>';
                        return $return;
                        }
                    }
                ],
                serverSide: true,
                processing: true,
                ordering: false,
                ajax: {
                    url: jsUtlt.siteUrl("/attendancedevices/get-data-json"),
                    dataSrc: 'data'
                }
            });
        });
    </script>
@endsection
