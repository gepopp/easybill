<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rechung bearbeiten') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 px-20">
                <div class="pt-24 flex justify-between">
                    <x-customer-address :customer="$bill->customer"/>
                    <div>
                        <livewire:bill-date-field :bill="$bill"/>
                    </div>
                </div>
                <div class="mt-24">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-10">{{ __('Rechung') }}
                        <x-billnumber :bill="$bill"/>
                    </h2>
                </div>
                <livewire:add-bill-position :bill="$bill"/>
                <livewire:bill-summ :bill="$bill"/>
                <div class="flex justify-end mt-20"
                     x-data="{ enabled: true }"
                     x-init="
                        Livewire.on('new_row', (event) => {
                            enabled = !event;
                        });
                    ">
                    <form action="{{ route('bill.document', $bill) }}" method="GET">
                        @csrf
                        <button type="submit"
                           class="button-primary"
                           :class="{ 'bg-opacity-50 cursor-not-allowed' : enabled == false }"
                           :disabled="!enabled"
                        >
                            <span class="px-10">speichern</span>
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
