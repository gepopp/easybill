<x-vertical-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-white">
            Kunden
        </h2>
    </x-slot>
    <x-slot name="headerbutton">
        <div class="flex space-x-2">
            <a href="{{ route('customers.create') }}" class="button-secondary">Neuer Kunde</a>
        </div>
    </x-slot>

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">--}}
{{--                <table class="w-full table-auto text-gray-800">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 tracking-wider">Nr.</th>--}}
{{--                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 tracking-wider">Empfänger</th>--}}
{{--                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 tracking-wider text-right">Netto</th>--}}
{{--                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 tracking-wider text-right">Brutto</th>--}}
{{--                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 tracking-wider text-right">Bezahlt</th>--}}
{{--                        <th class="px-6 py-3 border-b-2 border-gray-300 text-center leading-4 tracking-wider">Status</th>--}}
{{--                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 tracking-wider text-right">Datum</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @forelse( $bills as $bill )--}}
{{--                        <tr class="hover:bg-logo-gray">--}}
{{--                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">--}}
{{--                                <a href="{{ route('bills.show', $bill) }}">--}}
{{--                                    <p class="underline"> {{$bill->prefix}}{{ $bill->bill_number }}</p>--}}
{{--                                    @if($bill->is_storno_of)--}}
{{--                                        <p class="text-xs text-red-800">Storno von {{ $bill->is_storno_of->prefix }}{{ $bill->is_storno_of->bill_number }}</p>--}}
{{--                                    @elseif($bill->has_storno)--}}
{{--                                        <p class="text-xs text-red-800">Storniert mit {{ $bill->has_storno->prefix }}{{ $bill->has_storno->bill_number }}</p>--}}
{{--                                    @endif--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforelse--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</x-vertical-layout>
