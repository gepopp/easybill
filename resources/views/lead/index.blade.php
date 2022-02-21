<x-vertical-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-white">
            Lead
        </h2>
    </x-slot>
    <x-slot name="headerbutton">
        <div class="flex space-x-2">
            <a href="{{ route('lead.create') }}" class="button-secondary">Neuer Lead</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl p-5">
                <ul>
                    @foreach($leads as $lead)
                        <li class="p-5 border-b flex justify-between">
                            <div>
                                <p>{{ $lead->name }}</p>
                                <p class="text-xs">{{ $lead->address }}</p>
                                <p class="text-xs">{{ $lead->zip }} {{ $lead->city }}</p>
                            </div>
                            <diV>
                                <a href="{{$lead->url}}">{{ $lead->url }}</a>
                            </diV>
                            <div>
                                <a href="mailto:{{$lead->email}}">{{ $lead->email }}</a>
                            </div>
                            <div>
                                <a href="{{ route('lead.edit', $lead ) }}">
                                    bearbeiten
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-vertical-layout>
