<tr class="hover:bg-gray-50">
    <td valign="top" class="py-2">
        <div class="w-full h-full flex items-center font-semibold text-logo-primary p-1">
            {{ $row->order_number }}
        </div>
        <input type="hidden" wire:model="row.order_number">
        <input type="hidden" wire:model="row.id">
    </td>
    <td x-data="{ highlight : 0, products : @entangle('products') }" x-init="$watch('products', (value) => console.log(value))" class="relative px-2">
        <input type="text"
               class="@error('row.name') border-red-800 @else border-logo-primary @enderror appearance-none border  p-1 px-3 bg-logo-gray text-gray-600 focus:outline-none w-full"
               wire:model.debounce.500ms="row.name"
               x-on:keydown.arrow-down="highlight = Math.min(products.length - 1, highlight + 1);"
               x-on:keydown.arrow-up="highlight = Math.max( 0, highlight - 1);"
               x-on:keydown.enter="$wire.fillIn(highlight);">
        <div class="absolute top-0 left-0 mt-11 p-5 shadow-lg bg-white w-full z-50" x-show="products.length > 0">
            <ul>
                <template x-for="(item, index) in products" x-key="item.id">
                    <li class="py-3 hover:bg-gray-50 cursor-pointer list-none"
                        x-on:click="$wire.fillIn(index);"
                        :class="{'bg-gray-50': index == highlight }">
                        <p class="text-sm font-bold text-gray-800" x-text="item.name"></p>
                    </li>
                </template>
            </ul>
        </div>
    </td>
    <td class="p-2">
        <input
            type="number"
            class="@error('row.amount') border-red-800 @else border-logo-primary @enderror appearance-none border  p-1 px-3 bg-logo-gray text-gray-600 focus:outline-none w-full"
            wire:model="row.amount"
            step="0.01"
            pattern="[0-9]+([,\.][0-9]+)?">
    </td>
    <td class="p-2">
        <select class="appearance-none @error('row.unit') border-red-800 @else border-logo-primary @enderror border  p-1 px-3 bg-logo-gray text-gray-600 focus:outline-none w-full"
                wire:model="row.unit">
            <option value="Stück">Stück</option>
            <option value="Stunden">Stunden</option>
            <option value="Pauschal">Pauschal</option>
            <option value="Kg">Kg</option>
        </select>
    </td>
    <td class="p-2">
        <input type="number"
               class="appearance-none @error('row.netto') border-red-800 @else border-logo-primary @enderror  border  p-1 px-3 bg-logo-gray text-gray-600 focus:outline-none w-full"
               wire:model="row.netto"
               step="0.01"
               pattern="[0-9]+([,\.][0-9]+)?">
    </td>
    <td align="right p-2">
        <input type="text"
               class="appearance-none border-logo-primary border  p-1 px-3 bg-logo-gray text-gray-600 focus:outline-none w-full text-right"
               value="{{ $this->nettoTotal }}"
               disabled="disabled"/>
    </td>

    <td align="right" class="p-2">
        <input type="number"
               class="appearance-none @error('row.vat') border-red-800 @else border-logo-primary @enderror border  p-1 px-3 bg-logo-gray text-gray-600 focus:outline-none w-full"
               wire:model="row.vat"
               step="0.01"
               pattern="[0-9]+([,\.][0-9]+)?">
    </td>

    <td  align="right" class="p-2">
        <input type="text"
               class="appearance-none border-logo-primary border  p-1 px-3 bg-logo-gray text-gray-600 focus:outline-none w-full text-right"
               value="{{ $this->bruttoTotal }}"
               disabled="disabled"/>
    </td>
    <td class="py-2">
        <div class="w-full h-full flex justify-center items-center">
            <svg class="w-4 h-4 text-gray-500 cursor-pointer" wire:click="$emit('deleteBillRow', {{ $row->id }} )"  fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
        </div>
    </td>
</tr>
