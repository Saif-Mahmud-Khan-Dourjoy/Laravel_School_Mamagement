@section('heading')
Sections
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"  style="background-color: #f2f2f2;">
					<h4 class="title" align="center">Update Term Mark Details</h4>
				</div>
				<div class="panel-body">
					<form action="{{ route('sectionSubjectTeachers.update', $term_mark->id) }}" method="POST">
						@csrf
						<input name="_method" type="hidden" value="PUT">
						<div class="row">
							<div class="col-md-6">
									<label for="subjects">Choose Subject</label><span class="text-danger">&#9733;</span>
									<select class="custom-select form-control" id="subject_id" name="subject_id">
										<option selected>select subject</option>
										@foreach($subjects as $subject)
										<option {{ ($term_mark->subject_id == $subject->id)?"selected":"" }} value="{{ $subject->id }}">{{$subject->subject_name}}</option>
										@endforeach
									</select>
								</div>  
							<div class="col-md-6">
								<div class="form-group">
									<label for="teachers">Choose Subject Teacher</label><span class="text-danger">&#9733;</span>
									<select class="custom-select form-control" id="teacher_id" name="teacher_id">
										<option selected>select subject</option>
										@foreach($teachers as $teacher)
										<option {{($term_mark->teacher_id == $teacher->id)?"selected":"" }} value="{{ $teacher->id }}">{{ $teacher->teacher_name }}</option>
										@endforeach
									</select>
								</div>  
							</div>
						</div>
						<div class="row">
							<div class="header">
								<h5 class="title" style="text-align: center;"><b>Edit Mark Distribution For Exam</b></h5>
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
								<tbody class="tbody_table">

									@foreach($terms as $term)
									
									<?php
									if (!isset($sstm)){
										$sstm = new app\SectionSubjectTermMark();
										$sstm->total_mark = env('TOTAL_MARK', 100);
										$sstm->pass_mark = env('PASS_MARK', 33);
										$sstm->wt_mark = env('WT_MARK',0);
										$sstm->ht_mark = env('HT_MARK', 100);
										$sstm->wt_convert_in = env('WT_CONVERT_MARK', 0);
										$sstm->ht_convert_in = env('HT_CONVERT_MARK', 100);
									}
									?>

									<input type="hidden" name="rows[{{ $term->id }}][term_id]" value="{{$term->id}}">
									<tr class="tr_group">
										<td scope="col" style="font-size: 12px; text-align: left;"><b>{{ $term->term_name }}</b></td>
										<td scope="col" style="width:150px">
											<input style="text-align: center;" min=1 max=100 type="number" class="form-control total_mark" required value="{{$sstm->total_mark}}" name="rows[{{ $term->id }}][total_mark]" >
										</td>
										<td scope="col" style="width:150px">
											<input style="text-align: center;" type="number" min=1 max=100 class="form-control pass_mark" required value="{{$sstm->pass_mark}}" name="rows[{{ $term->id }}][pass_mark]">
										</td>
										<!-- <td scope="col" style="width:150px">
											<input style="text-align: center;" type="number" min=1 max=100 class="form-control wt_mark" required value="{{$sstm->wt_mark}}" name="rows[{{ $term->id }}][wt_mark]">
										</td> -->
										<td scope="col" style="width:150px">
											<input style="text-align: center;" type="number" min=1 max=100 class="form-control ht_mark" required value="{{$sstm->ht_mark}}" name="rows[{{ $term->id }}][ht_mark]">
										</td>
										<!-- <td scope="col" style="width:150px">
											<input style="text-align: center;" type="number" min=1 max=100 class="form-control wt_convert_in" required value="{{$sstm->wt_convert_in}}" name="rows[{{ $term->id }}][wt_convert_in]">
										</td> -->
										<td scope="col" style="width:150px">
											<input style="text-align: center;" type="number" min=1 max=100 class="form-control ht_convert_in" required value="{{$sstm->ht_convert_in}}" name="rows[{{ $term->id }}][ht_convert_in]">
										</td>
									</tr>
									@endforeach 
								</tbody>
							</table>
						</div>


						<!-- Exam Type -->
						<div class="row text-center">
							<p><span class="text-danger">&#9733;</span> Select Exam Types <span class="text-danger">&#9733;</span></h4>
							
							<div class="col-md-4">
								<input  type="checkbox" <?php if(isset($term_mark->section_subject_distribution->written_permission)){ if($term_mark->section_subject_distribution->written_permission=="Yes"){echo "checked";}} else{ echo "checked";} ?> id="written" name="written_permission" value="Yes">
								<label for="written"> Written</label><br>
								<div>
									<input style="text-align: center;" type="number" value=<?php if(isset($term_mark->section_subject_distribution->written_total)){ echo $term_mark->section_subject_distribution->written_total;} else{ echo "0";} ?>  class="form-control" placeholder="Marks" name="written_total">
								</div>
								
							</div>
							<div class="col-md-4">
								<input type="checkbox"  <?php if(isset($term_mark->section_subject_distribution->mcq_permission)){ if($term_mark->section_subject_distribution->mcq_permission=="Yes"){echo "checked";}} ?> id="mcq" name="mcq_permission" value="Yes">
								<label for="mcq">MCQ</label><br>
								<div>
									<input style="text-align: center;" type="number" value=<?php if(isset($term_mark->section_subject_distribution->mcq_total)){ echo $term_mark->section_subject_distribution->mcq_total;} else{ echo "0";} ?> class="form-control" placeholder="Marks" name="mcq_total">
								</div>
								
							</div>
							<div class="col-md-4">
								<input   type="checkbox"  <?php if(isset($term_mark->section_subject_distribution->pactical_permission)){ if($term_mark->section_subject_distribution->pactical_permission=="Yes"){echo "checked";}} ?> id="pactical" name="pactical_permission" value="Yes">
								<label for="pactical">Practical</label><br>
								<div>
									<input style="text-align: center;" type="number" value=<?php if(isset($term_mark->section_subject_distribution->pactical_total)){ echo $term_mark->section_subject_distribution->pactical_total;} else{ echo "0";} ?> class="form-control" placeholder="Marks" name="pactical_total">
								</div>
								
							</div>
						</div>
						<br>

						<div class="form-group">
							<div class="row">
								<div class="col-md-12" style="text-align: center;">
									<button type="submit" class="btn btn-info btn-fill btn-wd">Update Record</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.total_mark').on('keyup mouseup', function(e){
			e.preventDefault();
			let total_mark = $('.total_mark').val();
			let parent = $(this).parents('.tr_group');
			parent.find('.wt_convert_in').attr('max', total_mark);
			parent.find('.ht_convert_in').attr('max', total_mark);
		})
	});
</script>
@endsection
