<!-- 
	<div class="row">
		<div class="col-md-4">
			<div class="form-group text-center"> 
				{!! Form::label('students','Choose students:', ['class'=>'form-control text-center']) !!}
				{!! Form::select('student_id[]', $students, isset($student->id) ? $student->id :null, ['class'=> ' select2 form-control', 'id' => 'student_id', 'multiple'=>"multiple"]) !!}
				{!! Form::hidden('section_id', $section->id, ['class'=> 'form-control']) !!}
			</div>
		</div>
	</div>
-->
<!-- <script type="text/javascript">
	$(document).ready(function(){
		$('#student_id').select2();
	});
</script>
-->



<div class="table-responsive">

	<table class="table table-bordered table-striped" id="user_table">
		<thead>
			<tr>
				<th width="10%">Choose Student</th>
				<th width="10%">Roll</th>
				<th width="10%">Action</th>
			</tr>
		</thead>
		<tbody>

		</tbody>
		<tfoot>
		</table>

	</div>


	<script>
		$(document).ready(function(){
			$(document).ready(function(){
				$('#student_id').select2();
			});
			var count = 1;
			var doOld = false;
			dynamic_field(count);

			function dynamic_field(number)
			{
				if($('#roll_id').val() == "")
					return alert("Roll No Required!!!");
				html = '<tr>';
				if(number > 1)
				{
					html += '<td><input type="text" name="student_name[]" value="'+$('#student_id option:selected').text()+'" readonly/><input type="hidden" name="student_id[]" value="'+$('#student_id').val()+'"/></td>';
					html += '<td><input type="text" name="roll[]" value="'+$('#roll_id').val()+'" class="form-control" readonly/></td>';
					html += '<td><button type="button" name="remove" class="btn btn-danger remove">Remove</button></td></tr>';
					$('tbody').append(html);
				}else{
					html += '<td>{!! Form::select(null, $students, null, ['class'=> ' select2 form-control', 'id' => 'student_id']) !!}</td>';
					html += '<td><input type="text" class="form-control" id="roll_id"/></td>';   
					html += '<td><input type="hidden" value="{{$section->id}}" name="section_id"/><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
					$('tbody').html(html);
				}
				<?php
				if(old('student_name')){
					echo 'if(doOld == false){var oldData = "";';
					foreach (old('student_name') as $key => $value) {
						$stuName = $value;
						$stuId = old('student_id')[$key];
						$stuRoll = old('roll')[$key];
						
					echo <<<END
					oldData += '<tr><td><input type="text" name="student_name[]" value="$value" readonly/><input type="hidden" name="student_id[]" value="$stuId"/></td>';
					oldData += '<td><input type="text" name="roll[]" value="$stuRoll" class="form-control" readonly/></td>';
					oldData += '<td><button type="button" name="remove" class="btn btn-danger remove">Remove</button></td></tr>';
					count++;
END;
				}
					echo '$("tbody").append(oldData);console.log(oldData);doOld=true;}';
				}
				?>
				$('#roll_id').val('');
			}

		$(document).on('click', '#add', function(){
			count++;
			dynamic_field(count);
		});

		$(document).on('click', '.remove', function(){
			count--;
			$(this).closest("tr").remove();
		});

	});
</script>
