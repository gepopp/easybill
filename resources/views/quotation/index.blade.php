<x-vertical-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Angebote') }}
        </h2>
    </x-slot>
    <x-slot name="headerbutton">
        <a href="{{ route('quotation.create') }}">Neues Angebot</a>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl p-5">
            </div>
        </div>
    </div>
</x-vertical-layout>
