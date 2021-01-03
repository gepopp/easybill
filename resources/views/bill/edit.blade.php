<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rechung bearbeiten') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 px-20">
                <div class="flex flex-col items-end">
                    <img src="{{ Storage::temporaryUrl($settings['logo'], now()->addMinutes(5)) }}">
                    <div class="mt-12 p-10">
                        <p>{{ $settings['company_name'] }}</p>
                        <p class="mb-5">{{ $settings['address'] }}</p>
                        <p>{{ $settings['contactperson'] }}</p>
                        <p>{{ $settings['contactemail'] }}</p>
                        <p class="mb-5">{{ $settings['contactphone'] }}</p>
                        <p class="">{{ $settings['uid'] }}</p>
                        <div class="flex">

                            <span class="mr-1">Rechnungsdatum:</span>
                            <livewire:bill-date-field :bill="$bill"/>
                        </div>
                        <p class="">Fälling am: {{ \Carbon\Carbon::parse($bill->billing_date)->addDays($settings['desired_respite'])->format('d.m.Y') }}</p>

                    </div>
                </div>
                <div class="-mt-24">
                    <p class="text-xs">Abs: {{ $settings['company_name'] }}, {{ $settings['address'] }}</p>
                    {!! $bill->customer->getAddressHtml() !!}

                    <div class="mt-24">
                        <p class="font-bold text-xl">Rechnung: {{ $settings['prefix'] ?? '' }} {{ $bill->bill_number }} </p>
                        {{  $settings['headertext']  }}
                    </div>
                </div>

                <livewire:add-bill-position :bill="$bill">

                    <hr class="">

                    <livewire:bill-summ :bill="$bill"/>

                    <hr class="mt-24">
                    {{ $settings['footertext'] }}
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
                    <div class="flex justify-end"
                        x-data="{ show: true }"
                        x-init="
                            Livewire.on('new_row', (event) => {
                                show = !event;
                            });
                            $watch('show', (value)=>{ console.log(value) })
                        ">
                        <a :href="!show ? 'javascript:void(0)': '{{ route('bills.show', $bill) }}'"
                                x-bind:disabled="show"
                                class="bg-red-800 p-3 text-white text-center font-semibold"
                                :class="{ 'bg-opacity-50 cursor-not-allowed' : show == false }"
                        >
                            Rechnung erzeugen
                        </a>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
