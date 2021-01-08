<table class="table-auto w-full text-sm striped">
    <thead>
    <tr>
        <th class="p-1 text-left">Nr.</th>
        <th class="p-1 text-left">Empfänger</th>
        <th class="p-1 text-right">Netto</th>
        <th class="p-1 text-right">Mwst.</th>
        <th class="p-1 text-right">Brutto</th>
        <th class="p-1 text-right ml-5">Bezahlt</th>
        <th class="p-1 text-left">Datum</th>
        <th class="p-1 text-left">Fällig am</th>
        <th class="p-1 text-right">Status</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @forelse( $bills as $bill )
        <tr>
            <td class=" p-1">
                @if($bill->is_storno_of)
                    <p class="text-xs text-red-800">Storno von {{ $bill->is_storno_of->prefix }}{{ $bill->is_storno_of->bill_number }}</p>
                @endif
                {{$bill->prefix}}{{ $bill->bill_number }}
            </td>
            <td class=" p-1">
                <p class="text-xs">{{ $bill->customer->company_name }}</p>
                <p>{{ $bill->customer->first_name }} {{ $bill->customer->last_name }}</p>
            </td>
            <td class=" p-1 text-right">{{ $bill->total('netto', 'withSymbol') }}</td>
            <td class=" p-1 text-right">{{ $bill->total('vat', 'withSymbol') }}</td>
            <td class=" p-1 text-right">{{ $bill->total('brutto', 'withSymbol') }}</td>
            <td class=" p-1 text-right">{{ $bill->paid('withSymbol') }}</td>
            <td class=" p-1">{{ \Carbon\Carbon::parse($bill->billing_date)->format('d.m.y') }}</td>
            <td class=" p-1">{{ \Carbon\Carbon::parse($bill->billing_date)->addDays($bill->respite)->format('d.m.y') }}</td>
            <td class=" p-1 text-right">
                <x-bill-status status="{{ $bill->bill_status }}"/>
            </td>
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

