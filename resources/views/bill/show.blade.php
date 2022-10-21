<x-vertical-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            @if($bill->is_storno_of )
                {{ __('Stornorechnung') }}
            @else
                {{ __('Rechnung') }}
            @endif
            {{ $bill->prefix }} {{ $bill->bill_number }}
        </h2>
    </x-slot>
    <x-slot name="headerbutton">
        <div class="flex space-x-2">
            @if($bill->sent_at == null && !$bill->is_storno_of && !$bill->has_storno )
                <a href="{{ route('bills.edit', $bill) }}" class="button-secondary">bearbeiten</a>
            @endif

            @if($bill->sent_at == null)
                <livewire:bill.send-modal :bill="$bill" route="bills.send" notifyclass="App\Notifications\SendBillNotification"/>
            @endif
            @if(!$bill->has_storno && !$bill->is_storno_of && $bill->sent_at == null)
                <a onclick="document.getElementById('delete-{{ $bill->id }}').submit()" class="button-secondary cursor-pointer">löschen</a>
                <form action="{{ route('bills.destroy', $bill ) }}" method="post" id="delete-{{ $bill->id }}" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            @endif
            @if(!$bill->is_storno_of)
                <a href="{{ route('bills.duplicate', $bill) }}" class="button-secondary">duplizieren</a>
            @endif
            @if(!$bill->has_storno && !$bill->is_storno_of && $bill->paid() == 0 && $bill->sent_at != null)
                <a href="{{ route('bills.storno', $bill) }}" class="button-secondary">stornieren</a>
            @endif
            @if($bill->sent_at != null && $bill->paid() < $bill->total('brutto') && !$bill->has_storno && !$bill->is_storno_of)
                <livewire:bill.add-bill-payment-modal :bill="$bill"/>
            @endif
            @if(\Carbon\Carbon::parse($bill->billing_date)->addDays($bill->respite + 1 )->isPast() && $bill->sent_at != null)
                <livewire:bill.reminder-modal :bill="$bill" notifyclass="App\Notifications\BillReminderNotification" btntext="Zahlungserinnerung"/>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                <div class="grid grid-cols-6 gap-10">
                    <div class="col-span-4 flex items-center justify-center" style="background-color: rgb(82, 86, 89); min-height: 1000px">
                        <livewire:bill.pdf-loader :bill="$bill"/>
                    </div>
                    <div class="p-10 col-span-2">
                        <div class="mb-10">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-between items-center">


                                @if($bill->is_storno_of)
                                    {{ __('Stornorechung') }}
                                @else
                                    {{ __('Rechung') }}
                                @endif
                                <x-billnumber :bill="$bill"/>
                                <span class="w-24">
                                <x-bill-status status="{{ $bill->bill_status }}"/>
                                </span>

                                <a href="{{ route('bills.download', $bill) }}" target="_blank">
                                    <div class="h-10 w-10 rounded-full bg-gray-300 flex justify-center items-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                                        </svg>
                                    </div>
                                </a>

                            </h2>
                            @if($bill->is_storno_of)
                                <p class="text-sm">
                                    Zu Rechnung
                                    <a href="{{ route('bills.show', $bill->is_storno_of) }}" class="underline text-logo-primary">
                                        <x-billnumber :bill="$bill->is_storno_of"/>
                                    </a>
                                </p>
                            @endif
                        </div>

                        <p class="flex justify-between">
                            <strong>Rechnungsdatum:</strong> {{ \Carbon\Carbon::parse($bill->billing_date)->format('d.m.Y') }}
                        </p>
                        <p class="flex justify-between">
                            <strong>Fälig am:</strong> {{ \Carbon\Carbon::parse($bill->billing_date)->addDays($bill->respite)->format('d.m.Y') }}
                        </p>
                        <p class="flex justify-between">
                            <strong>Netto:</strong><span>{{ $bill->total('netto', 'withSymbol') }}</span>
                        </p>
                        <p class="flex justify-between">
                            <strong>MwSt.:</strong><span>{{ $bill->total('vat', 'withSymbol') }}</span>
                        </p>
                        <p class="flex justify-between">
                            <strong>Brutto:</strong><span>{{ $bill->total('brutto', 'withSymbol') }}</span>
                        </p>
                        <address class="mb-10 text-right mt-10">
                            <x-customer-address :customer="$bill->customer"/>
                        </address>
                        <div class="flex flex-col space-y-4 mt-10">
                            @if($bill->has_storno)
                                <p>
                                    Diese Rechnung wurde
                                    <a href="{{ route('bills.show', $bill->has_storno ) }}" class="text-red-800 underline">storniert.</a>
                                </p>
                            @endif
                            @if(!$bill->has_storno && !$bill->is_storno_of && $bill->sent_at !== null )
                                <livewire:bill.payments-list :bill="$bill"/>
                            @endif
                            <livewire:bill.notifications-list :bill="$bill"/>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-vertical-layout>

