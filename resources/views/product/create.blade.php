<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Neues Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">

                <form action="{{ route('products.store') }}" class="w-full" method="post">
                    @csrf

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">Bezeichnung</label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3
                                leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('name') border-red-500 @enderror"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                type="text"
                                required>
                            @error('name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="netto">Nettopreis</label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded
                                          py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('netto') border-red-500 @enderror"
                                   id="netto"
                                   name="netto"
                                   value="{{ old('netto') }}"
                                   type="number"
                                   pattern="[0-9]+([,\.][0-9]+)?"
                                   step="0.01"
                                   required>
                            @error('netto')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="unit">Einheit</label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3
                                          px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('unit') border-red-500 @enderror"
                                   id="unit"
                                   name="unit"
                                   value="{{ old('unit') }}"
                                   type="text"
                                   required>
                            @error('unit')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/3 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="vat">MwSt. Satz</label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded
                                    py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('vat') border-red-500 @enderror"
                                   id="vat"
                                   name="vat"
                                   value="{{ old('vat') }}"
                                   type="number"
                                   pattern="[0-9]+([,\.][0-9]+)?"
                                   step="0.01"
                                   required>
                            @error('vat')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="description">Beschreibung</label>
                            <textarea class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded
                                          py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('description') border-red-500 @enderror"
                                      id="description"
                                      name="description">
                                {{ old('description') }}
                            </textarea>
                            @error('description')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-green-300 text-center text-white py-3 px-4 rounded">speichern</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>


