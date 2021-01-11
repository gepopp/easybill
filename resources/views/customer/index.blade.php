<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Deine Kunden
        </h2>
    </x-slot>
    <x-slot name="headerbutton">
        <div class="flex space-x-2">

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <livewire:customer-index-page/>
            </div>
        </div>
    </div>
</x-app-layout>
