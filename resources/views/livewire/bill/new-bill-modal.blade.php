<div>
    <button type="button" wire:click="showModal" class="button-primary">Neue Rechnung erstellen</button>
    <x-jet-dialog-modal :id="'tester'" :maxWidth="'2xl'" wire:model="show">

        <x-slot name="title">
            <h1>Neue Rechnung</h1>
        </x-slot>
        <x-slot name="content">
            <livewire:new-bill-modal-form/>
        </x-slot>
    </x-jet-dialog-modal>
</div>
