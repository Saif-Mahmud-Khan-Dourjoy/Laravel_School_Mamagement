<div class="row">
    <div class="col-md-12">
        <span style="font-weight: bold;">Public Exam Information</span>
        {!! Form::checkbox('public_exam_check', null, null, array('id'=>'public_exam1', 'onclick'=>'public_exam()' )) !!}
        
        <div id="public_exam_section">
            <div class="text-right">
                <span class="add_button btn"> +</span>
                <span class="remove_button btn">-</span>
            </div>
            <div class="common">
            
                <div class="col-md-12 my-2 child1"  style="border-style: solid;">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('exam_name','Exam Name') !!}  <span class="text-danger">&#9733;</span>
                            {!! Form::text('exam_name[]', isset($student->exam_name) ? $student->exam_name : null, ['class'=> 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('year','Year') !!}<span class="text-danger">&#9733;</span>
                            {!! Form::text('year[]', isset($student->year) ? $student->year : null, ['class'=> 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('public_roll_no','Roll No.') !!}
                            {!! Form::text('public_roll_no[]', isset($student->roll_no) ? $student->roll_no : null, ['class'=> 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('reg_no','Reg No.') !!}
                            {!! Form::text('reg_no[]', isset($student->reg_no) ? $student->reg_no : null, ['class'=> 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('board','Board') !!}
                            {!! Form::text('board[]', isset($student->board) ? $student->board : null, ['class'=> 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('department','Department') !!}
                            {!! Form::text('department[]', isset($student->department) ? $student->department : null, ['class'=> 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('result','Result') !!}
                            {!! Form::text('result[]', isset($student->result) ? $student->result : null, ['class'=> 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="append_room">
            </div>
        </div>
    </div>   
</div>