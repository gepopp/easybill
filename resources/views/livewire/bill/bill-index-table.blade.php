<div>
    <div class="my-10 border-b pb-5">
        <h2 class="font-semibold text-gray-800 text-xl">Filtern</h2>
        <div class="flex justify-between">
            <livewire:customer-select/>
            <div class="flex">
                <div>
                    <label for="draft" class="flex items-center">
                        <input type="checkbox"
                               class="rounded-xl border border-double border-2 border-logo-primary text-logo-primary outline-none appearance-none w-4 h-4 bg-white rounded-full checked:bg-logo-primary checked:text-white"
                               wire:model="search.stati"
                               id="draft"
                               value="draft">
                        <span class="mx-3">Entwurf</span>
                    </label>
                </div>

                <div>
                    <label for="generated" class="flex items-center">
                        <input type="checkbox"
                               class="rounded-xl border border-double border-2 border-logo-primary text-logo-primary outline-none appearance-none w-4 h-4 bg-white rounded-full checked:bg-logo-primary checked:text-white"
                               wire:model="search.stati"
                               id="generated"
                               value="generated">
                        <span class="mx-3">erzeugt</span>
                    </label>
                </div>

                <div>
                    <label for="sent" class="flex items-center">
                        <input type="checkbox"
                               class="rounded-xl border border-double border-2 border-logo-primary text-logo-primary outline-none appearance-none w-4 h-4 bg-white rounded-full checked:bg-logo-primary checked:text-white"
                               wire:model="search.stati"
                               id="sent"
                               value="sent">
                        <span class="mx-3">gesendet</span>
                    </label>
                </div>

                <div>
                    <label for="paid" class="flex items-center">
                        <input type="checkbox"
                               class="rounded-xl border border-double border-2 border-logo-primary text-logo-primary outline-none appearance-none w-4 h-4 bg-white rounded-full checked:bg-logo-primary checked:text-white"
                               wire:model="search.stati"
                               id="paid"
                               value="paid">
                        <span class="mx-3">bezahlt</span>
                    </label>
                </div>

                <div>
                    <label for="overdue" class="flex items-center">
                        <input type="checkbox"
                               class="rounded-xl border border-double border-2 border-logo-primary text-logo-primary outline-none appearance-none w-4 h-4 bg-white rounded-full checked:bg-logo-primary checked:text-white"
                               wire:model="search.stati"
                               id="overdue"
                               value="overdue">
                        <span class="mx-3">überfällig</span>
                    </label>
                </div>

            </div>
        </div>
    </div>
    <table class="table-auto w-full text-sm striped">
        <thead>
        <tr>
            <th class="p-1 text-left text-gray-800">Nr.</th>
            <th class="p-1 text-left text-gray-800">Empfänger</th>
            <th class="p-1 text-right text-gray-800">Netto</th>
            <th class="p-1 text-right text-gray-800">Mwst.</th>
            <th class="p-1 text-right text-gray-800">Brutto</th>
            <th class="p-1 text-right ml-5 text-gray-800">Bezahlt</th>
            <th class="p-1 text-right text-gray-800">Datum</th>
            <th class="p-1 text-right text-gray-800">Fällig am</th>
            <th class="p-1 text-right text-gray-800">Status</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse( $bills as $bill )
            <tr class="hover:bg-gray-200">
                <td class=" p-1">
                    @if($bill->is_storno_of)
                        <p class="text-xs text-red-800">Storno von {{ $bill->is_storno_of->prefix }}{{ $bill->is_storno_of->bill_number }}</p>
                    @elseif($bill->has_storno)
                        <p class="text-xs text-red-800">Storniert mit {{ $bill->has_storno->prefix }}{{ $bill->has_storno->bill_number }}</p>
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
                <td class=" p-1 text-right">{{ \Carbon\Carbon::parse($bill->billing_date)->format('d.m.y') }}</td>
                <td class=" p-1 text-right">{{ \Carbon\Carbon::parse($bill->billing_date)->addDays($bill->respite)->format('d.m.y') }}</td>
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
    <div class="mt-10">
        {{ $bills->links() }}
    </div>
</div>


