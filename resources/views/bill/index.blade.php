<x-vertical-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Rechnungen') }}
        </h2>
    </x-slot>
    <x-slot name="headerbutton">
        <a href="{{ route('bills.create') }}">Neue Rechnung</a>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl p-5">
                <livewire:bill.index-table/>
            </div>
        </div>
    </div>
</x-vertical-layout>
