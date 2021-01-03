<div>
    @if($edit)
        <span class="flex items-center">
            <input type="date" wire:model="date">
            <svg class="w-4 h-4 ml-2 text-gray-400" wire:click="$set('edit', false)" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </span>
    @else
        <span class="flex items-center">{{ \Carbon\Carbon::parse($bill->billing_date)->format('d.m.Y') }}
        <svg class="w-4 h-4 ml-2 text-gray-400" wire:click="$set('edit', true)" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
        </span>
    @endif
</div>
