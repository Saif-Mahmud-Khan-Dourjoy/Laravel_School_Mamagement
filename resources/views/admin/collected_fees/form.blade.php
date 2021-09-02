{{--
    **Fees collection form
    **Version 0.1~2019
    **Author:Md. Abdullah
    **Systech Digital Limited
    --}}

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('session','Choose session:') !!}<span class="text-danger">&#9733;</span>
                <?php
                $listSessions = [];
                foreach ($sessions as $keyL => $valL){
                    $listSessions[$valL->id] = $valL->name;
                }
                ?>
                {!! Form::select('session_id', $listSessions, isset($student->session_id) ? $student->session_id : null, ['required', 'class'=> 'form-control', 'id' => 'session_id']) !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('level','Choose Class:') !!}  <span class="text-danger">&#9733;</span>               
                {!! Form::select('level_id', [], isset($student->level_id) ? $student->level_id : null, ['required', 'class'=> 'form-control', 'id' => 'level_id']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('sections','Choose section:') !!}<span class="text-danger">&#9733;</span>
                {!! Form::select('section_id', [], isset($student->section_id) ? $student->section_id : null, ['required', 'class'=> 'form-control', 'id' => 'section_id']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('students','Choose Student:') !!}<span class="text-danger">&#9733;</span>
                {!! Form::select('student_id',[], isset($collected_fees->student_id) ? $collected_fees->student_id :null, ['required', 'class'=> 'form-control', 'id' => 'student_id']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('business_months','Choose Month:') !!}<span class="text-danger">&#9733;</span>
                {!! Form::select('business_month_id', $business_months, isset($section_wise_fees->business_month_id) ? $section_wise_fees->business_month_id :null, ['required', 'class'=> 'form-control', 'id' => 'business_month_id']) !!}
            </div>
        </div>
        
    </div>

{{--
    **Calculation fees by jquery
    **Version 0.1~2019
    **Author:Md. Abdullah
    **Systech Digital Limited
    --}}

    <script type="text/javascript">
        var $collected_feesJ = <?php echo (isset($collected_fees))?json_encode($collected_fees): -1 ?>;

        var sessionList = <?php echo json_encode($sessions);?>;
        var levelList = <?php echo json_encode($levels);?>;
        var studentList = <?php echo json_encode($students);?>;
        var feesType = <?php echo json_encode($fees_types);?>;

        $(document).ready(function(){

            if($collected_feesJ != -1){
                $('#session_id').val('{$collected_fees->section_student->section->level_enroll->session->id}');
                setTimeout(function(){
                    $('#level_id').val('{$collected_fees->section_student->section->level_enroll->level->id}');
                    $('#level_id').trigger('change');
                },100);
                setTimeout(function(){
                    $('#section_id').val('{$collected_fees->section_student->section->id}');
                },150);
                setTimeout(function(){
                    $('#business_month_id').val('{$collected_fees->business_month->id}');
                },150);
            }

            $('#session_id').change(function (e){
                e.preventDefault();
                updateLevel();
                updateSection();
                updateBusinessMonth();
                updateStudent();
            });

            $('#level_id').change(function (){
                updateSection();
                updateBusinessMonth();
                updateStudent();
            });

            $('#section_id').change(function (){
                updateStudent();
            });
/*
            $('#business_month_id').change(function (){
                updateFeesType();
            });*/

            updateLevel();
            updateStudent();
            updateBusinessMonth();

        });

    {{--
        **necessary functions for update field data dynamically 
        **Version 0.1~2019
        **Author:Ahsan Zahid
        **Systech Digital Limited
        --}}

        function updateLevel() {
            //console.log(sessionList);
            $.each(sessionList, function(ind, val){
                //console.log(val.level_enroll);
                // debugger;
                if(val.id == $('#session_id').val()){
                    $('#level_id').empty();
                    $.each(val.level_enroll, function(indS, valS) {
                        //console.log(valS);
                        $('#level_id').append('<option value="'+valS.level.id+'">'+valS.level.class_name+' >> '+valS.shift.shift_name+'</option>');
                        if(indS == 0){
                            $('#section_id').empty();
                            $.each(valS.section, function(indSec, valSec) {
                                $('#section_id').append('<option value="'+valSec.id+'">'+valSec.section_name+'</option>');
                            });
                        }
                    });
                }
            });   
        }

        function updateSection() {
            console.log(levelList);
            /*var currentLevels = levelList.filter(x=>x.id==$('#level_id').valx());
            console.log(currentLevels);*/
            $.each(levelList, function(index, value){
                //console.log(value);
               if(value.id == $('#level_id').val()) {
                   $('#section_id').empty();
                   $.each(value.level_enroll, function(indxs, valxs){
                    //console.log(valxs);
                    $.each(valxs.section, function(indxss, valxss) {
                        //console.log(valxss.id);
                        $('#section_id').append('<option value="'+valxss.id+'">'+valxss.section_name+'</option>');
                        
                    });
                    
                   
                });
               }
            });
        }

        function updateBusinessMonth(){
            //console.log(sessionList);
            $.each(sessionList, function(ind, val){
                //console.log(val.level_enroll);
                // debugger;
                if(val.id == $('#session_id').val()){
                    $('#business_month_id').empty();
                    if(val.level_enroll[0] != undefined
                        && val.level_enroll[0].branch != undefined 
                        && val.level_enroll[0].branch.fiscal_year_current[0] != undefined
                        && val.level_enroll[0].branch.fiscal_year_current[0].business_month != undefined
                    )
                    $.each(val.level_enroll[0].branch.fiscal_year_current[0].business_month, function(indS, valS) {
                        //console.log(valS);
                        $('#business_month_id').append('<option value="'+valS.id+'">'+valS.month_name+'</option>');
                    });
                }
            });   
        }

        function updateStudent() {
            $('#student_id').empty();
            $.each(studentList, function(index, value){
                if(value.section_id == $('#section_id').val()) {
                    $('#student_id').append('<option value="'+value.student.id+'">'+value.student.name+' ('+value.student.roll_no+')</option>');
                }
            });
        }

        function updateFeesType() {
            var $business_month_id = $('#business_month_id').val()
            var $session_id = $('#session_id').val()
            var $section_id = $('#section_id').val()
            $('.fees_type').empty();
            $.each(feesType, function(index, value){
                console.log($session_id);
                console.log(value.session_id);
                if((value.business_month_id == $business_month_id) && (value.section_id == $section_id) && (value.session_id == $session_id)) {
                    $('.fees_type').append(
                        '<label class="form-inline"><input type="checkbox" class="radio" value="'+value.amount+'" name="amount[]"/> '+value.fees_type.fees_type_name+'</label>&nbsp; '
                        );
                }
            });
        }

    </script>