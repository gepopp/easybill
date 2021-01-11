<div>
    @if($pdf)
        <a href="{{ route('bills.send', $bill) }}" class="button-primary block">senden</a>
    @else
        <div wire:poll.5s="checkPdf">
            <button disabled class="button-primary flex justify-center">
                <span class="px-4">
                <svg class="animate-spin h-6 w-6 bg-transparent" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                </span>
            </button>
        </div>
    @endif
</div>
