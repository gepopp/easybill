<x-vertical-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Neuer Kunde') }}
        </h2>
    </x-slot>
    <x-slot name="headerbutton">
        <button wire:click="button" onclick="document.getElementById('customer-form').submit()" class="button-secondary">speichern</button>
    </x-slot>

    {{ dump($errors) }}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl p-5">
                <form action="{{ route('customers.store') }}" class="w-full" method="post" id="customer-form">
                    @csrf
                    <div class="grid grid-cols-2 gap-10">
                        <div>
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="address_addition">Kontaktart</label>
                            <livewire:customer.type-selector/>
                        </div>
                        <div>
                            <x-input label="Adresse" name="address" value="{{ old('address') }}"/>
                            <x-input label="ADRESSZUSATZ" name="address_addition" value="{{ old('address_addition') }}"/>

                            <div class="grid grid-cols-4 gap-4 mb-6">
                                <div>
                                    <x-input label="Plz" name="zip" type="number" value="{{ old('zip') }}"/>
                                </div>
                                <div class="col-span-3">
                                    <x-input label="Ort" name="city" value="{{ old('city') }}"/>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-10">
                        <div>
                            <x-input label="E-Mail Adresse" name="email" value="{{ old('email') }}"/>
                        </div>
                        <div>
                            <x-input label="Telefonnummer" name="phone" value="{{ old('phone') }}"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-vertical-layout>

