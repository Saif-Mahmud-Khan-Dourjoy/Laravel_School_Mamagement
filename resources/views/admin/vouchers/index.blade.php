@section('heading')
    Vouchers
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
                        <h4 class="title">Vouchers</h4>
                        <p class="category">Created Vouchers</p>
                        <br>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table id="voucherDataTable" class="table table-striped">
                        </table>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var voucherDataTable = null;
        window.addEventListener("load", function () {
            voucherDataTable = $('#voucherDataTable').DataTable({
                dom: '<"row"<"col-md-3"B><"col-md-3"l><"col-md-6"f>>rtip',
                initComplete: function () {

                },
                lengthMenu: [[10, 20, -1], [10, 20, 'All']],
                buttons: [
                    {
                        text: 'Add+',
                        attr: {
                            'id': 'addVoucher',
                            'class': "btn btn-info btn-fill btn-wd",
                        },
                        action: function (e, dt, node, config) {
                            //This will send the page to the location specified
                            window.location.href = jsUtlt.siteUrl('/vouchers/create');
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
                            var pageInfo = voucherDataTable.page.info();
                            return (ind.row + 1) + pageInfo.start;

                        }
                    },
                    {
                        'title': 'Account Name',
                        'name': 'account_name',
                        'data': 'account_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Action Date',
                        'name': 'action_date',
                        'data': 'action_date',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Category',
                        'name': 'category.category_name',
                        'data': 'category.category_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    
                    {
                        'title': 'Amount',
                        'name': 'amount',
                        'data': 'amount',
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
                        '<a class="dropdown-item" data-id = ' + data +' href="'+jsUtlt.siteUrl('/vouchers/' + data)+'"><i class="fa fa-eye"></i>View</a>'+
                        '<a class="dropdown-item" data-id = ' + data + ' href="'+jsUtlt.siteUrl('/vouchers/' + data)+'/edit"><i class="fa fa-edit"></i>Edit</a>'+
                        '<a class="dropdown-item"><form action="'+jsUtlt.siteUrl('/vouchers/' + data)+'" method="post">@csrf<input type="hidden" name="_method" value="delete" /><button class="btn-link pl-2"><i style="color:#000;" class="fa fa-trash text-info">  Delete</i></button></form></a>'+
                        '</div></div>';
                        return $return;
                        }
                    }

                ],
                serverSide: true,
                processing: true,
                ordering: false,
                ajax: {
                    url: jsUtlt.siteUrl("/voucher/get-data-json"),
                    dataSrc: 'data'
                }
            });
        });
    </script>
@endsection
