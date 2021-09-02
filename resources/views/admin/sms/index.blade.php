@section('heading')
Send SMS
@endsection
@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            	<div>
                    @include('layouts.flash_message')
                </div>
                <div class="panel-heading" style="background-color: #f2f2f2;">
                    <h5 class="title" align="center"><strong>Send SMS Notification</strong></h5>
                </div>
                <div class="panel-body">
                    <div style="padding-top: 2px;">
                        <div style="padding: 10px;">
                            <form id="info_search_form" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label for="session">Session</label><small> *required</small>
                                          <select style="border: 1px solid;" class="options form-control" name="session_id" id="session">
                                          </select>
                                          <span class="help-block"></span>
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                   <div class="form-group">
                                      <label for="class">Class</label><small>select session</small>
                                      <select style="border: 1px solid;" class="options form-control" name="level_id" id="class">  
                                      </select>
                                      <span class="help-block"></span>
                                  </div>
                              </div>
                              <div class="col-md-3">
                               <div class="form-group">
                                  <label for="section">Section</label><small> select class</small>
                                  <select style="border: 1px solid;" class="options form-control" name="section_id" id="section">
                                  </select>
                                  <span class="help-block"></span>
                              </div>
                          </div>
                          <div class="col-md-3">
                           <div class="form-group">
                              <label for="sms_type">SMS To</label><small> </small>
                              <select style="border: 1px solid;" class="options form-control" name="sms_type" id="sms_type">
                                <option disabled>Select SMS Type</option>
                                <option value="1" selected>Students</option>
                                <option value="2">Class Teacher</option>
                                <option value="3">All Teachers</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                   <div class="col-md-12" style="text-align: center;">
                      <button type="button" id="load_btn" class="btn btn-round btn-wd" formtarget="_blank">Load Contact</button>
                      <button  type="button" id="refresh_btn2" class="btn btn-info btn-round"><i class="fa fa-refresh text-info"></i></button>
                  </div>
              </div>
          </form>
      </div>
      <div class="row justify-content-center">
       <div class="col-md-12" style="margin-top:20px">
        <div class="table-responsive" id="tableDiv">
         <div id="tabs">
           <table id="contactDatatable" class="table table-borderd table-striped table-sm w-100 ml-4 mr-4">

           </table>
       </div> 
       <div class="w-100 flL mt50" id="sendMSGPanel">
           <form action="" class="form-horizontal">
            <div class="row col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label ml-4 mb-3" for="msg_type">Message In</label>
                        <div class="ml-4">
                            <select style="border: 1px solid;" class="options form-control" name="msg_type" id="msg_type">
                                <option value="1" selected>English</option>
                                <option value="2">Bangla</option>
                            </select>  
                        </div>                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label ml-4 mb-3" for="notification_type_id">SMS Type</label>
                        <div class="ml-4">
                            <select style="border: 1px solid;" class="options form-control" name="notification_type_id" id="notification_type_id">
                                <option value="" selected disabled>Select SMS Type</option>
                                <option value="1">Due Notification</option>
                                <option value="5">Important Notice</option>
                                <option value="8">Monthly Fees Payment</option>
                                <option value="9">Exam Fees Payment</option>
                                <option value="10">Exam Date Reminder</option>
                                <option value="11">Parent's Meeting</option>
                                <option value="12">Holiday Reminder</option>
                            </select>  
                        </div>                        
                    </div>
                </div>
            </div>
            <div class="form-group">
               <label for="" class="control-label col-12 ml-5 mb-3"><b>Enter Your Message</b></label>
               <div class="col-10 ml-5 mr-5">
                   <textarea style="border: 1px solid;" name="msg" id="" rows="5" class="form-control"></textarea>
               </div>                            
           </div>
           <div class="form-group">
               <div class="col-12 ml-5">
                   <input type="button" onclick="sendSms(this);" class="btn btn-success" value="Send SMS">
               </div>                            
           </div>
       </form>                    
   </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
    var dTable = null;
    window.addEventListener('load', function(){
       $(function(){
        $('.pick-date').datetimepicker({
        	timepicker:false,
        	format: 'Y-m-d'
        });
    });
    //$('.options').select2();
    var sessions = <?php echo json_encode($sessions); ?>;
    var levelList = <?php echo json_encode($levels);?>;
    
    session_html = '<option disabled selected>Select Specific Session</option>';
    $.each(sessions, function(indexS, valueS) {
        session_html += '<option value="'+valueS.id+'">'+valueS.name+'</option>';
    });
    $('#session').html(session_html);
    $('#session').on('change', function(){
        updateLevel();
        $('#section').empty();
    });

    $('#class').on('change', function(){
        updateSection();
        $('#section_student').empty();
    });

    $(document).on('click','#refresh_btn2', function(){
        refreshForm();
    });

    function updateLevel(){
        $.each(sessions, function(ind, val){
            if(val.id == $('#session').val()){
                $('#class').empty();
                class_html = '<option disabled selected>Select Specific Class</option>';
                $.each(val.level_enroll, function(indS, valS) {
                    if(val.id == valS.session_id){
                        class_html += '<option value="'+valS.level.id+'">'+valS.level.class_name+'</option>';
                    }
                });
            }
        });
        $('#class').html(class_html);   
    }

    function updateSection(){
        $.each(sessions, function(ind, val){
            if(val.id == $('#session').val()){
                $('#section').empty();
                section_html = '<option disabled selected>Select Specific Section</option>';
                $.each(val.level_enroll, function(indLE, valLE){
                    if(valLE.level_id == $('#class').val()){
                        $.each(valLE.section, function(indS, valS){
                            section_html += '<option value="'+valS.id+'">'+valS.section_name+'</option>';
                        });
                    }
                });
            }
        });
        $('#section').html(section_html);
    }

    function refreshForm(){
        $('#info_search_form').trigger('reset');
        $('#class').empty();
        $('#section').empty();
    }

    
    $('#load_btn').click(function(){
        $('#tableDiv').css('display','');
        refresh_datatable();
        axios.post(jsUtlt.siteUrl('/sms-notification/load-info'), $('#info_search_form').serialize())
        .then(function(response){
          // console.log(response.data.data);
          // false;
          refresh_datatable();

          if(response.data.data == "invalid"){

                
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Something went wrong! You should atleast select Session' ,

              })


                
            }
              //loading datatable for all students
              if($('#sms_type').val() == 1){
                dTable = $('#contactDatatable').DataTable({
                    "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                    data : response.data,
                    columns: [
                    {
                        'title': '#SL','data': 'row','width': '10%',
                        'render': function (data, type, row, ind) {
                            return (ind.row + 1);
                        }
                    },
                    {
                        'title': 'Student Name','data': 'student_name','width': '30%',
                        'render': function (data, type, row, ind) {
                            roll = ' (Roll- '+row.roll+')';
                            return data+roll;
                        }
                    },
                    {
                        'title': 'Class','data': 'class_name','width': '10%',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                        'title': 'Religion','data': 'religion','width': '15%',
                        'render': function (data, type, row, ind) {
                            return data;
                        }
                    },
                    {
                      'title': '<label><input class="checkAll-1 mr-2" type="checkbox">Students No</label>','data': 'stdNo','width': '20%',
                      'render': function (data, type, row, ind) {

                          stdNo = '<input class="mr-2 student" type="checkbox" value="88'+row.contact_no+'" name="phones[]">'+row.contact_no+'';

                          return stdNo;
                      }
                  },
                  {
                      'title': '<label><input class="checkAll-2 mr-2" type="checkbox">Parents No</label>', 'class':"pl-3", 'data': 'checkBox','width': '15%','render': function (data, type, row, ind) {

                        if(row.fathers_cell != null){

                            checkBox = '<input class="mr-2 parent-phone" type="checkbox" value="88'+row.fathers_cell+'" name="phones[]">'+row.fathers_cell+'';

                        }else{

                            checkBox = '<input class="mr-2 parent-phone" type="checkbox" value="88'+row.mothers_cell+'" name="phones[]">'+row.mothers_cell+'';

                        }

                        return checkBox; 
                    }
                },
                        // {
                        //   'title': '<label><input class="checkAll mr-2" type="checkbox">Check All</label>', 'class':"pl-3", 'data': 'checkBox','width': '15%','render': function (data, type, row, ind) {
                        //      checkBox = '<input class="mr-2" type="checkbox" value="88'+row.contact_no+'" name="phones[]">';
                        //      return checkBox; 
                        //   }
                        // },
                        ],
                        ordering: false,
                    }); 

              //loading data tables for all teachers
          }else if($('#sms_type').val() == 3){
            dTable = $('#contactDatatable').DataTable({
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                data : response.data,
                columns: [
                {
                    'title': '#SL','data': 'row','width': '10%',
                    'render': function (data, type, row, ind) {
                        return (ind.row + 1);
                    }
                },
                {
                    'title': 'Teacher Name','data': 'teacher_name','width': '30%',
                    'render': function (data, type, row, ind) {
                        return data;
                    }
                },
                {
                    'title': 'Class','data': 'class_name','width': '10%',
                    'render': function (data, type, row, ind) {
                        return data;
                    }
                },
                {
                    'title': 'Religion','data': 'religion','width': '15%',
                    'render': function (data, type, row, ind) {
                        return data;
                    }
                },
                {
                  'title': 'Contact No','data': 'contact_no','width': '20%',
                  'render': function (data, type, row, ind) {
                      return data;
                  }
              },
              {
                  'title': '<label><input class="mr-2 checkAll" type="checkbox">Check All</label>', 'class':"pl-3",'data': 'checkBox', 'width': '15%','render': function (data, type, row, ind) {
                   checkBox = '<input class="mr-2" type="checkbox" value="88'+row.contact_no+'" name="phones[]">';
                   return checkBox; 
               }
           },
           ],
           ordering: false,
       }); 

                //loading data tables for class teacher
            }else if($('#sms_type').val() == 2){
                var data = [
                [
                1,
                response.data.teacher_name,
                response.data.class_name,
                response.data.religion,
                response.data.contact_no,
                '<input class="mr-2" type="checkbox" value="88'+response.data.contact_no+'" name="phones[]">'
                ]
                ];
                dTable = $('#contactDatatable').DataTable({
                    "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                    data : data,
                    columns: [
                    {'title': '#SL','width': '10%'},
                    {'title': 'Teacher Name','width': '30%'},
                    {'title': 'Class', 'width': '10%'},
                    { 'title': 'Religion','width': '15%'},
                    {'title': 'Contact No','width': '20%'},
                    {'title': '<label><input class="checkAll mr-2" type="checkbox">Check All</label>', 'class':"pl-3", 'width': '15%'},
                    ],
                    ordering: false,
                }); 
            }           
        })
.catch(function(faildata){

});
});

    //check all student no
    $(document).on('click', ".checkAll-1", function(){
        //$('input:checkbox').not(this).prop('checked', this.checked);
        $(document).find('.student').not(this).prop('checked', this.checked);
    });

     //check all parent no
     $(document).on('click', ".checkAll-2", function(){
        $(document).find('.parent-phone').not(this).prop('checked', this.checked);
    });

    //check all numbers
    $(document).on('click', ".checkAll", function(){
     $('input:checkbox').not(this).prop('checked', this.checked);
 });

});

