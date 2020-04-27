@component('mail::message')
# Welcome to VacayHome Hotel

@foreach($data as $value)
    + Check In : {{ $value['time_from'] }}
    + Check Out : {{ $value['time_from'] }}
    + Room : {{ $value['room_name'] }}
    + Money : {{ number_format($value['price']) }}
    ==============================================
@endforeach


Thanks,<br>
{{ config('app.name') }}
@endcomponent
