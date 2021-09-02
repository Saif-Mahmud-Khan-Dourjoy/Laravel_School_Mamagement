@section('heading')
    Student Statistics
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <div class="row text-center">
            <div class="col-md-10 col-md-offset-3 text-center">
        <div style="width:50%; border: 3px solid #555;"  class="row p-4 bg-light">
                {!! Form::open(['method' => 'GET', 'url' => '/student-Statistics-pdf']) !!}

                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <label for="session">Choose Session</label>
                            <select name="session_id" id="session">
                                @foreach($sessions as $session)
                                    <option value= @php echo $session->id;@endphp>{{ $session->name }}</option>
                                @endforeach   
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="text-center">
                            {!! Form::submit('Submit', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                            {!! link_to(URL::previous(), 'Cancel', ['class' => 'btn btn-default btn-fill btn-wd']) !!}
                        </div>
                    </div>


                {!! Form::close() !!}
            </div>
            
            </div>
        </div>
    </div>
@endsection
