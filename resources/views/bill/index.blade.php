<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kunden') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">

                <h1>Alle Rechungen</h1>
                <div class="flex justify-end mb-10">
                    <a href="{{ route('bills.create') }}" class="py-2 px-4 bg-green-300 text-white hover:bg-green-800">Neue Rechnung</a>
                </div>

                <table class="table-auto w-full">
                    <thead>
                    <tr>
                        <th class="px-2 py-2 text-left">Empfänger</th>
                        <th class="px-2 py-2 text-left">Erzeugt</th>
                        <th class="px-2 py-2 text-left">Rechungsdatum</th>
                        <th class="px-2 py-2 text-left">Gesendet</th>
                        <th class="px-2 py-2 text-left">Aktionen</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse( $bills as $bill )
                        <tr>
                            <td class="border px-2 py-2">{{ $bill->customer->first_name }} {{ $bill->customer->last_name }}</td>
                            <td class="border px-2 py-2">{{ $bill->generated_at }}</td>
                            <td class="border px-2 py-2">{{ $bill->billing_date }}</td>
                            <td class="border px-2 py-2">{{ $bill->sent_at }}</td>
                            <td class="border px-2 py-2" align="right">
                                <div class="flex space-x-2 justify-end">
                                    @if($bill->generated_at == null)
                                        <a href="{{ route('bills.edit', $bill) }}" class="p-2 bg-green-300 text-white text-center leading-normal inline rounded">
                                            <svg class="w-6 h-6 inline" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                            </svg>
                                        </a>
                                        <a class="p-2 ml-2 bg-red-300 text-white text-center leading-normal inline rounded" onclick="document.getElementById('delete-{{ $bill->id }}').submit()">
                                            <svg class="w-6 h-6 inline" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('bills.destroy', $bill ) }}" method="post" id="delete-{{ $bill->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @else
                                        <a href="{{ route('bills.show', $bill) }}" class="p-2 bg-green-300 text-white text-center leading-normal inline rounded">
                                            <svg class="w-6 h-6 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                    @endif

                                    @if($bill->sent_at !== null)
                                        <a href="#" class="p-2 bg-green-300 text-white text-center leading-normal inline rounded">
                                            <svg class="w-6 h-6 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 15.536c-1.171 1.952-3.07 1.952-4.242 0-1.172-1.953-1.172-5.119 0-7.072 1.171-1.952 3.07-1.952 4.242 0M8 10.5h4m-4 3h4m9-1.5a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border px-4 py-2" colspan="5">Keine Rechnungen gefunden.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</x-app-layout>
