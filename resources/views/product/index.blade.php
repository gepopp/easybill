<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produkte') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">

                <h1>Alle Produkte</h1>
                <div class="flex justify-end mb-10">
                    <a href="{{ route('products.create') }}" class="py-2 px-4 bg-green-300 text-white hover:bg-green-800">Neues Produkt</a>
                </div>

                <table class="table-auto w-full">
                    <thead>
                    <tr>
                        <th class="px-2 py-2 text-left">Name</th>
                        <th class="px-2 py-2 text-left">Nettopreis</th>
                        <th class="px-2 py-2 text-left">Einheit</th>
                        <th class="px-2 py-2 text-left">Beschreibung</th>
                        <th class="px-2 py-2 text-left">Aktionen</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse( $products as $product )
                        <tr>
                            <td class="border px-2 py-2">{{ $product->name }}</td>
                            <td class="border px-2 py-2">{{ number_format($product->netto, 2, ',', '.') }} €</td>
                            <td class="border px-2 py-2">{{ $product->unit }}</td>
                            <td class="border px-2 py-2">{{ $product->description }}</td>
                            <td class="border px-2 py-2 flex space-x-1" align="right">
                                <a href="{{ route('products.edit', $product) }}" class="p-2 bg-green-300 text-white text-center leading-normal inline rounded">
                                    <svg class="w-6 h-6 inline" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </a>
                                <a class="p-2 ml-2 bg-red-300 text-white text-center leading-normal inline rounded" onclick="document.getElementById('delete-{{ $product->id }}').submit()">
                                    <svg class="w-6 h-6 inline" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('products.destroy', $product ) }}" method="post" id="delete-{{ $product->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border px-4 py-2" colspan="5">Keine Produkte gefunden.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

