@props([
    'customer'
])

<address>
    @if(!empty($customer->company))
        <strong>{{ $customer->company->company_name }}</strong><br>
    @endif


    {{ $customer->fullname }}<br>
    {{ $customer->address }} {{ $customer->address_addition }}<br>
    {{ $customer->zip }} {{ $customer->city }}
</address>
