<div class="w-full">
    <div class="flex flex-col">
        @if (session()->has('message'))
            <div class="w-full p-10 bg-gradient-to-r from-logo-primary via-logo-secondary to-logo-terciary text-white font-semibold">
                {{ session('message') }}
            </div>
        @else
            <form wire:submit.prevent="subscribe">
                <div class="pb-4">
                    <label for="name" class="text-logo-primary w-full">Dein Name</label>
                    <input type="text" name="name" wire:model.defer="name" required class="border-logo-primary border p-2 focus:outline-none w-full">
                    @error('name') <span class="text-xs text-red-700">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="email" class="text-logo-primary w-full">Deine E-Mail Adresse</label>
                    <input type="email" name="email" wire:model.defer="email" required class="border-logo-primary border p-2 focus:outline-none w-full">
                    @error('email') <span class="text-xs text-red-700">{{ $message }}</span> @enderror
                </div>
                <div class="py-5">
                    <label class="text-logo-primary flex items-center space-x-2">
                        <input type="checkbox"
                               class="rounded-xl border border-double border-2 border-logo-primary text-logo-primary outline-none appearance-none w-4 h-4 bg-white rounded-full checked:bg-logo-primary checked:text-white"
                               wire:model.defer="agb"
                               required>
                        <span>Ich akzeptiere die AGB diese Webseite.</span>
                    </label>
                    @error('agb') <span class="text-xs text-red-700">{{ $message }}</span> @enderror
                </div>
                <div class="pb-5">
                    <label class="text-logo-primary flex items-center space-x-2">
                        <input type="checkbox"
                               class="rounded-xl border border-double border-2 border-logo-primary text-logo-primary outline-none appearance-none w-4 h-4 bg-white rounded-full checked:bg-logo-primary checked:text-white"
                               wire:model.defer="betatester"
                        >
                        <span>Ja, ich möchte unter den ersten sein und Betatester werden.</span>

                    </label>
                    @error('betatester') <span class="text-xs text-red-700">{{ $message }}</span> @enderror
                </div>
                <button type="submit"
                        class="rounded-xl w-full bg-gradient-to-r from-logo-primary via-logo-secondary to-logo-terciary p-3 text-center text-white font-semibold
                        hover:bg-logo-light hover:bg-gradient-to-l hover:from-logo-terciary focus:outline-none">anmelden
                </button>
            </form>
        @endif
    </div>
</div>
