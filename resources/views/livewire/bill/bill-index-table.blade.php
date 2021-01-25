<div>
    <div class="my-10 border-b pb-5">
        <h2 class="font-semibold text-gray-800 text-xl">Filtern</h2>
        <div class="flex justify-between">
            <div class="flex space-x-2">
                <livewire:customer-select/>
                <div class="relative"
                     x-data="{ start : '', end: '', pickr: null }"
                     x-init="
                        pickr = flatpickr( $refs.datepicker,{
                                       mode: 'range',
                                       dateFormat: 'd.m.Y',
                                       onChange:((selectedDates, b, c) => {
                                            start = selectedDates[0];
                                            end = selectedDates[1];
                                           })
                                       })

                        $watch('start', (value) => {
                            if( value != undefined ){
                                 $wire.set('search.start', value);
                             }else{
                                 $wire.set('search.start', '1970-01-01');
                             }
                        });
                        $watch('end', (value) => {
                            if( value != undefined ){
                                 $wire.set('search.end', value);
                             }else{
                                 $wire.set('search.end', '3000-01-01');
                             }
                        });
                      ">

                    <input class="w-64 appearance-none border-logo-primary border rounded-xl p-1 px-3 bg-logo-gray text-gray-600 text-left focus:outline-none"
                           id="pick"
                           placeholder="Zeitraum wählen"
                           type="text"
                           x-ref="datepicker"
                    >
                    <div class="absolute top-0 right-0 pt-2 pr-2 cursor-pointer" x-show="start != ''">
                        <svg class="w-5 h-5 text-gray-400" @click="pickr.clear()" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                </div>

            </div>

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
    <table class="w-full table-auto text-gray-800">
        <thead>
        <tr>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 tracking-wider">Nr.</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 tracking-wider">Empfänger</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 tracking-wider text-right">Netto</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 tracking-wider text-right">Brutto</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 tracking-wider text-right">Bezahlt</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-center leading-4 tracking-wider">Status</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 tracking-wider text-right">Datum</th>
        </tr>
        </thead>
        <tbody>
        @forelse( $bills as $bill )
            <tr class="hover:bg-logo-gray">
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                    <a href="{{ route('bills.show', $bill) }}">
                        <p class="underline"> {{$bill->prefix}}{{ $bill->bill_number }}</p>
                        @if($bill->is_storno_of)
                            <p class="text-xs text-red-800">Storno von {{ $bill->is_storno_of->prefix }}{{ $bill->is_storno_of->bill_number }}</p>
                        @elseif($bill->has_storno)
                            <p class="text-xs text-red-800">Storniert mit {{ $bill->has_storno->prefix }}{{ $bill->has_storno->bill_number }}</p>
                        @endif
                    </a>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                    <p class="font-semibold">{{ $bill->customer->first_name }} {{ $bill->customer->last_name }}</p>
                    <p class="text-xs">{{ $bill->customer->company_name }}</p>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-right">
                    <p>{{ $bill->total('netto', 'euro') }}  </p>
                    <p><span class="text-xs">&nbsp;</span></p>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-right ">
                    <p class="font-semibold">{{ $bill->total('brutto', 'euro') }}</p>
                    <p><span class="text-xs">{{ $bill->total('vat', 'euro') }}</span></p>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-right">
                    <p>{{ $bill->paid('euro') }}</p>
                    <p><span class="text-xs">&nbsp;</span></p>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                    <a href="{{ route('bills.show', $bill) }}">
                        <x-bill-status status="{{ $bill->bill_status }}"/>
                    </a>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-right">
                    <p>{{ \Carbon\Carbon::parse($bill->billing_date)->format('d.m.Y') }}</p>
                    <p>
                        <span class="text-xs @if($bill->bill_status == 'overdue') text-red-800 @endif">&nbsp;
                        {{ \Carbon\Carbon::parse($bill->billing_date)->addDays($bill->respite)->format('d.m.Y') }}
                        </span>
                    </p>
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
    @push('scripts')
        <script src="{{ asset('js/app.js') }}"></script>
    @endpush
</div>