function sendSms(el){
    let phone = $(document).find('#contactDatatable').find(':input:checked').map(function(){return $(this).val()}).get();
    let msg = $(":input[name='msg']").val();
    let msg_type = $(":input[name='msg_type']").val();
    let notification_type_id = $(":input[name='notification_type_id']").val();

    if($(document).find('#contactDatatable').find(':input:checked').length < 1){
        alert('Please select at least one row to send :)');
        return;
    }

    if(typeof msg == 'undefined' || msg == ''){
        alert('Please input some text :)');
        return;
    }

    if(typeof notification_type_id == 'undefined' || notification_type_id == '' || notification_type_id == null){
        alert('Please select SMS type :)');
        return;
    }

    $(el).attr("disabled", true);
    axios.post(jsUtlt.siteUrl('/sms-notification/send'), {'phone':phone, 'msg' : msg, 'type': msg_type, 'notification_type_id': notification_type_id})
    .then(function(response){
        if(response.data === true){
            alert('Send successfully');
            location.reload();
        }
        else{
            alert('something went wrong');
            $(el).removeAttr('disabled');
        }
    }).catch(function(response){
        alert('something went wrong');
        $(el).removeAttr('disabled');
    });
}

function refresh_datatable(){
   if(dTable != null){
      dTable.clear();
      dTable.destroy();
      dTable = null;
  }
}
</script>
@endsection


<!-- <script type="text/javascript">
    
    $(document).ready(function(){
     $('#session').change(function(){
       var session=$('#session').val();
       
                 $.ajax({

            
              url:'test' ,
              type: "POST",
          
              data: {

                'session': session
           

            },
            success: function(data) {
              
               // $('#msg').html("Updaated");
                console.log(data);
                
               
          },
          error:function(){
              alert('Error');
          }

      });

     }) 
      

    })

    
</script> -->