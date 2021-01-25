<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Rechnungen') }}
        </h2>
    </x-slot>
    <x-slot name="headerbutton">
        <livewire:bill.new-bill-modal/>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <livewire:bill.index-table/>
            </div>
        </div>
    </div>
</x-app-layout>
