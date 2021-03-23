<x-vertical-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Neue Rechung') }}
        </h2>
    </x-slot>
    {{ dump($errors) }}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <form action="{{ route('bills.store') }}" class="w-full" method="post">
                    @csrf
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <x-jet-label for="customer_id" value="{{ __('Kunde') }}"/>
                            <select name="customer_id" class="form-select max-w-full" required>
                                <option value="null">Bitte wählen...</option>
                                <?php
                                /**
                                 * @var $customers Customer[]
                                 */
                                ?>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->company->company_name ?? '' }}@if($customer->company) - @endif{{ $customer->first_name }} {{ $customer->last_name }}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="customer_id" class="mt-2"></x-jet-input-error>
                        </div>
                        <div>
                            <x-jet-label for="billing_date" value="{{ __('Rechnungsdatum') }}"/>
                            <input type="date" id="billing_date" name="billing_date" value="{{ old('billing_date') ?? now()->format('Y-m-d') }}" class="form-input w-full border"/>
                            <x-jet-input-error for="billing_date" class="mt-2"/>
                        </div>
                        <div>
                            <x-jet-label for="billing_number" value="{{ __('Rechnungsnummer') }}"/>
                            <input type="text" id="bill_number" name="bill_number" value="{{ old('bill_number') ??  \App\Models\Bill::getNextBillNumber() }}" class="form-input w-full border"/>
                            <p class="text-xs">Diese Nummer ist vorläufig, die tatsächliche Rechnungsnummer wird beim ersten speichern festgelegt.</p>
                            <x-jet-input-error for="bill_number" class="mt-2"/>
                        </div>
                    </div>
                    <button type="submit" class="p-3 text-white rounded-xl bg-gray-800">speichern</button>
                </form>
            </div>
        </div>
    </div>
</x-vertical-layout>
