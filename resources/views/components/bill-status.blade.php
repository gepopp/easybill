@props([
    'status' => 'draft',
    'stats' => [
        'draft'         => 'bg-gray-600',
        'generated'     => 'bg-yellow-400',
        'sent'          => 'bg-logo-terciary',
        'paid'          => 'bg-logo-primary',
        'overdue'       => 'bg-red-600',
        'storno'        => 'bg-red-900'
    ],
    'translation' => [
        'draft'         => 'entwurf',
        'generated'     => 'erzeugt',
        'sent'          => 'gesendet',
        'paid'          => 'bezahlt',
        'overdue'       => 'überfällig',
        'storno'        => 'storniert'
    ]
])

<span class="relative inline-block px-3 py-1 font-semibold leading-normal pb-2 w-full text-center">
    <span class="{{ $stats[$status]}} absolute inset-0 opacity-75 w-full h-full"></span>
    <span class="relative text-xs text-white">{{ $translation[$status] }}</span>
</span>
