@section('heading')
Collected Fees
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            @if($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {!! $message !!}
                </div>
                </div>
            @endif
        </div>
        <div class="col-md-6 col-md-offset-2">
            
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #f2f2f2;">
                    <h4 class="title" align="center">Fees Collection Information Form</h4>
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            <!-- @foreach ($errors->all() as $error)
                            <li> {{ $error }} </li>
                            @endforeach -->
                            @error('session_id')
                                <li>The session field is requred. </li>
                            @enderror
                            @error('section_id')
                                <li>The section field is requred. </li>
                            @enderror
                            @error('level_id')
                                <li>The class field is requred. </li>
                            @enderror
                            @error('business_month_id')
                                <li>The month field is requred. </li>
                            @enderror
                            @error('student_id')
                                <li>The student field is requred. </li>
                            @enderror
                        </ul>
                    </div>
                    @endif
                </div>

                <div class="panel-body">
                    <div style="padding-top: 25px;">
                        <!-- {!! Form::open(['method' => 'post', 'url' => '/collected_fee/calculate', 'class'=> 'validateForm']) !!} -->
                        <form method="POST" action="{{url('/collected_fee/calculate')}}">
                        @csrf

                        @include('admin.collected_fees.form3')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="pull-left">
                                        <button type="button" class="btn btn-default" id="fc_cancel_btn">Cancel</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="pull-right">
                                        <!-- {!! Form::submit('Next', array('class'=> 'form-submit btn btn-info')) !!} -->
                                         <input type="submit" class='btn btn-info btn-fill btn-wd' >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- {!! Form::close() !!} -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $(".validateForm").validate({
            submitHandler: function(form) {
                $('.form-submit').attr('disabled','disabled');
                form.submit();
            }
        });
        $('#fc_cancel_btn').click(function(){
            window.location.replace(jsUtlt.siteUrl("/collected_fees"));
        });
    });
</script>
@endpush


