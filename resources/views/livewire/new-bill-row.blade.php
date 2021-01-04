<tr class="border-b hover:bg-gray-50">
    <td valign="top">
        {{ $row->order_number }}
        <input type="hidden" wire:model="row.order_number">
        <input type="hidden" wire:model="row.id">
    </td>
    <td>
        <div class="relative">
            <input type="text" class="border my-2 w-full max-w-full p-2" wire:model="row.name" wire:keydown="searchProducts">
            <p class="h-10">
                @error('row.name') <span class="text-xs text-red-700">{{ $message }}</span> @enderror
            </p>
            @if($products)
                <div class="absolute top-0 left-0 mt-16 p-5 shadow-lg bg-white w-full">
                    <ul>
                        @foreach($products as $index => $product)
                            <li class="py-3 hover:bg-gray-50 cursor-pointer" wire:click="fillIn({{$index}})" >
                                <p class="text-sm font-bold">{{ $product->name }}</p>
                                <p class="text-xs flex justify-between">
                                    <span>{{ number_format($product->netto, 2, ',','.') }} €</span>
                                    <span>{{ number_format($product->vat, 2, ',', '.') }} %</span>
                                    <span>{{ $product->unit }}</span>
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

    </td>
    <td>
        <input
            type="number"
            class="border my-2 w-full max-w-full p-2"
            wire:model.lazy="row.amount"
            pattern="[0-9]+([,\.][0-9]+)?">
        <p class="h-10">
            @error('row.amount') <span class="text-xs text-red-700">{{ $message }}</span> @enderror
        </p>
    </td>
    <td>
        <input type="text" class="border my-2 w-full max-w-full p-2" wire:model.lazy="row.unit" pattern="[0-9]+([,\.][0-9]+)?">
        <p class="h-10">
            @error('row.unit') <span class="text-xs text-red-700">{{ $message }}</span> @enderror
        </p>
    </td>
    <td>
        <input type="number" class="border my-2 w-full max-w-full p-2" wire:model.lazy="row.netto" pattern="[0-9]+([,\.][0-9]+)?">
        <p class="h-10">
            @error('row.netto') <span class="text-xs text-red-700">{{ $message }}</span> @enderror
        </p>
    </td>
    <td align="right">
        <p class="h-10"></p>
    </td>

    <td align="right">
        <input type="number" class="border my-2 w-full max-w-full p-2" wire:model.lazy="row.vat">
        <p class="h-10">
            @error('row.vat') <span class="text-xs text-red-700">{{ $message }}</span> @enderror
        </p>
    </td>

    <td align="right">
        <p class="h-10"></p>
    </td>
    <td align="right" valign="top">
        <svg class="w-6 h-6 mt-3 text-gray-500 cursor-pointer" wire:click="$emit('unsetNewRow')" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
        </svg>
    </td>
</tr>
