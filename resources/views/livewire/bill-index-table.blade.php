<table class="table-auto w-full text-sm striped">
    <thead>
    <tr>
        <th class="p-1 text-left">Nr.</th>
        <th class="p-1 text-left">Datum</th>
        <th class="p-1 text-left">Empfänger</th>
        <th class="p-1 text-right">Netto</th>
        <th class="p-1 text-right">Mwst.</th>
        <th class="p-1 text-right">Brutto</th>
        <th class="p-1 text-right">Bezahlt</th>
        <th class="p-1 text-right">Status</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @forelse( $bills as $bill )
        <tr>
            <td class=" p-1">{{ $bill->bill_number }}</td>
            <td class=" p-1">{{ \Carbon\Carbon::parse($bill->billing_date)->format('d.m.y') }}</td>
            <td class=" p-1">
                <p class="text-xs">{{ $bill->customer->company_name }}</p>
                <p>{{ $bill->customer->first_name }} {{ $bill->customer->last_name }}</p>
            </td>
            <td class=" p-1 text-right">{{ $bill->nettoTotal }} €</td>
            <td class=" p-1 text-right">{{ $bill->vatTotal }} €</td>
            <td class=" p-1 text-right">{{ $bill->bruttoTotal }} €</td>
            <td class=" p-1 text-right">{{ $bill->paid }} €</td>
            <td class=" p-1 text-right">{!! $bill->bill_status_formatted !!}</td>
            <td class="p-1 text-right">
                <a href="{{ route('bills.show', $bill) }}" class="underline">Zur Rechnung</a>
            </td>
        </tr>
    @empty
        <tr>
            <td class=" px-4 py-2" colspan="5">Keine Rechnungen gefunden.</td>
        </tr>
    @endforelse
    </tbody>
</table>


