@props([
    'name'          => '',
    'type'          => 'text',
    'label'         => '',
    'holderclass'   => '',
    'inputclass'    => '',
    'inputalign'    => 'text-right',
    'prefix'        => false,
    'step'          => false
])

<div class="flex justify-between items-center mb-4 {{ $holderclass }}">
    <label for="{{ $name }}" class="font-semibold text-gray-600">{{ $label }}</label>
    <div class="relative">
        @if($prefix)
            <span class="absolute top-0 left-0 pl-3 pt-1 text-gray-600">{{ $prefix }}</span>
        @endif

        <input type="{{ $type }}"
               id="{{ $name }}"
               class="w-64 appearance-none border-logo-primary border rounded-xl p-1 px-3 bg-logo-gray text-gray-600 focus:outline-none {{ $inputalign }} {{ $inputclass }}"
               wire:model="{{ $name }}"
               @if($step)
                   step="{{ $step }}"
               @endif
        >
        @error("$name")<p class="text-sm leading-none text-red-800 px-3 py-2 w-64">{{ $message }}</p>@enderror
    </div>
</div>
