@component('mail::message')
    # Introduction

    Your payment card {{ $data['card_number'] . ' '. $data['cvv']}} was successful added.

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
