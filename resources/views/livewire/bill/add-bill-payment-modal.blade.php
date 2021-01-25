<div>
    <button type="button" wire:click="showModal" class="button-secondary">Zahlung erfassen</button>
    <x-jet-dialog-modal :id="'tester'" :maxWidth="'2xl'" wire:model="show">

        <x-slot name="title">
            <div class="flex justify-between">
                <h1>Zahlung erfassen</h1>
                <div wire:click="showModal" class="cursor-pointer">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
            </div>
        </x-slot>
        <x-slot name="content">
            <form wire:submit.prevent="createPayment">
                <div class="flex justify-between items-center mb-4">
                    <label for="payment_date" class="font-semibold text-gray-600">Zahlungsdatum</label>
                    <div>
                        <input type="date"
                               id="payment_date"
                               class="w-64 appearance-none border-logo-primary border rounded-xl p-1 px-3 bg-logo-gray text-gray-600 focus:outline-none"
                               wire:model="payment_date"
                        >
                        @error('payment_date')
                        <p class="text-sm leading-none text-red-800 px-3 py-2 w-64">{{ $message }}</p>@enderror

                    </div>
                </div>
                <div class="flex justify-between items-center mb-4">
                    <label for="amount" class="font-semibold text-gray-600">Betrag</label>
                    <div>
                        <p class="text-xs text-right">Offener Betrag:
                            <span wire:click="resetAmount" class="cursor-pointer underline text-logo-primary">{{ $to_pay }}</span>
                        </p>
                        <div class="relative">
                            <input type="number"
                                   step="0.01"
                                   step="1"
                                   id="amount"
                                   class="w-64 appearance-none border-logo-primary border rounded-xl p-1 px-3 bg-logo-gray text-gray-600 text-right focus:outline-none"
                                   wire:model="amount"
                                   pattern="[0-9]+([,\.][0-9]+)?"
                            >
                            <span class="absolute top-0 left-0 pl-3 py-1 text-gray-600">
                            €
                        </span>
                        </div>
                        @error('amount')
                        <p class="text-sm leading-none text-red-800 px-3 py-2 w-64">{{ $message }}</p>@enderror
                    </div>
                </div>
                @if($amount == $to_pay)
                    <div class="flex justify-end items-center mb-4">
                        <div>
                            <label for="thanx" class="font-semibold text-gray-600 flex items-center">
                                <input type="checkbox"
                                       class="rounded-xl border border-double border-2 border-logo-primary text-logo-primary outline-none appearance-none w-4 h-4 bg-white rounded-full checked:bg-logo-primary checked:text-white"
                                       wire:model="say_thanx"
                                       id="thanx">
                                <span class="mx-3">Danke-E-Mail an Kunde senden</span>
                            </label>
                        </div>
                    </div>
                    <div x-data="{ mail : @entangle('say_thanx') }">
                        <div class="p-5 border border-logo-primary mb-5" x-show.transition.fade="mail">
                            <livewire:notification-preview :bill="$bill" notifyclass="App\Notifications\ThankYouForPayingNotification"/>
                        </div>
                    </div>
                @endif
                <div class="flex justify-end">
                    <button class="button-primary" type="submit">
                        <span class="px-3">Zahlung speichern</span>
                    </button>
                </div>
            </form>
        </x-slot>
    </x-jet-dialog-modal>
</div>
