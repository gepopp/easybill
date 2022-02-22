<div>
    <ul>
        @foreach($contacts as $contact)
            <li class="my-3 py-3 border-b flex justify-between" :wire:key="{{ $contact['id'] }}">
                <div>{{ $contact['name'] }}</div>
                <div>{{ $contact['position'] }}</div>
                <div>{{ $contact['phone'] }}</div>
                <div>
                    <a href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a>
                </div>
                <div wire:click="trash({{ $contact['id'] }})">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </div>
                <div wire:click="sendFirstContact({{ $contact['id'] }})">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </li>
        @endforeach
    </ul>


    <h3>Kontakt hinzufügen</h3>
    <form wire:submit.prevent="submit" class="grid grid-cols-5 gap-3">
        <div>
            <x-jet-label for="name">Name</x-jet-label>
            <x-jet-input type="text" wire:model="name"/>
            <x-jet-input-error for="name"/>
        </div>
        <div>
            <x-jet-label for="position">Position</x-jet-label>
            <x-jet-input type="text" wire:model="position"/>
            <x-jet-input-error for="position"/>
        </div>
        <div>
            <x-jet-label for="email">E-Mail</x-jet-label>
            <x-jet-input type="email" wire:model="email"/>
            <x-jet-input-error for="email"/>
        </div>
        <div>
            <x-jet-label for="phone">Telefon</x-jet-label>
            <x-jet-input type="text" wire:model="phone"/>
            <x-jet-input-error for="phone"/>
        </div>
        <div>
            <x-jet-label>&nbsp;</x-jet-label>
            <x-jet-button type="submit">Speichern</x-jet-button>
        </div>
    </form>
</div>
