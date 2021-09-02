@section('heading')
    Generate Blank Result Page
@endsection

@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">  
            <div class="row">
                <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Subject Name</th>
                        <th scope="col">Subject Teacher</th>
                        <th scope="col" class=" text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $i=1;
                    @endphp
                   
                    @foreach($sectionSubjectTeacher as $ssr)
                        <tr>
                        <th scope="row">{{ $i }}</th>
                        <td>{{$ssr->subject->subject_name}}</td>
                        <td>{{$ssr->teacher->teacher_name}}</td>
                        <td class=" text-center">
                            
                            {!! Form::open(['method' => 'POST', 'url' => '/blank_result/pdf']) !!}
                            {!! Form::hidden('subject_id', $ssr->subject->id  , ['class'=> '']) !!}
                            {!! Form::hidden('term_id', $term_id, ['class'=> '']) !!}
                            {!! Form::hidden('session_id', $session_id, ['class'=> '']) !!}
                            {!! Form::hidden('section_id', $section_id  , ['class'=> '']) !!}
                            {!! Form::hidden('level_id', $level_id, ['class'=> '']) !!}        
                            {!! Form::submit('Dowonload PDF', array('class'=> 'btn')) !!}
                            {{ Form::close() }}
                        </td>
                            
                        </tr>
                        @php
                        $i++;
                        @endphp
                    @endforeach

                   

                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
@endsection
