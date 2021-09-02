
<div class="modal fade" id="EduModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-center" id="exampleModalLongTitle">Add Educational Qualification</h3>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="">
        
              {!! Form::open(['method' => 'POST', 'url' => ['/teachers/more_edu_info/'.$teacher->id]]) !!} 
          
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('degree_name','Degree Name') !!}<span class="text-danger">&#9733;</span>
					{!! Form::text('degree_name', null, ['class'=> 'form-control']) !!}
				</div>
			</div> 

			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('passing_year','Passing Year') !!}<span class="text-danger">&#9733;</span>
					{!! Form::text('passing_year', null, ['class'=> 'form-control']) !!}
				</div>
			</div>

			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('result','Result') !!}<span class="text-danger">&#9733;</span>
					{!! Form::text('result',null, ['class'=> 'form-control']) !!}
				</div>
			</div>

			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('edu_institute_name','Institute Name') !!}<span class="text-danger">&#9733;</span>
					{!! Form::text('edu_institute_name', null, ['class'=> 'form-control']) !!}
				</div>
			</div>

			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('edu_subject','Subject') !!}<span class="text-danger">&#9733;</span>
					{!! Form::text('edu_subject', null, ['class'=> 'form-control']) !!}
				</div>
			</div>

			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('education_board','Education Board') !!}
					{!! Form::text('education_board', null, ['class'=> 'form-control']) !!}
				</div>
			</div>


			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('education_comment','Comment') !!}
					{!! Form::textarea('education_comment',  null, ['class'=> 'form-control']) !!}
				</div>
			</div>
			<div class="form-group mt-3 col-md-12">
				<div class="text-center">
					{!! Form::submit('Add', array('class'=> 'text-center btn btn-info btn-fill btn-wd')) !!}
					<!-- <a href="{{route('teachers.index')}}" class="btn btn-default btn-fill btn-wd"> Cancel</a> -->
					
				</div>
				{!! Form::close() !!}

           </div>
       </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
