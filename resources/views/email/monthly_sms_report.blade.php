@component('mail::message')
# Monthly SMS Report

Month: {{date('F Y')}}
<br>
<br>
@php
    $total = 0;
@endphp
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

</style>
<table  style="width:100% ; font-family: arial, sans-serif; border-collapse: collapse;">
    <tr>
        <th>SL#</th>
        <th>Date</th>
        <th>SMS TYPE</th>
        <th>Total Send</th>
    </tr>
    @foreach ($details as $index => $log)
        <tr>
            <td>{{$index+1}}</td>
            <td>{{\Carbon\Carbon::parse($log->created_at)->format('Y-d-m')}}</td>
            <td>{{$log->notification_type->type_name}}</td>
            <td>@php $total += $log->total_send;  echo $log->total_send; @endphp</td>
        </tr>
    @endforeach
</table>
<h5>{{$total}} total SMS send on {{date('F Y')}} </h5>
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent