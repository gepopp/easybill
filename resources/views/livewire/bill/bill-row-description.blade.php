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
                ">
            <button type="button" class="bg-logo-secondary text-white px-3 py-2 flex innline focus:outline-none" x-show="!show" @click="show = true">
                <svg class="w-6 h-6 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p>Beschreibung hinzufügen</p>
            </button>
            <div class="relative h-48 border">
                <div id="desc-{{ $row->id }}">
                    {!! $row->description !!}
                </div>
                <input type="hidden" wire:model.lazy="row.description" id="desc-{{ $row->id }}" wire:ignore>
                <div class="absolute top-0 right-0 m-3 rounded-full bg-logo-light">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" @click="show = false">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <script wire:ignore>
        window.onload = function (){
            var editor{{ $row->id }} = new Quill('#desc-{{ $row->id }}',
                {
                    modules: {
                        toolbar: [
                            [{ header: [1, 2, false] }],
                            ['bold', 'italic', 'underline'],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ]
                    },
                    placeholder: '',
                    theme: 'snow'  // or 'bubble'
                });

            editor{{ $row->id }}.on('text-change', function(delta, oldDelta, source) {
                document.getElementById('desc-{{ $row->id }}').value = editor{{ $row->id }}.container.firstChild.innerHTML;
            });
        }
    </script>
</tr>
