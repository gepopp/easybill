<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rechung bearbeiten') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 px-20">

                <a href="{{ $bill->getPDF() }}" class="p-3 px-5 text-center text-white font-semibold shadow-lg bg-red-800 inline-block" target="_blank">
                    <span class="flex space-x-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <p>PDF</p>
                    </span>
                </a>

                <div class="flex flex-col items-end">
                    <img src="{{ Storage::temporaryUrl($settings['logo'], now()->addMinutes(5)) }}">
                    <div class="mt-12 p-10">
                        <p>{{ $settings['company_name'] }}</p>
                        <p class="mb-5">{{ $settings['address'] }}</p>
                        <p>{{ $settings['contactperson'] }}</p>
                        <p>{{ $settings['contactemail'] }}</p>
                        <p class="mb-5">{{ $settings['contactphone'] }}</p>
                        <p class="">{{ $settings['uid'] }}</p>
                        <p class="">Rechnungsdatum: {{ \Carbon\Carbon::parse($bill->billing_date)->format('d.m.Y') }}</p>
                        <p class="">Fälling am: {{ \Carbon\Carbon::parse($bill->billing_date)->addDays($settings['desired_respite'])->format('d.m.Y') }}</p>
                    </div>
                </div>
                <div class="-mt-24">
                    <p class="text-xs">Abs: {{ $settings['company_name'] }}, {{ $settings['address'] }}</p>
                    {!! $bill->customer->getAddressHtml() !!}

                    <div class="mt-24">
                        <p class="font-bold text-xl">Rechnung: {{ $settings['prefix'] ?? '' }} {{ $bill->bill_number }} </p>
                        <p> {{$settings['headertext']}} </p>
                    </div>
                </div>

                <table class="table-fixed w-full mt-10">
                    <thead class="border-b">
                    <tr>
                        <th class="text-left w-1/12 pr-2">#</th>
                        <th class="text-left w-4/12 pr-2">Bezeichnung</th>
                        <th class="text-center w-1/12 pr-2">Menge</th>
                        <th class="text-center w-1/12 pr-2">Einheit</th>
                        <th class="text-right w-1/12 pr-2">Einzelpreis</th>
                        <th class="text-right w-2/12 pr-2">Gesamt</th>
                        <th class="text-right w-1/12 pr-2">MwSt.</th>
                        <th class="text-right w-1/12">Brutto</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $bill->positions as $position )
                        <tr class="hover:bg-gray-50 py-3">
                            <td class="py-2 pr-2" valign="top">{{ $position->order_number }} </td>
                            <td class="py-2 pr-2">{{ $position->name }}</td>
                            <td class="py-2 pr-2 text-center">{{ $position->amount }}</td>
                            <td class="py-2 pr-2 text-center">{{ $position->unit }}</td>
                            <td class="py-2 pr-2 text-right">{{ number_format($position->netto, 2,',','.') }} €</td>
                            <td class="py-2 pr-2" align="right">{{ number_format( ($position->netto * $position->amount), 2,',','.') }} €</td>
                            <td class="py-2 pr-2" align="right">{{ number_format( ( $position->vat ), 0,',','.') }} %</td>
                            <td class="py-2" align="right">{{ number_format(($position->netto * $position->amount ) + ((( $position->netto * $position->amount ) * $position->vat)/100), 2, ',', '.') }} €</td>
                        </tr>
                        <tr class="border-b">
                            <td></td>
                            <td>
                                <p class="text-sm leading-none pb-3">{{ $position->description }}</p>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="flex flex-col items-end py-10">
                    <p class="font-semibold flex justify-between w-1/3">
                        <span>Netto gesamt:</span><span>{{ $bill->nettoTotal  }}</span>
                    </p>
                    <p class="font-semibold flex justify-between w-1/3">
                        <span>MwSt.:</span><span>{{ $bill->vatTotal  }}</span>
                    </p>
                    <p class="font-semibold flex justify-between w-1/3">
                        <span>Rechnungsbetrag:</span><span>{{ $bill->bruttoTotal  }}</span>
                    </p>
                </div>
                <p>{{ $settings['footertext'] }}</p>
                <hr class="">
                <div class="grid grid-cols-3 gap-4 pt-5 pb-20 text-sm">
                    <div>
                        {!! $settings['footercol_1'] !!}
                    </div>
                    <div class="text-center">
                        {!! $settings['footercol_2'] !!}
                    </div>
                    <div class="text-right">
                        {!! $settings['footercol_3'] !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

