<div wire:poll.10s="pullMessage"
     x-data="{ show: @entangle('show') }"
     x-init="
           setTimeout(() => {
                $wire.pullMessage();
           }, 500);

           $watch('show', is_shown => {
                if(is_shown){
                  setTimeout(()=> $wire.set('show', false), 8000)
                }

           });

        ">
    <div x-cloak class="{{ $type == 'success' ? 'bg-logo-light' : 'bg-red-400' }} text-white w-full absolute shadow-inner" style="z-index: -1"
         x-show="show"
         x-cloak
         x-transition:enter="transition duration-700 transform ease-in-out"
         x-transition:enter-start="scale-y-0 opacity-0 -translate-y-full"
         x-transition:leave="transition duration-500 transform ease-in-out"
         x-transition:leave-end="scale-y-0 -translate-y-full">
        <div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between">
            <p>{{ $message }}</p>
            <svg class="w-6 h-6 text-white" wire:click="$set( 'show', false )" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>
    </div>
</div>

