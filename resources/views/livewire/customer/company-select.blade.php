<div class="w-full px-3 mb-6 md:mb-0">
    <label for="company_id" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
        Unternehmen
    </label>
    <select name="company_id" class="w-full p-2 bg-gray-200 focus:outline-none mb-3" wire:model="company">
        <option value="" class="pb-2 px-3 hover:bg-logo-light" >Bitte wählen</option>
        @foreach($companies as $company)
            <option  class="pb-2 px-3 hover:bg-logo-light" value="{{ $company->id }}">
                {{ $company->company_name }}
            </option>
        @endforeach
    </select>
    @error("company_id")<p class="text-xs leading-none text-red-500 pb-2">{{ $message }}</p>@enderror
</div>
