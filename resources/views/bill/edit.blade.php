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
                        <p>{{ $settings['company_name'] ?? '' }}</p>
                        <p class="mb-5">{{ $settings['address'] ?? '' }}</p>
                        <p>{{ $settings['contactperson'] ?? '' }}</p>
                        <p>{{ $settings['contactemail'] ?? '' }}</p>
                        <p class="mb-5">{{ $settings['contactphone'] ?? '' }}</p>
                        <p class="">{{ $settings['uid'] ?? '' }}</p>
                        <div class="flex">
                            <livewire:bill-date-field :bill="$bill"/>
                        </div>
                    </div>
                </div>
                <div class="-mt-24">
                    <p class="text-xs">Abs: {{ $settings['company_name'] }}, {{ $settings['address'] }}</p>
                    {!! $bill->customer->getAddressHtml() !!}

                    <div class="mt-24">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-10">
                            @if($bill->is_storno_of)
                                {{ __('Stornorechung') }}
                            @else
                                {{ __('Rechung') }}
                            @endif
                            {{ $bill->prefix }} {{ $bill->bill_number }}
                            @if($bill->is_storno_of)
                                {{ $bill->is_storno_of->prefix }} {{ $bill->is_storno_of->bill_number }}
                            @endif
                        </h2>
                        {!! $settings['headertext']  !!}
                    </div>
                </div>
                <livewire:add-bill-position :bill="$bill">
                <hr>
                <livewire:bill-summ :bill="$bill"/>
                <hr class="mt-24">
                {!! $settings['footertext'] !!}
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
                    <form action="{{ route('bills.update', $bill) }}" method="post">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                                class="button-primary"
                                :class="{ 'bg-opacity-50 cursor-not-allowed' : show == false }"
                        >speichern
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
