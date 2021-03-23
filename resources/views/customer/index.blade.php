<x-vertical-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-white">
            Kunden
        </h2>
    </x-slot>
    <x-slot name="headerbutton">
        <div class="flex space-x-2">
            <a href="{{ route('customers.create') }}" class="button-secondary">Neuer Kunde</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl p-5">
                <ul>
                    @foreach($customers as $customer)
                        <li class="p-5 border-b flex justify-between">
                            <div>
                                {{ $customer->fullname }}
                                <ul class="ml-5">
                                    @foreach($customer->contactperson as $contactperson)
                                        <li class="flex items-end">
                                            <svg class="w-4 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                            </svg>
                                            {{ $contactperson->fullname }}
                                            <a href="{{ route('customers.edit', $contactperson) }}" class="text-xs ml-5">bearbeiten</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div>
                                <a href="{{ route('customers.edit', $customer) }}">
                                    bearbeiten
                                </a>
                                <form action="{{ route('customers.destroy', $customer) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-800">löschen</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-vertical-layout>
