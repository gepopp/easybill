<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RE {{ $bill->bill_number }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"/>
</head>

<body class="text-sm leading-normal pt-24">
<header class="fixed top-0 left-0 h-24 w-full">
    <div style="width: 33%; float: right; padding-right: 1.5cm">
        <img src="{{ Storage::temporaryUrl(\App\Models\BillSetting::getSetting('logo', $user), now()->addMinutes(5)) }}" style="max-width: none; width: auto">
    </div>
</header>
<footer class="fixed bottom-0 left-0 w-full h-14">
    <hr>
    <table class="table-fixed text-xs w-full">
        <tr>
            <td>
                <table>
                    <tr>
                        <td valign="bottom">
                            <img src="{{ asset('logo-icon-ohne-hg.png')  }}" class="pt-2" style="max-width: auto; width: 1cm">
                        </td>
                        <td>
                            <a href="https://mybilling.at">
                                <p style="font-size: .5rem">Erstellt mit:</p>
                                <h1 class="text-xl font-bold" style="color: #42A626">mybilling.at</h1>
                                <h3 class="leading-none text-xs" style="color: #D2D90B">Dein kosnteloses Rechnungstool</h3>
                            </a>
                        </td>
                    </tr>
                </table>
{{--                {!! $settings['footercol_1'] !!}--}}
            </td>
            <td class="text-center">
                {!! $footercol_2 !!}
            </td>
            <td class="text-right">
                {!! $footercol_3 !!}
            </td>
        </tr>
    </table>
</footer>

<main class="w-full">
    <table class="table-auto w-full">
        <tr>
            <td valign="bottom">
              <p class="text-xs" style="font-size: .5rem">Abs: {{ \App\Models\BillSetting::getSetting('company_name', $user ) }}, {{ \App\Models\BillSetting::getSetting('address', $user ) }}</p>
                <x-customer-address :customer="$customer"/>
            </td>
            <td>
                <p class="text-right text-xs leading-normal">{{ \App\Models\BillSetting::getSetting('company_name', $user) }}</p>
                <p class="text-right text-xs leading-normal">{{ \App\Models\BillSetting::getSetting('address', $user) }}</p>
                <p class="text-right text-xs leading-normal">{{ \App\Models\BillSetting::getSetting('contactperson', $user) }}</p>
                <p class="text-right text-xs leading-normal">{{ \App\Models\BillSetting::getSetting('contactemail', $user) }}</p>
                <p class="text-right text-xs leading-normal">{{ \App\Models\BillSetting::getSetting('contactphone', $user) }}</p>
                <p class="text-right text-xs leading-normal">{{ \App\Models\BillSetting::getSetting('uid', $user) }}</p>
                <p class="text-right text-xs leading-normal">
                    Rechnungsdatum: {{ \Carbon\Carbon::parse($bill->billing_date)->format('d.m.Y') }}
                </p>
                <p class="text-right text-xs leading-normal mb-24">
                    Fälling am: {{ \Carbon\Carbon::parse($bill->billing_date)->addDays($bill->respite)->format('d.m.Y') }}
                </p>
            </td>
        </tr>
    </table>

    <div class="mt-10">
        <p class="font-bold text-lg">{{ $bill->total('vat') > 0 ? 'Rechnung' : 'Gutschrift' }}: {{ $bill->prefix }} {{ $bill->bill_number }} </p>
        <p>{!! $header !!}</p>
    </div>
    <table class="table-auto w-full mt-10">
        <thead class="border-b">
        <tr>
            <th class="text-left  pr-1">#</th>
            <th class="text-left pr-1">Bezeichnung</th>
            <th class="text-center  pr-1">Menge</th>
            <th class="text-center  pr-1">Einheit</th>
            <th class="text-right  pr-1">Einzelpreis</th>
            <th class="text-right  pr-1">Gesamt</th>
            <th class="text-right  pr-1">MwSt.</th>
            <th class="text-right ">Brutto</th>
        </tr>
        </thead>
        <tbody>
        @foreach( $bill->positions as $position )
            <tr class="py-3">
                <td class="py-2 pr-1 whitespace-no-wrap" valign="top">
                    {{ $position->order_number }}
                </td>
                <td class="py-2 pr-1 whitespace-no-wrap">
                    {{ $position->name }}
                </td>
                <td class="py-2 pr-1 whitespace-no-wrap text-center">
                    {{ $position->amount }}
                </td>
                <td class="py-2 pr-1 whitespace-no-wrap text-center">
                    {{ $position->unit }}
                </td>
                <td class="py-2 pr-1 whitespace-no-wrap text-right">
                    {{ number_format($position->netto, 2,',','.') }} €
                </td>
                <td class="py-2 pr-1 whitespace-no-wrap" align="right">
                    {{ number_format( ($position->netto * $position->amount), 2,',','.') }} €
                </td>
                <td class="py-2 pr-1 whitespace-no-wrap" align="right">
                    {{ number_format( ( $position->vat ), 0,',','.') }} %
                </td>
                <td class="py-2 whitespace-no-wrap" align="right">
                    {{ number_format(($position->netto * $position->amount ) + ((( $position->netto * $position->amount ) * $position->vat)/100), 2, ',', '.') }} €
                </td>
            </tr>
            <tr class="border-b border-b-2">
                <td></td>
                <td>
                    <p class="text-xs pb-3">{{ $position->description }}</p>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="8">
                    <hr>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
    <table class="table-fixed w-full">
        <tr>
            <td class="w-1/2"></td>
            <td class="w-1/4 text-left">Netto gesamt:</td>
            <td class="w-1/4 text-right">{{ $bill->total('netto', 'withSymbol')  }}</td>
        </tr>

        <tr>
            <td class="w-1/2"></td>
            <td class="w-1/4 text-left">MwSt.:</td>
            <td class="w-1/4 text-right">{{ $bill->total('vat', 'withSymbol')  }} €</td>
        </tr>
        <tr>
            <td class="w-1/2"></td>
            <td class="w-1/4 text-left font-bold">Rechnungsbetrag:</td>
            <td class="w-1/4 text-right font-bold">{{ $bill->total('brutto', 'withSymbol') }} €</td>
        </tr>
    </table>
    <p class="mt-16">{!! $footer !!}</p>
</main>
</body>
</html>
