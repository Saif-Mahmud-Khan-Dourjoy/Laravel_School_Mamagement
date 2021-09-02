<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<label>Choose Session</label><span class="text-danger">&#9733;</span>
			<select name="session_id" id="session" class="form-control">
				<option>Select Session</option>
				@foreach($se as $session) 
				<option value="{{$session->id}}">
					{{$session->name}}          
				</option>
				@endforeach
			</select>
			@error('session_id')
                <small class="text-danger">The session field is required.</small>
        	@enderror
		</div>
		
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<label>Choose Class</label><span class="text-danger">&#9733;</span>

			<select name="level_id" id="class" class="form-control">
				<option>Select Class</option>

			</select>
			@error('level_id')
					<small class="text-danger">The class field is required.</small>
			@enderror
		</div>
		
	</div>
	<div class="col-md-4">
		<div class="form-group" >
			<label>Choose Section</label><span class="text-danger">&#9733;</span>
			<select name="section_id" id="section" class="form-control">
				<option>Select Section</option>

			</select>
			@error('section_id')
                <small class="text-danger">The section field is required.</small>
        	@enderror
			

		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<label>Choose Month</label><span class="text-danger">&#9733;</span>
			<select name="business_month_id" id="business_month" class="form-control">
				<option>Select Month</option>
			</select>
			@error('business_month_id')
            <small class="text-danger">The month field is required.</small>
       		 @enderror
		</div>
		
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<label>Choose Fees Type</label><span class="text-danger">&#9733;</span>
			<select name="fees_type_id" id="fees_type" class="form-control">
				<option>Select Fee Type</option>
				
				@foreach($fees_types as $f_t) 
				<option value="{{$f_t->id}}">
					{{$f_t->fees_type_name}}          
				</option>
				@endforeach
				


			</select>
			@error('fees_type_id')
                <small class="text-danger">The fees Type field is required.</small>
        	@enderror

		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group" >
			<label>Choose Amount</label><span class="text-danger">&#9733;</span>
			<input type="number" name="amount" class="form-control">
			@error('amount')
            <small class="text-danger">{{ $message }}</small>
        	@enderror
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

	});


</script>


