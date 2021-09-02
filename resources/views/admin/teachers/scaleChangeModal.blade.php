
<div class="modal fade" id="ScaleChangeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-center" id="exampleModalLongTitle">Scale Change Info</h3>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="">
        
              {!! Form::open(['method' => 'POST', 'url' => ['/teachers/more_scale_change_info/'.$teacher->id]]) !!}
			<div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('salary_grade','Salary Grade') !!}
                    {!! Form::text('salary_grade', null,['class'=> 'form-control'])!!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('present_salary_scale','Present Salary Scale')!!}
                    {!! Form::text('present_salary_scale',null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('first_mpo_joining_date','First Mpo Joining Date')!!}
                    {!! Form::date('first_mpo_joining_date',null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('first_high_scale_date','First high Scale Date')!!}
                    {!! Form::date('first_high_scale_date',null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('second_high_scale_date','Second High Scale Date')!!}
                    {!! Form::date('second_high_scale_date',null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('first_time_scale_date','First Time Scale Date')!!}
                    {!! Form::date('first_time_scale_date',null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('second_time_scale_date','Second Time Scale Date')!!}
                    {!! Form::date('second_time_scale_date',null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('bed_scale_date','Bed_scale_date')!!}
                    {!! Form::date('bed_scale_date',null,['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('scale_comment','Comment')!!}
                    {!! Form::textarea('scale_comment',null,['class'=>'form-control'])!!}

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

