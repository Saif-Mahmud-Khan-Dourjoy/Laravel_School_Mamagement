@section('heading')
    Monthly Expected Collection
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="panel panel-default">

                    <div class="panel-heading" style="background-color: #f2f2f2;">
                        <h4 class="title" align="center">Update Monthly Expected Collection Amount</h4>
                    </div>

                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger errorMsg">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li> {{ $error }} </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div style="padding-top: 25px;">
                            {!! Form::open(['method' => 'PUT', 'url' => '/expectedCollections/'.$expectedCollection->id]) !!}
                            
                            @include('admin.expected_collections.form')

                            <div class="form-group">
                                <div class="text-center">
                                    {!! Form::submit('Update', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                     <a type="button" href="{{route('expectedCollections.index')}}" class="btn btn-default btn-fill btn-wd">Cancel</a>
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    window.addEventListener('load', function(){

        var expectedCollection = <?php echo json_encode($expectedCollection);?>;
        var business_months = <?php echo json_encode($business_months); ?>;
        var fiscal_years = <?php echo json_encode($fiscal_years);?>;
        $(document).find('.errorMsg').delay(1000).fadeOut("slow");

         bm_html = '';
            $.each(business_months, function(ind, val){
                if(val.fiscal_year_id == $('#fiscal_year').val()){
                    if(val.id == expectedCollection.business_month_id){
                        bm_html += '<option value="'+val.id+'" selected>'+val.month_name+'</option>';
                    }else{
                        bm_html += '<option value="'+val.id+'">'+val.month_name+'</option>';
                    }
                }
            });
            $('#business_month').html(bm_html); 

        $('#fiscal_year').on('change', function(){
            updateBusinessMonth();
        });

        function updateBusinessMonth(){
            $('#business_month').empty();
            bm_html = '';
            $.each(business_months, function(ind, val){
                if(val.fiscal_year_id == $('#fiscal_year').val()){

                        bm_html += '<option value="'+val.id+'">'+val.month_name+'</option>';
                 
                }
            });
            $('#business_month').html(bm_html);   
        }
    });
</script>
@endsection
