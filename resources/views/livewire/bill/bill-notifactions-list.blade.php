<div>
    <p class="py-3 mt-10 border-b border-logo-primary w-full text-left font-semibold">Benachrichtigungen:</p>
    <ul>
        @forelse($bill->notifications as $notification)
            <li class="flex flex-col justify-center px-3 py-5 border-b border-logo-primary">
                <p>
                    @if( $notification->notification == 'App\Notifications\SendBill')
                        Rechnung gesendet
                    @elseif($notification->notification == 'App\Notifications\ThankYouForPaying')
                        Danke gesendet
                    @endif
                </p>
                <p class="text-xs">Gesendet {{ \Carbon\Carbon::parse($notification->updated_at)->diffForHumans() }}</p>
            </li>
        @empty
            <li class="flex justify-center px-3 py-5 border-b border-logo-primary">
                Noch nichts gesendet.
            </li>
        @endforelse
    </ul>
</div>
