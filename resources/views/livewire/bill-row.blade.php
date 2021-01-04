<tr class="hover:bg-gray-50"
    x-data="{ focused: false }"
        x-init="$watch('focused', value => {
            setTimeout(()=>{
                if(!focused){
                    $wire.update()
                }
            },500);

            $wire.on('focus', (field) => {
                    document.getElementsByName(field)[0].focus()
                })
        })"
    >
    <td valign="top">
        {{ $row->order_number }}
        <input type="hidden" wire:model="row.order_number">
        <input type="hidden" wire:model="row.id">
    </td>
    <td>
        <input type="text" class="border my-2 w-full max-w-full p-2" wire:model.defer="row.name" x-on:focusin="focused = true" x-on:focusout="focused = false">
        <p class="h-10">
            @error('row.name') <span class="text-xs text-red-700">{{ $message }}</span> @enderror
        </p>
    </td>
    <td>
        <input
            type="number"
            class="border my-2 w-full max-w-full p-2"
            wire:model.defer="row.amount"
            step="0.01"
            pattern="[0-9]+([,\.][0-9]+)?"
            x-on:focusin="focused = true"
            x-on:focusout="focused = false">
        <p class="h-10">
            @error('row.amount') <span class="text-xs text-red-700">{{ $message }}</span> @enderror
        </p>
    </td>
    <td>
        <input type="text" class="border my-2 w-full max-w-full p-2" wire:model.defer="row.unit" step="0.01" pattern="[0-9]+([,\.][0-9]+)?" x-on:focusin="focused = true" x-on:focusout="focused = false">
        <p class="h-10">
            @error('row.unit') <span class="text-xs text-red-700">{{ $message }}</span> @enderror
        </p>
    </td>
    <td>
        <input type="number" class="border my-2 w-full max-w-full p-2" wire:model.defer="row.netto" step="0.01" pattern="[0-9]+([,\.][0-9]+)?" x-on:focusin="focused = true" x-on:focusout="focused = false">
        <p class="h-10">
            @error('row.netto') <span class="text-xs text-red-700">{{ $message }}</span> @enderror
        </p>
    </td>
    <td align="right">
        {{ $this->nettoTotal }} €
        <p class="h-10"></p>
    </td>

    <td align="right" >
        <input type="number" class="border my-2 w-full max-w-full p-2" wire:model.defer="row.vat" step="0.01" pattern="[0-9]+([,\.][0-9]+)?" x-on:focusin="focused = true" x-on:focusout="focused = false">
        <p class="h-10">
            @error('row.vat') <span class="text-xs text-red-700">{{ $message }}</span> @enderror
        </p>
    </td>

    <td  align="right">
        {{ $this->bruttoTotal }} €
        <p class="h-10"></p>
    </td>
    <td align="right" valign="top">
        <svg class="w-6 h-6 mt-3 text-gray-500 cursor-pointer" wire:click="$emit('deleteBillRow', {{ $row->id }} )"  fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
    </td>
</tr>
