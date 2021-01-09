<div>
    @if($pdf)
        <a href="{{ route('bills.send', $bill) }}" class="button-primary block">jetzt senden</a>
    @else
        <div wire:poll.5s="checkPdf">
            <button disabled class="button-primary">warte auf pdf</button>
        </div>
    @endif
</div>
