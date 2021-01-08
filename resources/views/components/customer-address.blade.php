@props([
    'customer'
])

<address>
    <strong>{{ $customer->company_name }}</strong><br>
    {{ $customer->academic_degree }} {{ $customer->first_name }} {{ $customer->last_name }}<br>
    {{ $customer->address }} {{ $customer->address_addition }}<br>
    {{ $customer->zip }} {{ $customer->city }}
</address>
