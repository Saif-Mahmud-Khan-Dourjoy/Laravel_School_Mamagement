<div class="row">
	<div class="col-md-6">
		<div class="form-group"> 
			{!! Form::label('subjects','Choose subject:') !!}

			{!! Form::select('subject_id', $subjects, isset($subject->id) ? $subject->id :null, ['class'=> 'form-control']) !!}
			{!! Form::hidden('section_id', $section->id, ['class'=> 'form-control']) !!}
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group"> 
			{!! Form::label('teachers','Choose subject teacher:') !!}

			{!! Form::select('teacher_id', $teachers, isset($teacher->id) ? $teacher->id :null, ['class'=> 'form-control']) !!}
			
		</div>
	</div>
</div>
<!-- Set up exam details -->
<div class="row">
	<div class="header">
		<h5 class="title" style="text-align: center;"><b>Settings For Exam Mark Distribution</b></h5>
	</div>
	<table class="table" style="padding: 30px;">
	  <thead class="thead-light">
	    <tr>
	      <th scope="col" style="font-size: 12px;"><b>Term Name</b></th>
	      <th scope="col" style="font-size: 12px;"><b>Term Total</b></th>
	      <th scope="col" style="font-size: 12px;"><b>Pass Mark</b></th>
	      <!-- <th scope="col" style="font-size: 12px;"><b>WT Marks</b></th> -->
	      <th scope="col" style="font-size: 12px;"><b>Hall Test Marks</b></th>
	      <!-- <th scope="col" style="font-size: 12px;"><b>WT Convert In</b></th> -->
	      <th scope="col" style="font-size: 12px;"><b>Hall Convert In</b></th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($terms as $term)
	  	<input type="hidden" name="rows[{{ $term->id }}][term_id]" value="{{$term->id}}">
	  	<tr>
		      <td scope="col" style="font-size: 12px; text-align: center;"><b>{{ $term['term_name']}}</b></td>
		      <td scope="col">
		      	<input style="text-align: center;" type="number" class="form-control" required value="100" name="rows[{{ $term->id }}][total_mark]" >
		      </td>
		      <td scope="col">
		      	<input style="text-align: center;" type="number" class="form-control" required value="33" name="rows[{{ $term->id }}][pass_mark]">
		      </td>
		      <!-- <td scope="col">
		      	<input style="text-align: center;" type="number" class="form-control" required value="{{ env('WT_MARK', 15) }}" name="rows[{{ $term->id }}][wt_mark]">
		      </td> -->
		      <td scope="col">
		      	<input style="text-align: center;" type="number" class="form-control" required value="100" name="rows[{{ $term->id }}][ht_mark]">
		      </td>
		      <!-- <td scope="col">
		      	<input style="text-align: center;" type="number" class="form-control" required value="{{ env('WT_CONVERT_MARK', 30) }}" name="rows[{{ $term->id }}][wt_convert_in]">
		      </td> -->
		      <td scope="col">
		      	<input style="text-align: center;" type="number" class="form-control" required value="100" name="rows[{{ $term->id }}][ht_convert_in]">
		      </td>
	    </tr> 
	    @endforeach
	  </tbody>
</table>

<div class="row text-center">
    <p>Select Exam Types</h4>


	<div class="col-md-4">
		<input  type="checkbox" id="written" name="written_permission" value="Yes">
		<label for="written"> Written</label><br>
		<div>
			<input style="text-align: center;" type="number" value="0" class="form-control" placeholder="Marks" name="written_total">
		</div>
		
	</div>
	<div class="col-md-4">
		<input type="checkbox" id="mcq" name="mcq_permission" value="Yes">
		<label for="mcq">MCQ</label><br>
		<div>
			<input style="text-align: center;" type="number" value="0" class="form-control" placeholder="Marks" name="mcq_total">
		</div>
		
	</div>
	<div class="col-md-4">
	 	<input   type="checkbox" id="pactical" name="pactical_permission" value="Yes">
		<label for="pactical">Pactical</label><br>
		<div>
			<input style="text-align: center;" type="number" value="0" class="form-control" placeholder="Marks" name="pactical_total">
		</div>
		
	</div>
</div>
</div>
</div>