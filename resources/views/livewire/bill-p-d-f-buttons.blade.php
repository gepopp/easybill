<div class="w-full">
    @if(!$isPdf)
        <div>
            <div wire:poll="pollLink">
                @if($link == 'onqueue')
                    <div class="flex flex-col justify-center items-center text-white w-full h-full" disabled>
                        <svg class="animate-spin h-20 w-20 mr-3 bg-transparent" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Warte bis dein PDF an der Reihe ist...
                    </div>
                @endif

                @if($link == 'processing')
                    <div class="flex flex-col justify-center items-center text-white w-full h-full" disabled>
                        <svg class="animate-spin h-20 w-20 mr-3 bg-transparent" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Deine Rechnung wird erzeugt...
                    </div>
                @endif

                @if($link == '')
                    <div class="flex flex-col justify-center items-center text-white w-full h-full" disabled>
                        <svg class="animate-spin h-20 w-20 mr-3 bg-transparent" viewBox="0 0 24 24">
                            <circle class="opacity-25 bg-transparent" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <p>Deine Rechnung wird geladen...</p>
                    </div>
                @endif

                @if($link == 'failed')
                    <div class="flex flex-col justify-center items-center text-white w-full h-full" disabled>
                        <svg class="w-20 h-20 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <p>Uuups, da ist etwas schief gegangen, bitte gehe zurüch und versuche es noch einmal.</p>
                    </div>
                @endif
            </div>
        </div>
    @else
        <div style="min-height: 1000px">
            <object data="{{ $link }}" type="application/pdf" width="100%" height="100%" style="min-height: 1000px"></object>
        </div>
    @endif
</div>
