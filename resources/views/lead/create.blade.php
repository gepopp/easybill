<x-vertical-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Neuer Lead') }}
        </h2>
    </x-slot>
    <x-slot name="headerbutton">
        <button onclick="document.getElementById('lead-form').submit()" class="button-secondary">speichern</button>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl p-5">
                <form action="{{ route('lead.store') }}" class="w-full" method="post" id="lead-form">
                    @csrf

                    <div>
                        <x-jet-label for="name">Firmenname</x-jet-label>
                        <x-jet-input type="text" name="name" value="{{ old('name') }}" class="w-full"/>
                        <x-jet-input-error for="name"/>
                    </div>
                    <div>
                        <x-jet-label for="address">Adresse</x-jet-label>
                        <x-jet-input type="text" name="address" value="{{ old('address') }}" class="w-full"/>
                        <x-jet-input-error for="address"/>
                    </div>
                    <div class="grid grid-cols-6 gap-5">
                        <div class="col-span-2">
                            <x-jet-label for="zip">Plz</x-jet-label>
                            <x-jet-input type="text" name="zip" value="{{ old('zip') }}" class="w-full"/>
                            <x-jet-input-error for="zip"/>
                        </div>
                        <div class="col-span-4">
                            <x-jet-label for="city">Stadt</x-jet-label>
                            <x-jet-input type="text" name="city" value="{{ old('city') }}" class="w-full"/>
                            <x-jet-input-error for="city"/>
                        </div>
                    </div>
                    <div>
                        <x-jet-label for="url">Webseite</x-jet-label>
                        <x-jet-input type="text" name="url" value="{{ old('url') }}" class="w-full"/>
                        <x-jet-input-error for="url"/>
                    </div>
                    <div>
                        <x-jet-label for="email">email</x-jet-label>
                        <x-jet-input type="text" name="email" value="{{ old('email') }}" class="w-full"/>
                        <x-jet-input-error for="email"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-vertical-layout>

