<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rechnungen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="flex justify-between mb-10">
                    <h1 class="inline">Alle Rechungen</h1>
                    <livewire:new-bill-modal/>
                </div>
                <livewire:bill-index-table :bills="$bills"/>
            </div>
        </div>
    </div>
</x-app-layout>
