<div>
    @if($bill->unformatedPaid < round($bill->unformatedBruttoTotal, 2 ) )
        <livewire:add-bill-payment-modal :bill="$bill"/>
    @endif

    <p class="py-3 mt-10 border-b border-logo-primary w-full text-left font-semibold">Zahlungen:</p>
    <ul>
        @forelse($bill->payments as $payment)
            <livewire:bill-payment-list-item :key="$payment->id" :payment="$payment"/>
        @empty
            <li class="flex justify-center px-3 py-5 border-b border-logo-primary">
                Noch keine Zahlung erfasst.
            </li>
        @endforelse
    </ul>
</div>
