@component('mail::message')
Hi,

{{ "From ".$data['start_date']." to ".$data['end_date'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
