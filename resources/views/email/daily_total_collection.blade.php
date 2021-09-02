@component('mail::message')
# Daily Fees Collection

Date: {{date('D M j Y')}}
@php
    $branch_id = NULL;
    $total_amount = 0;
@endphp
@forelse($details as $collection)
@php  
$total_amount += $collection['total_collected'];
if($branch_id != $collection['branch_id']){
    echo '<h4 style="padding:5px 0px; margin:0px">Branch Name: '.$collection['branch_name'].'</h4><hr>';
    $branch_id = $collection['branch_id'];
}
@endphp
<strong>Collector Name:</strong> {{$collection['collector']}}
<br>
<strong>Total Amount:</strong> {{$collection['total_collected']}}
<br>
<br>
    
@empty
<strong>Collected Amount:</strong> 0 TK
@endforelse
<br>
<strong>Total Collected Amount:</strong> {{$total_amount}} TK
<br>
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent