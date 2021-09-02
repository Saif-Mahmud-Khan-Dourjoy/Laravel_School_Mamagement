<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('name','Name of Session') !!}
            {!! Form::text('name', isset($session->name) ? $session->name : null, ['class'=> 'form-control']) !!}

            {!! Form::label('starts_from','Session starts on:') !!}
            {!! Form::date('starts_from', isset($session->starts_from) ? $session->starts_from : null, ['class'=> 'form-control']) !!}

            {!! Form::label('ends_to','Session ends on:') !!}
            {!! Form::date('ends_to', isset($session->ends_to) ? $session->ends_to : null, ['class'=> 'form-control']) !!}

            <div class="form-group">
                @php
                    $fiscal_years = \App\FiscalYear::all();
                 @endphp
                <label for="fiscal_year">Fiscal Year</label>
                <select class="form-control" name="fiscal_year_id" id="fiscal_year">
                    <option>Select Year</option>
                    @foreach($fiscal_years as $fiscal_year)
                    <option value="{{$fiscal_year->id}}"
                        @if(isset($session->fiscal_year_id))
                            @if($fiscal_year->id == $session->fiscal_year_id) 
                                selected
                            @endif
                         @endif>{{$fiscal_year->year}}</option>
                    @endforeach
                </select>
                <span class="help-block"></span>
            </div>
        </div>
    </div>
</div>