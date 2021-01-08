<tr class="mb-5 border-b">
    <td></td>
    <td colspan="4" class="p-2">
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
            <button type="button" class="bg-logo-secondary text-white px-3 py-2 rounded-xl flex innline focus:outline-none" x-show="!show" @click="show = true">
                <svg class="w-6 h-6 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p>Beschreibung hinzufügen</p>
            </button>
            <div class="relative" x-show.transition.fade.300ms="show" @click="show = false">
              <div class="absolute top-0 right-0 m-3 rounded-full bg-logo-light">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
              </div>
            <textarea
                      class="w-full border p-3 appearance-none border-logo-primary border rounded-xl bg-logo-gray text-gray-600 focus:outline-none w-full"
                      rows="3"
                      wire:model="row.description"></textarea>
            </div>

        </div>
    </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
