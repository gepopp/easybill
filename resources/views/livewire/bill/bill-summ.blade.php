<div class="flex flex-col items-end py-10 border-t border-b text-gray-800">
    <p class="text-lg font-semibold flex justify-between w-1/3"><span>Gesamt Netto:</span> <span> {{ number_format($netto, 2, ',', '.') }} €</span></p>
    <p class="text-lg font-semibold flex justify-between w-1/3"><span>Mehrwertsteuer:</span> <span> {{ number_format($vat, 2, ',', '.') }} €</span></p>
    <p class="text-lg font-semibold flex justify-between w-1/3"><span>Gesamt Brutto:</span> <span> {{ number_format($brutto, 2, ',', '.') }} €</span></p>
</div>
