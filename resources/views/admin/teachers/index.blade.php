@section('heading')
Teachers
@endsection
@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">  
            <?php
                $teacherIdxURL = \Request::fullUrl();
                Session::put('teacherIdxURL', $teacherIdxURL);
                //dd(Session::get('teacherIdxURL'));
            ?>  
            <div class="col-md-12">
                <div class="card card-plain">
                    <div>
                        @include('layouts.flash_message')
                    </div>
                    <div class="header">
                        <h4 class="title">All Teachers</h4>
                        <p class="category">All teachers of all branches</p>
                        <br>
                    </div>
                    <div class="alert alert-success text-center" style="display:none;" id="success_message">
                       

                    </div>
                    <div class="content table-responsive table-full-width">
                        <table id="teacherDataTable" class="table table-striped">
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function(){
      $('#success_message').hide();
    });
</script>
    <script type="text/javascript">
        var teacherDataTable = null;
        window.addEventListener("load",function () {
            teacherDataTable = $('#teacherDataTable').DataTable({
                dom: '<"row"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
                initComplete: function () {

                },
                lengthMenu: [[10, 20, 50, -1], [10, 20, 50, 'All']],
                buttons: [
                    {
                        text: 'Add+',
                        attr: {
                            'id': 'addTeacher',
                            'class': "btn btn-info btn-fill btn-wd",
                        },
                        action: function (e, dt, node, config)
                        {
                            //This will send the page to the location specified
                            window.location.href = jsUtlt.siteUrl('/teachers/create');
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
                            var pageInfo = teacherDataTable.page.info();
                            return (ind.row + 1) + pageInfo.start;

                        }
                    },
                    {
                        'title': 'Name',
                        'name': 'teacher_name',
                        'data': 'teacher_name',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Image',
                        'name': 'teacher_photo',
                        'data': 'teacher_photo',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            return '<img height="42" width="42" src="'+data+'" alt="something">';
                        }
                    },
                    {
                        'title': 'Status',
                        // 'name': 'status',
                        // 'data': 'status',
                        'width': '15px',
                        'className': 'dt-center',
                        'render': function (data, type, row, ind) {
                           $switch =    '<label class="switch">'+
                                          '<input type="checkbox" onchange="updateStatus(this,\'teachers/update-status/'+row.id+'\',\'status\')" data-id="'+row.id+'" '+((row.status == 1)?'checked':'')+'>'+
                                          '<span class="slider round"></span>'+
                                        '</label>';
                            return $switch;
                        }
                    },

                    {
                        'title': 'Action',
                        'name': 'action',
                        'data': 'id',
                        'width': '30px',
                        'render': function (data, type, row, ind) {
                            $return = '<div class="dropdown"><a class="btn btn-outline-primary btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a><div class="dropdown-menu dropdown-menu-right">'+
                            '<a class="dropdown-item" data-id = ' + data +' href="'+jsUtlt.siteUrl('/teachers/' + data)+'"><i class="fa fa-eye"></i>View</a>'+
                            '<a class="dropdown-item" data-id = ' + data +' href="'+jsUtlt.siteUrl('/teachers/' + data)+'/edit"><i class="fa fa-edit"></i>Edit</a>'+
                            '<a class="dropdown-item"><form action="'+jsUtlt.siteUrl('/teachers/' + data)+'" method="post">@csrf<input type="hidden" name="_method" value="delete" /><button class="btn-link pl-2"><i style="color:#000;" class="fa fa-trash text-info">  Delete</i></button></form></a>'+
                            '</div></div>';
                            return $return;
                        }
                    }

                ],
                serverSide: true,
                processing: true,
                ordering: false,
                ajax: {
                    url:"/teacher/get-data-json",
                    url: jsUtlt.siteUrl("/teacher/get-data-json"),
                    dataSrc: 'data'
                }
            });
        });

    function updateStatus(el, url, columnName, isConf){
        isConf = typeof isConf == "undefined" ? true : false;
        let isConfRes = true;
        let status  = (el.checked)?1:0;  
        let post_url =  jsUtlt.siteUrl("/"+url);
        let postData = { _token: $('meta[name="csrf-token"]').attr('content') };
        postData[columnName] = status;
        if(confirm("Are you sure want to cange the status!")){
           axios.post(''+post_url+'', postData).then(res => {
            // $.toaster('Status updated successfully');
             $('#success_message').show();
            $('#success_message').fadeIn("slow").html("Status updated successfully");
                setTimeout(function() {
                    $('#success_message').fadeOut("slow");
                }, 2000 );
          }).catch(err => {
          });
        }
        
    }
    </script>
@endsection
