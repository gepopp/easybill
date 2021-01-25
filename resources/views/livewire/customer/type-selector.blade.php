<div>
    <div class="border border-logo-primary grid grid-cols-2 gap-0 text-logo-primary my-4"
         x-data="{ is_company: @entangle('is_company') }"
    >
        <div class="border-r border-logo-primary py-2 px-3 text-center transition"
             :class="{ 'bg-logo-primary text-white' : is_company }"
             @click="is_company = true"
        >
            Unternehmen
        </div>
        <div class="py-2 px-3 text-center transition"
             :class="{ 'bg-logo-primary text-white' : !is_company }"
             @click="is_company = false"
        >
            Person
        </div>
        <input type="hidden" name="is_company" wire:model="is_company">
    </div>


</div>
