<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('starts_from','Start date:') !!}
            {!! Form::date('starts_from', null, ['style'=> 'border: 1px solid','class'=> 'form-control', 'placeholder'=> 'dd-mm-yyyy']) !!}
            </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('ends_on','End date:') !!}
            {!! Form::date('ends_on', null, ['style'=> 'border: 1px solid', 'class'=> 'form-control',  'placeholder'=> 'dd-mm-yyyy']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('fiscal_year','Fiscal Year:') !!}
            <?php
                $listFiscalYears = [];
                $listFiscalYears[''] = 'Select Fiscal Year';
                foreach ($fiscal_years as $keyL => $valL){
                    $listFiscalYears[$valL->id] = $valL->year;
                }
            ?>
            {!! Form::select('fiscal_year_id', $listFiscalYears, null, ['class'=> 'form-control select-picker', 'id' => 'fiscal_year_id']) !!}
        </div>
    </div>
      <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('month_name','Business Month:') !!}                
            {!! Form::select('business_month_id', [], null, ['class'=> 'form-control select-picker', 'id' => 'business_month_id']) !!}
        </div>
    </div>
</div>
<div class="row">
     <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('session','Choose session:') !!}
            <?php
                $listSessions = [];
                $listSessions[''] = 'Select Session';
                foreach ($sessions as $keyL => $valL){
                    $listSessions[$valL->id] = $valL->name;
                }
            ?>
            {!! Form::select('session_id', $listSessions, isset($student->session_id) ? $student->session_id : null, ['class'=> 'form-control select-picker', 'id' => 'session_id']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('level','Choose Class:') !!}                 
            {!! Form::select('level_id', [], isset($student->level_id) ? $student->level_id : null, ['class'=> 'form-control select-picker', 'id' => 'level_id']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('sections','Choose section:') !!}
            {!! Form::select('section_id', [], isset($student->section_id) ? $student->section_id : null, ['class'=> 'form-control select-picker', 'id' => 'section_id']) !!}
        </div>
    </div>
     <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('students','Choose Student:') !!}
            {!! Form::select('student_id',[], isset($collected_fees->student_id) ? $collected_fees->student_id :null, ['class'=> 'form-control select-picker', 'id' => 'student_id']) !!}
        </div>
    </div>
</div>

<script type="text/javascript">
    var sessionList = <?php echo json_encode($sessions);?>;
    var levelList = <?php echo json_encode($levels);?>;
    var studentList = <?php echo json_encode($students);?>;
    var fiscalYearList = <?php echo json_encode($fiscal_years);?>;
    var businessMonthList = <?php echo json_encode($business_months);?>;

    $(document).ready(function(){
        $('.select-picker').select2();
        $('#fiscal_year_id').change(function (e){
            e.preventDefault();
            updateMonth();
        });

        $('#session_id').change(function (e){
            e.preventDefault();
            updateLevel();
            updateSection();
            updateStudent();
        });

        $('#level_id').change(function (){
            updateSection();
            updateStudent();
        });

        $('#section_id').change(function (){
            updateStudent();
        });

        updateMonth();
        updateLevel();
        updateSection();
        updateStudent();
        
        $('#level_id').append('<option value="">Select Class</option>');
        $('#section_id').append('<option value="">Select Section</option>');
        //$('#student_id').append('<option value="">Select Student</option>');
    });

    function updateLevel() {
        $.each(sessionList, function(ind, val){
            if(val.id == $('#session_id').val()){
                $('#level_id').empty();
                $('#level_id').append('<option value="">Select Class</option>');
                $.each(val.level_enroll, function(indS, valS) {
                    $('#level_id').append('<option value="'+valS.level.id+'">'+valS.level.class_name+'</option>');
                   /* console.log(indS);
                    if(indS == 0){
                        $('#section_id').empty();
                        $('#section_id').append('<option value="">Select Section</option>');
                        $.each(valS.section, function(indSec, valSec) {
                            $('#section_id').append('<option value="'+valSec.id+'">'+valSec.section_name+'</option>');
                        });
                    }*/
                });
            }
        });   
    }

    function updateSection() {
        $.each(levelList, function(index, value){
            if(value.id == $('#level_id').val()) {
                $('#section_id').empty();
                $('#section_id').append('<option value="">Select Section</option>');
                $.each(value.level_enroll, function(indxs, valxs){
                    $.each(valxs.section, function(indxss, valxss) {
                        $('#section_id').append('<option value="'+valxss.id+'">'+valxss.section_name+'</option>');
                    });
                });
            }
        });
    }

    function updateStudent() {
        $('#student_id').empty();
        $('#student_id').append('<option value="">Select Student</option>');
        $.each(studentList, function(index, value){
           // console.log(value);
            if(value.section_id == $('#section_id').val()) {
                $('#student_id').append('<option value="'+value.student.id+'">'+value.student.name+' ('+value.student.roll_no+')</option>');
            }
        });
    }

    function updateMonth() {
        $('#business_month_id').empty();
        $('#business_month_id').append('<option value="">Select Month</option>');
        $.each(businessMonthList, function(index, value) {
            //console.log(value.id);
            if(value.fiscal_year_id == $('#fiscal_year_id').val()) {
                $('#business_month_id').append('<option value="'+value.id+'">'+value.month_name+'</option>');
            }
        });
    }

</script>