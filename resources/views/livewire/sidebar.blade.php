<div class="min-h-screen bg-logo-darker shadow-xl"
     x-data="{ desktop: true, width: 1025 }"
     x-init="
        window.addEventListener('resize', function(event){
            width = window.innerWidth;
        });
        width = window.innerWidth;

        $watch('width', (w)=> {

            if(w > 1024){
                desktop = true;
            }else{
                desktop = false;
            }
        });
     ">

    <div class="flex justify-end p-3">
        <svg x-cloak class="w-6 h-6 text-logo-gray cursor-pointer" @click="desktop = false" x-show="desktop" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
        </svg>
        <svg x-cloak class="w-6 h-6 text-logo-gray cursor-pointer" @click="desktop = true" x-show="!desktop" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
        </svg>
    </div>


    <div class="flex flex-col relative p-10"
         x-show="desktop"
         x-transition:enter="transition transform"
         x-transition:enter-start="duration-500 scale-y-0"
         x-transition:enter-end="duration-500 scale-y-100"

    >
        <x-jet-nav-link href="{{ route('bills.index') }}" :active="request()->routeIs('bills.*')" class="text-logo-gray mb-5">
            {{ __('Rechnungen') }}
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('customers.index') }}" :active="request()->routeIs('customers.*')" class="text-logo-gray mb-5">
            {{ __('Kunden') }}
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('products.index') }}" :active="request()->routeIs('products.*')" class="text-logo-gray mb-5">
            {{ __('Produkte') }}
        </x-jet-nav-link>
    </div>


    <div x-cloak class="flex flex-col relative p-3"
         x-show="!desktop"
         x-transition:enter="transition transform"
         x-transition:enter-start="duration-500 scale-y-0"
         x-transition:enter-end="duration-500 scale-y-100">
        <x-jet-nav-link href="{{ route('bills.index') }}" :active="request()->routeIs('bills.*')" class="text-logo-gray mb-5">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('customers.index') }}" :active="request()->routeIs('customers.*')" class="text-logo-gray mb-5">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('products.index') }}" :active="request()->routeIs('products.*')" class="text-logo-gray mb-5">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
            </svg>
        </x-jet-nav-link>
    </div>
</div>
