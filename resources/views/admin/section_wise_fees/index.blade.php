@section('heading')
    Section Wise Fees
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
                        <h4 class="title">Section Wise Fees</h4>
                        <p class="category">Section-wise fees details</p>
                        <br>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table id="sectionWiseFeesDataTable" class="table table-striped">
                        </table>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var sectionWiseFeesDataTable = null;
        window.addEventListener("load", function () {
            sectionWiseFeesDataTable = $('#sectionWiseFeesDataTable').DataTable({
                dom: '<"row"<"col-md-3"B><"col-md-3"l><"col-md-6"f>>rtip',
                initComplete: function () {

                },
                lengthMenu: [[10, 20, 50, -1], [10, 20, 50, 'All']],
                buttons: [
                    {
                        text: 'Add+',
                        attr: {
                            'id': 'addSectionFee',
                            'class': "btn btn-info btn-fill btn-wd",
                        },
                        action: function (e, dt, node, config) {
                            //This will send the page to the location specified
                            window.location.href = jsUtlt.siteUrl('/section_wise_fees/create');
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
                            var pageInfo = sectionWiseFeesDataTable.page.info();
                            return (ind.row + 1) + pageInfo.start;

                        }
                    },
                    {
                        'title': 'Action',
                        'name': 'action',
                        'data': 'id',
                        'width': '20%',
                         'render': function (data, type, row, ind) {
                        $return = '<div class="dropdown"><a class="btn btn-outline-primary btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a><div class="dropdown-menu dropdown-menu-right">'+
                        '<a class="dropdown-item" data-id = ' + data +' href="'+jsUtlt.siteUrl('/section_wise_fees/' + data)+'"><i class="fa fa-eye"></i>View</a>'+
                        '<a class="dropdown-item" data-id = ' + data + ' href="'+jsUtlt.siteUrl('/section_wise_fees/' + data)+'/edit"><i class="fa fa-edit"></i>Edit</a>'+
                        '<a class="dropdown-item"><form action="'+jsUtlt.siteUrl('/section_wise_fees/' + data)+'" method="post">@csrf<input type="hidden" name="_method" value="delete" /><button class="btn-link pl-2"><i style="color:#000;" class="fa fa-trash text-info">  Delete</i></button></form></a>'+
                        '</div></div>';
                        return $return;
                        }
                    },
                    {
                        'title': 'Session',
                        'name': 'session.name',
                        'data': 'session.name',
                        'width': '25%',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Class',
                        'name': 'section.level_enroll.level.class_name',
                        'data': 'section.level_enroll.level.class_name',
                        'width': '10%',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Section',
                        'name': 'section.section_name',
                        'data': 'section.section_name',
                        'width': '20%',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Month',
                        'name': 'business_month.month_name',
                        'data': 'business_month.month_name',
                        'width': '20%',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Fees Type',
                        'name': 'fees_type.fees_type_name',
                        'data': 'fees_type.fees_type_name',
                        'width': '40%',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Amount',
                        'name': 'amount',
                        'data': 'amount',
                        'width': '30%',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    }
                ],
                serverSide: true,
                processing: true,
                ordering: false,
                ajax: {
                    url: jsUtlt.siteUrl("/section_wise_fee/get-data-json"),
                    dataSrc: 'data'
                }
            });
        });
    </script>
@endsection
