<div>
    <form wire:submit.prevent="createBill">
        <x-input name="billing_date" type="date" label="Rechnungsdatum" inputalign="text-left"/>
        <x-input name="bill_number" type="number" label="Rechnungsnummer" prefix="{{ $prefix }}" step="1"/>
        <x-input name="respite" type="number" label="Zahlungsziel" step="1"/>

        <div class="flex justify-between items-center mb-4">
            <label for="customer_id" class="font-semibold text-gray-600">Kunde</label>
            <div>
                <livewire:customer-select/>
                @error('customer_id')<p class="text-sm leading-none text-red-800 px-3 py-2 w-64">{{ $message }}</p>@enderror
            </div>
            <input type="hidden"
                   step="1"
                   id="customer_id"
                   class="w-64 appearance-none border-logo-primary border rounded-xl p-1 px-3 bg-logo-gray text-gray-600 text-right focus:outline-none"
                   wire:model="customer_id"
            >
        </div>
        <button class="button-primary" type="submit">Posten hinzufügen</button>
    </form>
</div>
