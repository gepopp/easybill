<tr class="mb-5 border-b">
    <td></td>
    <td colspan="4">
        <div x-data="{ show:false}"
            x-init="
                description = '{{ $row->description }}';
                if(description != ''){
                    show = true;
                    }
                    Livewire.on('descriptionUpdated', description => {
                        if(description == '') show = false;
                    })
            "
        >
            <button type="button" class="text-green-500 flex p-3 -mt-5" x-show="!show" @click="show = true">
                <svg class="w-6 h-6 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p>Beschreibung hinzufügen</p>
            </button>
            <textarea x-show.transition.fade.300ms="show" class="w-full border p-3" rows="5" wire:model="row.description"></textarea>
        </div>
    </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
