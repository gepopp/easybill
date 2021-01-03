<div>
    <table class="table-fixed w-full mt-10">
        <thead class="border-b">
        <tr>
            <th class="text-left w-1/12">#</th>
            <th class="text-left w-3/12">Bezeichnung</th>
            <th class="text-left w-1/12">Menge</th>
            <th class="text-left w-2/12">Einheit</th>
            <th class="text-left w-1/12">Einzelpreis</th>
            <th class="text-left w-1/12">Gesamt</th>
            <th class="text-left w-1/12">MwSt.</th>
            <th class="text-left w-1/12">Brutto</th>
            <th class="text-left w-1/12"></th>
        </tr>
        </thead>
        <tbody>
        @foreach( $bill->positions as $position )
            <livewire:bill-row :row="$position" :bill="$bill" :key="$position->id"/>
            <livewire:bill-row-description :row="$position" :bill="$bill" :key="uniqid()"/>
        @endforeach

        @if($new_rows)
            <livewire:new-bill-row :data="$new_rows" />
        @endif

        </tbody>
        <tfoot>
        <tr>
            <td colspan="9" class="p-5">
                @if(empty($new_rows))
                    <div class="flex justify-end">
                        <button wire:click="addRow" class="border border-green-500 p-2">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </button>
                    </div>
                @endif
            </td>
        </tr>
        </tfoot>
    </table>
</div>
