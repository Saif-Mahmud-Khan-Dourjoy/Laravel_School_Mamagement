
<div class="modal fade" id="NtrcaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-center" id="exampleModalLongTitle">Ntrca Info</h3>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="">
        
              {!! Form::open(['method' => 'POST', 'url' => ['/teachers/more_ntrca_info/'.$teacher->id]]) !!}
			<div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('registation_no','Registation No') !!} <span class="text-danger">&#9733;</span>
                    {!! Form::text('registation_no', null,['class'=> 'form-control'])!!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('roll_no','Roll No')!!} <span class="text-danger">&#9733;</span>
                    {!! Form::text('roll_no',null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('ntrca_subject','Subject')!!} <span class="text-danger">&#9733;</span>
                    {!! Form::text('ntrca_subject',null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('ntrca_passing_year','Passing Year')!!} <span class="text-danger">&#9733;</span>
                    {!! Form::number('ntrca_passing_year',null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('ntrca_appoiment_date','Appoiment Date')!!} <span class="text-danger">&#9733;</span>
                    {!! Form::date('ntrca_appoiment_date',null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('ntrca_joining_date','Joining Date')!!} <span class="text-danger">&#9733;</span>
                    {!! Form::date('ntrca_joining_date',null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('ntrca_comment','Comment')!!}
                    {!! Form::textarea('ntrca_comment',null,['class'=>'form-control'])!!}

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

