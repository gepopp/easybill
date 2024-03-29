@props(['id' => null, 'maxWidth' => null])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="text-lg border-b border-logo-primary">
            {{ $title ?? ''}}
        </div>

        <div class="mt-4 pr-3 -mr-1">
            {{ $content ?? '' }}
        </div>
    </div>

    <div class="px-6 py-4 text-right rounded-b-xl">
        {{ $footer ?? '' }}
    </div>
</x-jet-modal>
