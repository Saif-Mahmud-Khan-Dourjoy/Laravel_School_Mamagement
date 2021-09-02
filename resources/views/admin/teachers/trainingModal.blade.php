<div class="modal fade" id="TrainingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-center" id="exampleModalLongTitle">Training Info</h3>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="">
        
              {!! Form::open(['method' => 'POST', 'url' => ['/teachers/more_training_info/'.$teacher->id]]) !!} 
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('training_institute_name','Institute Name') !!} <span class="text-danger">&#9733;</span>
					{!! Form::text('training_institute_name',null,['class'=> 'form-control'])!!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('training_subject','Subject')!!} <span class="text-danger">&#9733;</span>
					{!! Form::text('training_subject',null,['class'=>'form-control'])!!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('training_place','Training Place')!!} <span class="text-danger">&#9733;</span>
					{!!Form::text('training_place',null,['class'=>'form-control'])!!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('starting_date','Starting Date')!!} <span class="text-danger">&#9733;</span>
					{!! Form::date('starting_date',null,['class'=>'form-control'])!!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('ending_date','Ending Date')!!} <span class="text-danger">&#9733;</span>
					{!! Form::date('ending_date',null,['class'=>'form-control'])!!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('expiration','Expiration')!!} <span class="text-danger">&#9733;</span>
					{!! Form::text('expiration',null,['class'=>'form-control'])!!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('training_comment','Comment')!!}
					{!! Form::textarea('training_comment',null,['class'=>'form-control'])!!}

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
