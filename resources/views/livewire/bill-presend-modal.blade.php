<div>

    @if($pdf)
        <button wire:click="$set('show', true)" class="button-secondary block">{{ $btntext ?? 'senden' }}</button>

    @else
        <div wire:poll.5s="checkPdf">
            <button disabled class="button-secondary flex justify-center">
                <span class="px-4">
                    <svg class="animate-spin h-6 w-6 bg-transparent" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </span>
            </button>
        </div>
    @endif


    <x-jet-dialog-modal :maxWidth="'2xl'" wire:model="show">
        <x-slot name="title">
            <div class="flex justify-between">
                <h1 class="text-gray-800">Rechnung senden</h1>
                <div wire:click="$set('show', false)" class="cursor-pointer">
                    <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="text-gray-500">
                <div class="pb-0">
                    <p class="font-semibold">Von:</p>
                    <p class="mb-5">{{ $this->getFrom() }}</p>
                    <p class="font-semibold">Betreff:</p>
                    <p class="mb-5">{{ $this->getSubject() }}</p>
                    <p class="font-semibold">Nachricht:</p>
                </div>
                <iframe src="data:text/html;base64,{!! base64_encode($this->getContent()) !!}" width="100%" height="600px"></iframe>
                <div class="py-4 flex justify-end">
                    <a href="{{ route($route, $bill) }}" class="button-primary">jetzt senden</a>
                </div>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>
