<div class="flex flex-col items-end pr-24 pt-10">
    <p class="text-lg font-semibold flex justify-between w-1/3"><span>Gesamt Netto:</span> <span> {{ number_format($netto, 2, ',', '.') }} €</span></p>
    <p class="text-lg font-semibold flex justify-between w-1/3"><span>Mehrwertsteuer:</span> <span> {{ number_format($vat, 2, ',', '.') }} €</span></p>
    <p class="text-lg font-semibold flex justify-between w-1/3"><span>Gesamt Brutto:</span> <span> {{ number_format($brutto, 2, ',', '.') }} €</span></p>
</div>
