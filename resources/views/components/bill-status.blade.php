@props([
    'status' => 'draft',
    'stats' => [
        'draft'         => 'text-gray-600',
        'generated'     => 'text-logo-light',
        'sent'          => 'text-logo-terciary',
        'paid'          => 'text-logo-primary',
        'overdue'       => 'text-red-600'
    ],
    'translation' => [
        'draft'         => 'Entwurf',
        'generated'     => 'erzeugt',
        'sent'          => 'gesendet',
        'paid'          => 'bezahlt',
        'overdue'       => 'überfällig'
    ]
])

<span {{ $attributes->merge(['class' => "{$stats[$status]}"]) }}>{{ $translation[$status] }}</span>
