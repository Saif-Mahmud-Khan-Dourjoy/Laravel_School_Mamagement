@section('heading')
    Collected Fees
@endsection

@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                
            <div class="col-md-12">
                <div class="card card-plain">
                   
                    

                     @if($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {!! $message !!}
                        </div>
                    @else
                        <div>
                            @include('layouts.flash_message')
                        </div>
                    @endif
                    <div class="content table-full-width">
                        <table id="collectedFeesDataTable" class="table table-striped">
                        </table>
                        <br>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var collectedFeesDataTable = null;
        window.addEventListener("load", function () {
            collectedFeesDataTable = $('#collectedFeesDataTable').DataTable({
                dom: '<"row"<"col-md-3"B><"col-md-3"l><"col-md-6"f>>rtip',
                initComplete: function () {

                },
                lengthMenu: [[10, 20, 50, -1], [10, 20, 50, 'All']],
                buttons: [
                    {
                        text: 'Add+',
                        attr: {
                            'id': 'addCollectedFees',
                            'class': "btn btn-info btn-fill btn-wd",
                        },
                        action: function (e, dt, node, config) {
                            //This will send the page to the location specified
                            window.location.href = jsUtlt.siteUrl('/collected_fees/create');
                        }
                    }
                ],
                columns: [
                    {
                        'title': '#SL',
                        'name': 'id',
                        'data': 'id',
                        'width': '5px',
                        'render': function (data, type, row, ind) {
                            var pageInfo = collectedFeesDataTable.page.info();
                            return (ind.row + 1) + pageInfo.start;

                        }
                    },
                    { 'title': 'Action','name': 'action','data': 'id','width': '10px','render': function (data, type, row, ind) {
                        $return = '<div class="dropdown"><a class="btn btn-outline-primary btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a><div class="dropdown-menu dropdown-menu-right">'+
                        '<a class="dropdown-item" data-id = ' + data +' href="'+jsUtlt.siteUrl('/collected_fees/' + data)+'"><i class="fa fa-eye"></i>View</a>'+
                        '<a class="dropdown-item" data-id = ' + data + ' href="'+jsUtlt.siteUrl('/collected_fees/' + data)+'/edit"><i class="fa fa-edit"></i>Edit</a>'+
                        '<a class="dropdown-item"  data-id = ' + data + ' href="'+jsUtlt.siteUrl('/collected_fee/invoice/'+ data)+'" title="Print" target="_blank"><i class="fa fa-print text-info"></i>Print</a>'+
                        '<a class="dropdown-item"><form action="'+jsUtlt.siteUrl('/collected_fees/' + data)+'" method="post">@csrf<input type="hidden" name="_method" value="delete" /><button class="btn-link pl-2"><i style="color:#000;" class="fa fa-trash text-info">  Delete</i></button></form></a>'+
                        '</div></div>';
                        return $return;
                        }
                    },
                    {
                        'title': 'Student',
                        'name': 'student_name',
                        'data': 'student_name',
                        'width': '15px',
                    },
                    {
                        'title': 'Roll no.',
                        'name': 'roll',
                        'data': 'roll',
                        'width': '5px',
                    },
                    {
                        'title': 'Section',
                        'name': 'section_name',
                        'data': 'section_name',
                        'width': '15px',
                    },
                    {
                        'title': 'Class',
                        'name': 'class_name',
                        'data': 'class_name',
                        'width': '10px',
                    },

                    {
                        'title': 'Collection Date',
                        'name': 'collection_date',
                        'data': 'collection_date',
                        'width': '10px',
                    },
                   
                    {
                        'title': 'Collected Amount',
                        'name': 'total_collected',
                        'data': 'total_collected',
                        'width': '10px',
                    },
                    
                    {
                        'title': 'Business Month',
                        'name': 'month_name',
                        'data': 'month_name',
                        'width': '10px',
                    }, 
                     {
                        'title': 'Leaf  Number',
                        'name': 'fees_book_leaf_number',
                        'data': 'fees_book_leaf_number',
                        'width': '10px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    }
                ],
                serverSide: true,
                processing: true,
                // responsive: true,
                ajax: {
                    url: jsUtlt.siteUrl("/collected_fee/get-data-json"),
                    dataSrc: 'data'
                }

            });
        });
    </script>
@endsection
