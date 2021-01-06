<div>
    <form wire:submit.prevent="createBill">
        <div class="flex justify-between items-center mb-4">
            <label for="billing_date" class="font-semibold text-gray-600">Rechnungsdatum</label>
            <div>
                <input type="date"
                       id="billing_date"
                       class="w-64 appearance-none border-logo-primary border rounded-xl p-1 px-3 bg-logo-gray text-gray-600 focus:outline-none"
                       wire:model="billing_date"
                >
                @error('billing_date')<p class="text-sm leading-none text-red-800 px-3 py-2 w-64">{{ $message }}</p>@enderror

            </div>
        </div>
        <div class="flex justify-between items-center mb-4">
            <label for="bill_number" class="font-semibold text-gray-600">Rechnungsnummer</label>
            <div class="relative">
                <span class="absolute top-0 left-0 pl-3 pt-1 text-gray-600">{{ $prefix }}</span>
                <input type="number"
                       step="1"
                       id="bill_number"
                       class="w-64 appearance-none border-logo-primary border rounded-xl p-1 px-3 bg-logo-gray text-gray-600 text-right focus:outline-none"
                       wire:model="bill_number"
                >
                @error('bill_number')<p class="text-sm leading-none text-red-800 px-3 py-2 w-64">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="flex justify-between items-center mb-4">
            <label for="respite" class="font-semibold text-gray-600">Zahlungsziel</label>
            <div>
                <input type="number"
                       step="1"
                       id="respite"
                       class="w-64 appearance-none border-logo-primary border rounded-xl p-1 px-3 bg-logo-gray text-gray-600 text-right focus:outline-none"
                       wire:model="respite"
                >
                @error('respite')<p class="text-sm leading-none text-red-800 px-3 py-2 w-64">{{ $message }}</p>@enderror
            </div>
        </div>
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
