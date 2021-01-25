<div>
    <button wire:click="$set('show', true)" class="button-secondary block">Zahlungserinnerung</button>

    <x-jet-dialog-modal :maxWidth="'2xl'" wire:model="show" class="overflow-scroll">
        <x-slot name="title">
            <div class="flex justify-between">
                <h1 class="text-logo-primary">Zahlungserinnerung</h1>
                <div class="flex justify-between">
                    <div wire:click="$set('show', false)" class="cursor-pointer">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="content">
            @if($warning)
                <div x-data="{ warn : false, modal: @entangle('show') }"
                     x-init="
                            $watch('modal', (modal) => {
                                if(modal){
                                 setTimeout(() => {
                                    warn = modal;
                                    }, 800);
                                }
                            })
                        ">
                    <div class="flex space-x-10 border border-red-400 p-10 my-5" x-show.transition.fade="warn">
                        <div class="w-12 h-12 rounded-full bg-red-400 bg-opacity-70 flex justify-center items-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <div class="flex justify-center items-center">
                            <p class="text-red-400">Du hast zu dieser Rechnung bereits eine Erinnerung gesendet.</p>
                        </div>
                    </div>
                </div>
            @endif
            <div class="text-gray-500">
                <div class="p-5 border border-logo-primary mb-5">
                    <livewire:notification-preview :bill="$bill" notifyclass="App\Notifications\BillReminderNotification"/>
                </div>
                <div class="py-4 flex justify-end">
                    <a href="{{ route('bills.remind', $bill) }}" class="button-primary">jetzt senden</a>
                </div>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>

