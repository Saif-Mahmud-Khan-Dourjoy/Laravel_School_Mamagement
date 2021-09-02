
<div class="modal fade" id="PrevSclModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-center" id="exampleModalLongTitle">Previous School Info</h3>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="">
        
              {!! Form::open(['method' => 'POST', 'url' => ['/teachers/more_prev_scl_info/'.$teacher->id]]) !!}
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('prev_scl_institute_name','Institute Name') !!} <span class="text-danger">&#9733;</span>
					{!! Form::text('prev_scl_institute_name', null,['class'=> 'form-control'])!!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('prev_scl_designation','Designation')!!} <span class="text-danger">&#9733;</span>
					{!! Form::text('prev_scl_designation',null,['class'=>'form-control'])!!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('prev_scl_appoiment_date','Appoiment Date')!!}
					{!! Form::date('prev_scl_appoiment_date',null,['class'=>'form-control'])!!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('prev_scl_joining_date','Joining Date')!!} <span class="text-danger">&#9733;</span>
					{!! Form::date('prev_scl_joining_date',null,['class'=>'form-control'])!!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('mpo_date','Mpo Date')!!}
					{!! Form::date('mpo_date',null,['class'=>'form-control'])!!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('exemption_date','Exemption date')!!} <span class="text-danger">&#9733;</span> 
					{!! Form::date('exemption_date',null,['class'=>'form-control'])!!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('previous_school_comment','Comment')!!}
					{!! Form::textarea('previous_school_comment',null,['class'=>'form-control'])!!}

				</div>
			</div>
			<div class="form-group mt-3 col-md-12">
				<div class="text-center">
					{!! Form::submit('Add', array('class'=> 'btn btn-info btn-fill btn-wd')) !!} 
				</div>
				{!! Form::close() !!}

           </div>
       </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

