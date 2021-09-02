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
						<h4 class="title">Class wises Student</h4>
						<p class="category">All Students enrolled to specific sections</p>
						<br>
					</div>
                    <div class="row">
                        <div class="col-md-12" style="text-align: right;">
                            @php
                               // dd($section_id);
                            @endphp
                            <form method="get" action="{{route('section_student.viewAttndance', ['section_id' => $section_id])}}">
                                <button type="submit" class="btn btn-success"><i class="fa fa-address-book-o text-success"></i>View Todays Attendance</button>
                            </form>
                        </div>
                    </div>
					<div class="content table-responsive table-full-width">
						<table id="sectionEnrollDataTable" class="table table-striped">

							<thead>
								<tr>
									<th>SL</th>
                                    <th>Section Name</th>
									<th>Student Name</th>
                                    <th>Class Roll</th>
									<th>Class Name</th>
									<th>Action</th>
								</tr>
							</thead>
                            @php
                                $i = 1;
                            @endphp
							<tbody>
								@foreach ($section_student as $value)
                                @php
                                   // dd($value);
                                @endphp
								<tr>
									<td>@php echo $i; @endphp</td>
                                    <td>{{$value->section->section_name}}</td>
									<td>{{$value->student->name}}</td>
                                    <td>{{$value->roll}}</td>
									<td>{{$value->section->level_enroll->level->class_name}}</td>
									<td><span><form action="{{route('sectionStudents.destroy', [$value->id])}}" method="POST">@csrf<input type="hidden" name="_method" value="DELETE"> <button class="btn btn-sm btn-danger" id="cls_std_delete_btn">delete</button> </form></span></td>
								</tr>
                                @php $i++; @endphp
								@endforeach
							</tbody>
						</table>
						<table class="content table-responsive table-full-width">
						</div>
                        <div class="row">
                            <div class="col-md-12" style="text-align: center;">
                                <a href="{{route('sections.assignStudent', ['id' => $section_id])}}" class="btn btn-info btn-wd"> Go Back</a>  
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <script type="text/javascript">

    </script>
 <!--    <script type="text/javascript">
    var sectionEnrollDataTable = null;
    window.addEventListener("load", function () {
        sectionEnrollDataTable = $('#sectionEnrollDataTable').DataTable({
            dom: '<"row"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>rtip',
            initComplete: function () {

            },
            lengthMenu: [[5, 10, -1], [5, 10, 'All']],
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
                        var pageInfo = sectionEnrollDataTable.page.info();
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
                    'title': 'Student',
                    'name': 'student.name',
                    'data': 'student.name',
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
                        return '<span><form action="'+jsUtlt.siteUrl('/sectionStudents/' + data)+'" method="POST">@csrf<input type="hidden" name="_method" value="DELETE"> <button class="btn btn-sm btn-danger">delete</button> </form></span>';


                    }
                }

            ],
            serverSide: true,
            processing: true,
            ajax: {
                url: jsUtlt.siteUrl("/section_enroll/get-data-json"),
                dataSrc: 'data'
            }

        });
    });
</script> -->
@endsection
