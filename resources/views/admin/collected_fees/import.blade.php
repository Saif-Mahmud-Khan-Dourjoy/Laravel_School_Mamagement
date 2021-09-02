@section('heading')
Import Collection
@endsection
@extends('layouts.app')
@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8">				
				<div class="card mb-4">
					<div class="card-header">
						<div class="row">
							<div class="col-xs-12">
								<h4>Import Collection Info</h4>
							</div>
						</div>
					</div>
					<div class="card-body">
						<form id="userFactoryImportForm" action="{{route('collectedFees.importFile')}}" enctype="multipart/form-data" method="post">
							@csrf
							<div class="form-group">
                                <label for="importFile">Select File <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="importFile" id="importFile" placeholder="File">
                                <span class="d-none help-block"></span>
                                @if($errors->any())
                                	<div class="alert alert-danger mt-3">{!! implode('', $errors->all('<div>:message</div>')) !!}</div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary submitBtn">Submit</button>
						</form>
					</div>
				</div>				
			</div>
		</div>
	</div>
@endsection