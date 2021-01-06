<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rechung') }} {{ $settings['prefix'] }} {{ $bill->bill_number }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                <div class="grid grid-cols-6 gap-10">
                    <div class="col-span-4 flex items-center justify-center" style="background-color: rgb(82, 86, 89); min-height: 1000px">
                        <livewire:bill-p-d-f-buttons :bill="$bill"/>
                    </div>
                    <div class="p-10 col-span-2">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-10">
                            {{ __('Rechung') }} {{ $settings['prefix'] }} {{ $bill->bill_number }}
                        </h2>
                        <p class="flex justify-between">
                            <strong>Rechnungsdatum:</strong> {{ \Carbon\Carbon::parse($bill->billing_date)->format('d.m.Y') }}
                        </p>
                        <p class="flex justify-between">
                            <strong>Fälig am:</strong> {{ \Carbon\Carbon::parse($bill->billing_date)->addDays($bill->respite)->format('d.m.Y') }}
                        </p>
                        <p class="flex justify-between"><strong>Status:</strong> {!! $bill->formatedStatus !!}
                        </p>
                        <p class="flex justify-between"><strong>Netto:</strong><span>{{ $bill->nettoTotal }} €</span>
                        </p>
                        <p class="flex justify-between"><strong>MwSt.:</strong><span>{{ $bill->vatTotal }} €</span></p>
                        <p class="flex justify-between"><strong>Brutto:</strong><span>{{ $bill->bruttoTotal }} €</span>
                        </p>
                        <address class="p-5 text-white bg-logo-secondary mt-10">
                            {!!  $bill->customer->getAddressHtml() !!}
                        </address>

                        <div class="flex flex-col space-y-4 mt-10">
                            @if($bill->sent_at == null)
                                <a href="{{ route('bill.send', $bill) }}" class="button-primary">jetzt senden</a>
                                <a href="{{ route('bills.edit', $bill) }}" class="button-primary">bearbeiten</a>
                                <a onclick="document.getElementById('delete-{{ $bill->id }}').submit()" class="button-primary cursor-pointer">löschen</a>
                                <form action="{{ route('bills.destroy', $bill ) }}" method="post" id="delete-{{ $bill->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @else
                                <livewire:bill-payments-list :bill="$bill"/>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

