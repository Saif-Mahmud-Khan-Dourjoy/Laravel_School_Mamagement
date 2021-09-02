<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Select Session</label><small> *</small>
			<select name="session_id" id="session" class="form-control">
				<option>Select Session</option>
				@foreach($se as $session) 
				<option value="{{$session->id}}">
					{{$session->name}}          
				</option>
				@endforeach
			</select>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			<label>Select Class</label><small> *select Session</small>
			<select name="level_id" id="class" class="form-control">
				<option>Select Class</option>

			</select>

		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group" >
			<label>Select Section</label> <small> *select Session & class</small>
			<select name="section_id" id="section" class="form-control">
				<option>Select Section</option>

			</select>

		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Select Student</label><small> *select class & section</small>
			<select name="student_id" id="student" class="form-control">
				<option>Select Student</option>
			</select>

		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Select Month</label><small> *select session</small>
			<select name="business_month_id" id="business_month" class="form-control">
				<option>Select Month</option>
				
			</select>
		</div>
	</div>
	
</div>


<script type="text/javascript">

	$(document).ready(function(){
		$('#session').change(function(){
			var session=$('#session').val();

			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: '../get_data',
				type: 'POST',
				data: {
					'session_id':session
				},


				success: function(data) {
					var dataes=JSON.parse(data)
					console.log(dataes);
					var cls=dataes.class;
					var b_m=dataes.business_months;
					
					var output="<option>Select Class</option>";
					for(var i =0; i<cls.length;i++){
						output +='<option value="'+cls[i].id+'">'+cls[i].class_name+ '</option>';


					}
					$('#class').html(output);
                       var output1="<option>Select Month</option>";
					for(var j =0; j<b_m.length;j++){
						 output1 +='<option value="'+b_m[j].id+'">'+b_m[j].month_name+ '</option>';
					}
					$('#business_month').html(output1);

				},
				error:function(){
					alert('Error');
				}
			});
		}) ;

		$('#class').change(function(){
			var class_id=$('#class').val();
			var session=$('#session').val();

			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: '../get_section',
				type: 'POST',
				data: {
					'class_id':class_id,
					'session_id':session,
				},


				success: function(data) {


					var output="<option>Select Section</option>";
					for(var i =0; i<data.length;i++){
						output +='<option value="'+data[i].id+'">'+data[i].section_name+ '</option>';

						$('#section').html(output);

					}

				},
				error:function(){
					alert('Error');
				}
			});



		});

			$('#section').change(function(){
			var section_id=$('#section').val();
			

			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: '../get_student',
				type: 'POST',
				data: {
					'section_id':section_id
					
				},


				success: function(data) {

					var output="<option>Select Student</option>";
					for(var i =0; i<data.length;i++){
						output +='<option value="'+data[i].id+'">'+data[i].name + ' ('+ data[i].roll_no+')</option>';

						$('#student').html(output);

					}

				},
				error:function(){
					alert('Error');
				}
			});



		});

	});


</script>

