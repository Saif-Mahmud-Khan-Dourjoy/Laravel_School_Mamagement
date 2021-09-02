@section('heading')
    Section-wise Fees
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <!-- <div class="panel-heading" style="background-color: #f2f2f2;">
                        <h4 class="title" align="center">Section-wise Fees Setup Form</h4>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li> {{ $error }} </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div> -->

                    <div class="panel-body">
                        <div style="padding-top: 25px;">
                            <!-- {!! Form::open(['method' => 'POST', 'url' => '/section_wise_fees']) !!} -->
                            <form method="POST" action="{{url('/section_wise_fees')}}">
                                @csrf

                            @include('admin.section_wise_fees.form2')

                            <div class="form-group">
                                <div class="text-center">
                                    <input type="submit" class='btn btn-info btn-fill btn-wd' >
                                    <!-- {!! Form::submit('Submit', array('class'=> 'btn btn-info btn-fill btn-wd')) !!} -->
                                    <a href="{{URL::previous()}}" class = 'btn btn-default btn-fill btn-wd'>Cancle</a>
                                   <!--  {!! link_to(URL::previous(), 'Cancel', ['class' => 'btn btn-default btn-fill btn-wd']) !!} -->
                                </div>
                            </div>


                            <!-- {!! Form::close() !!} -->
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
