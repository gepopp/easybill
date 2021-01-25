<tr class="border-b hover:bg-gray-50">
    <td valign="top" class="p-2">
        <div class="w-full h-full flex items-center font-semibold text-logo-primary p-1">
            {{ $row->order_number }}
        </div>
        <input type="hidden" wire:model="row.order_number">
        <input type="hidden" wire:model="row.id">
    </td>
    <td class="p-2">
        <div class="relative" x-data="{ highlight : 0, products : {{ $this->searchProducts() }} }" x-init="$watch('products', (products) => console.log(products))">
            <input type="text"
                   class="@error('row.name') border-red-800 @else border-logo-primary @enderror appearance-none border rounded-xl p-1 px-3 bg-logo-gray text-gray-600 focus:outline-none w-full"
                   wire:model="row.name"
                   wire:keydown="searchProducts"
                   x-on:keydown.arrow-down="highlight = Math.min(products.length - 1, highlight + 1); console.log(highlight)"
                   x-on:keydown.arrow-up="highlight = Math.max( 0, highlight - 1); console.log(highlight)"
                   x-on:keydown.enter="
                       $wire.fillIn(highlight);
                   "
            >
            <div class="absolute top-0 left-0 mt-16 p-5 shadow-lg bg-white w-full" x-show="products.length > 0">
                <ul>
                    <template x-for="(item, index) in products" x-key="item.id">
                        <li class="py-3 hover:bg-gray-50 cursor-pointer list-none"
                            x-on:click="
                               $wire.fillIn(index);
                            "
                            :class="{'bg-gray-50': index == highlight }">
                            <p class="text-sm font-bold" x-text="item.name"></p>
                        </li>
                    </template>
                </ul>
            </div>
        </div>

    </td>
    <td class="p-2">
        <input
            type="number"
            class="@error('row.amount') border-red-800 @else border-logo-primary @enderror appearance-none border rounded-xl p-1 px-3 bg-logo-gray text-gray-600 focus:outline-none w-full"
            wire:model.lazy="row.amount"
            pattern="[0-9]+([,\.][0-9]+)?">
    </td>
    <td class="p-2">
        <select type="text"
               class="appearance-none @error('row.unit') border-red-800 @else border-logo-primary @enderror border rounded-xl p-1 px-3 bg-logo-gray text-gray-600 focus:outline-none w-full"
               wire:model="row.unit">
            <option value="Stück">Stück</option>
            <option value="Stunden">Stunden</option>
            <option value="Pauschal">Pauschal</option>
            <option value="Kg">Kg</option>
        </select>
    </td>
    <td class="p-2">
        <input type="number"
               class="appearance-none @error('row.netto') border-red-800 @else border-logo-primary @enderror  border rounded-xl p-1 px-3 bg-logo-gray text-gray-600 focus:outline-none w-full"
               wire:model.lazy="row.netto"
               pattern="[0-9]+([,\.][0-9]+)?">
    </td>
    <td align="right" class="p-2">
        <input type="text"
               class="appearance-none border-logo-primary border rounded-xl p-1 px-3 bg-logo-gray text-gray-600 focus:outline-none w-full text-right"
               disabled="disabled"/>
    </td>
    <td align="right" class="p-2">
        <input type="number"
               class="appearance-none @error('row.vat') border-red-800 @else border-logo-primary @enderror border rounded-xl p-1 px-3 bg-logo-gray text-gray-600 focus:outline-none w-full"
               wire:model.lazy="row.vat">
    </td>

    <td align="right" class="p-2">
        <input type="text"
               class="appearance-none border-logo-primary border rounded-xl p-1 px-3 bg-logo-gray text-gray-600 focus:outline-none w-full text-right"
               disabled="disabled"/>
    </td>
    <td align="right" valign="top" class="p-2">
        <svg class="w-4 h-4 mt-3 text-gray-500 cursor-pointer" wire:click="$emit('unsetNewRow')" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
        </svg>
    </td>
</tr>
