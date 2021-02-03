<div>
    <div class="border border-logo-primary grid grid-cols-2 gap-0 text-logo-primary mb-3"
         x-data="{ is_company: @entangle('is_company') }"
    >
        <div class="border-r border-logo-primary py-2 px-3 text-center leading-tight transition text-sm cursor-pointer"
             :class="{ 'bg-logo-primary text-white' : is_company }"
             @click="is_company = 1"
        >
            Unternehmen
        </div>
        <div class="py-2 px-3 text-center transition text-sm cursor-pointer leading-tight"
             :class="{ 'bg-logo-primary text-white' : !is_company }"
             @click="is_company = 0"
        >
            Person
        </div>
        <input type="hidden" name="is_company" wire:model="is_company">
    </div>

    @if($is_company)
        <x-input label="Unternehmensbezeichnung" name="company_name" value="{{ old('company_name') }}" type="text"/>
    @else

        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="first_name">Anrede</label>
                <select name="is_female"
                        class="appearance-none block w-full bg-gray-200 w-full
                      text-gray-700 border border-gray-200 text-sm
                      py-2 px-4 leading-tight
                      focus:outline-none focus:bg-white focus:border-logo-primary
                      @error('is_female') border-red-500 @enderror">
                        <option value="">Bitte wählen...</option>
                        <option value="1">Frau</option>
                        <option value="0">Herr</option>
                </select>
                @error('is_female')
                <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <x-input label="Titel" name="academic_degree" value="{{ old('academic_degree') }}"/>
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <x-input label="Vorname" name="first_name" value="{{ old('first_name') }}"/>
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <x-input label="Nachname" name="last_name" value="{{ old('last_name') }}"/>
            </div>
        </div>
    @endif
</div>
