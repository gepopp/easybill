@props([
    'name'          => '',
    'type'          => 'text',
    'label'         => '',
    'holderclass'   => '',
    'inputclass'    => '',
    'inputalign'    => 'text-right',
    'prefix'        => false,
    'step'          => false,
    'model'         => false,
    'value'         => ''
])

<div class="w-full mb-3 {{ $holderclass }}">
    <label for="{{ $name }}" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
        {{ $label }}
    </label>
    <div class="relative block">
        @if($prefix)
            <span class="absolute top-0 left-0 pl-3 pt-1 text-gray-600">{{ $prefix }}</span>
        @endif
        <input type="{{ $type }}"
               id="{{ $name }}"
               class="appearance-none block w-full bg-gray-200
                      text-gray-700 border border-gray-200 text-sm
                      py-2 px-4 leading-tight
                      focus:outline-none focus:bg-white focus:border-logo-primary
                      @error($name) border-red-500 @enderror"
               name="{{ $name }}"
               value="{{ $value }}"
               @if($model)
                    wire:model="{{ $model }}"
               @endif
               @if($step)
                    step="{{ $step }}"
               @endif
        >
        @error("$name")<p class="text-xs leading-none text-red-500 pb-2">{{ $message }}</p>@enderror
    </div>
</div>
