<div
    x-data="{ timeout : 500, show : false }"
    x-cloak
    x-init="

            setTimeout(() => show = true, 500 )
            countdown = setInterval(() =>{
                if(timeout > 0){
                    timeout--;
                }else{
                    show = false;
                    clearInterval(countdown)
                 }

            }, 1000)
        ">
    @if($message)
        <div x-cloak class="{{ $type == 'success' ? 'bg-logo-light' : 'bg-red-400' }} text-white w-full absolute shadow-inner" style="z-index: -1"
             x-show="show"
             x-transition:enter="transition duration-500 transform ease-in-out"
             x-transition:enter-start="scale-y-0 opacity-0 -translate-y-full"
             x-transition:leave="transition duration-500 transform ease-in-out"
             x-transition:leave-end="scale-y-0 -translate-y-full">
            <div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between">
                <p>{{ $message }}</p>
                <svg class="w-6 h-6 text-white" @click="show = false" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </div>
        </div>
    @endif
</div>
