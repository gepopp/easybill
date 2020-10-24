<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kunden') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">

                <h1>Alle Kunden</h1>
                <div class="flex justify-end mb-10">
                    <a href="{{ route('customers.create') }}" class="py-2 px-4 bg-green-300 text-white hover:bg-green-800">Neuer Kunde</a>
                </div>

                <table class="table-auto w-full">
                    <thead>
                    <tr>
                        <th class="px-4 py-2 text-left">Unternehmen</th>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">E-Mail</th>
                        <th class="px-4 py-2 text-left">Aktionen</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($customers as $customer)
                    @empty
                    <tr>
                        <td class="border px-4 py-2" colspan="4">Keine Kunden gefunden.</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</x-app-layout>
