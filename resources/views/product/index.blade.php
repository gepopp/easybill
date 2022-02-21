<x-vertical-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Produkte') }}
        </h2>
    </x-slot>
    <x-slot name="headerbutton">
        <a href="{{ route('products.create') }}" class="py-2 px-4 bg-white text-logo-primary">Neues Produkt</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-screen-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <table class="table-auto table-striped w-full text-sm">
                    <thead>
                    <tr>
                        <th class="px-2 py-2 text-left">Bezeichnung</th>
                        <th class="px-2 py-2 text-left">Beschreibung</th>
                        <th class="px-2 py-2 text-left">Nettopreis</th>
                        <th class="px-2 py-2 text-left">Einheit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse( $products as $product )
                        <tr>
                            <td class="px-2 py-2 whitespace-no-wrap underline">
                                <a href="{{ route('products.edit', $product) }}">
                                    {{ $product->name }}
                                </a>
                            </td>
                            <td class="px-2 py-2">{!! $product->description !!}</td>
                            <td class="px-2 py-2">{{ number_format($product->netto, 2, ',', '.') }} €</td>
                            <td class="px-2 py-2">{{ $product->unit }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border px-4 py-2" colspan="5">Keine Produkte gefunden.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <div class="mt-10">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-vertical-layout>

