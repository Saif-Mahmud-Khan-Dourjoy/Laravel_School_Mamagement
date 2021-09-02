<div class="row">
    <div class="col-md-4">
        <input type="hidden" name="ec_id" id="ec_id" value="{{isset($expectedCollection->id) ? $expectedCollection->id : ''}}">
        <div class="form-group">
            <label for="fiscal_year_id">Fiscal Year</label><span class="text-danger">&#9733;</span>
            <select class="form-control" name="fiscal_year_id" id="fiscal_year">
                <option value="" selected disabled>Select Year</option>
                @foreach($fiscal_years as $fiscal_year)
                    <option value="{{$fiscal_year->id}}"
                        @if(isset($expectedCollection->id))
                            @if($expectedCollection->fiscal_year_id == $fiscal_year->id)
                                selected
                            @endif
                        @endif
                        >{{$fiscal_year->year}}</option>
                @endforeach
            </select>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="business_month_id">Business Month</label> <small>*select year first</small>
            <select class="form-control" name="business_month_id" id="business_month">  
             
            </select>
            <span class="help-block"></span>
         </div>
    </div>
    <!-- <div class="col-md-4">
        <div class="form-group">
            <label for="amount">Amount</label><span class="text-danger">&#9733;</span>
            <input type="number" class="form-control"  step="any" name="amount" id="amount" placeholder="Expected collection amount" @if(isset($expectedCollection->id)) value="{{$expectedCollection->amount}}" @endif>
            <span class="help-block"></span>
         </div>
    </div> -->
    <div class="col-md-4">
        <div class="form-group">
            <label for="amount">Amount</label><span class="text-danger">&#9733;</span>
            <input type="number" class="form-control"  step="any" name="amount" id="amount" placeholder="Expected collection amount" @if(isset($expectedCollection->id)) value="{{$expectedCollection->amount}}" @endif>
            <span class="help-block"></span>
         </div>
    </div>
</div>
