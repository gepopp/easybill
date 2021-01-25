<div>
    <button type="button" wire:click="showModal" class="button-secondary">Neue Rechnung erstellen</button>
    <x-jet-dialog-modal :id="'tester'" :maxWidth="'2xl'" wire:model="show">
        <x-slot name="title">
            <div class="flex justify-between">
                <h1 class="text-logo-primary">Neue Rechnung</h1>
                <div class="flex justify-between">
                    <div wire:click="$set('show', false)" class="cursor-pointer">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="content">
            <form wire:submit.prevent="createBill">
                <x-input name="billing_date" type="date" label="Rechnungsdatum" inputalign="text-left"/>
                <x-input name="bill_number" type="number" label="Rechnungsnummer" prefix="{{ $prefix }}" step="1" disabled="disabled"/>
                <x-input name="respite" type="number" label="Zahlungsziel" step="1"/>

                <div class="flex justify-between items-center mb-4">
                    <label for="customer_id" class="font-semibold text-gray-600">Kunde</label>
                    <div>
                        <livewire:customer-select/>
                        @error('customer_id')
                        <p class="text-sm leading-none text-red-800 px-3 py-2 w-64">{{ $message }}</p>@enderror
                    </div>
                    <input type="hidden"
                           step="1"
                           id="customer_id"
                           class="w-64 appearance-none border-logo-primary border rounded-xl p-1 px-3 bg-logo-gray text-gray-600 text-right focus:outline-none"
                           wire:model="customer_id"
                    >
                </div>
                <div class="flex justify-end">
                    <button class="button-primary px-5" type="submit">
                        <span class="px-3">
                            speichern
                        </span>
                    </button>
                </div>
            </form>
        </x-slot>
    </x-jet-dialog-modal>
</div>
