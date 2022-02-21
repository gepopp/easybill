<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RE {{ $bill->bill_number }}</title>
    <style>
        * {
            padding: 0;
            margin: 0;
        }

        table {
            width: 100%;
        }

        p {
            line-height: 1.2;
        }
    </style>
</head>

<body style="font-family: sans-serif; font-size: 12px; line-height: 1; padding-top: 3cm;">
<header style="position: fixed; top: 0; left: 0; width: 100%;">
    <div style="width: 33%; float: right; padding-right: 1.5cm;">
        <img src="{{ Storage::temporaryUrl(\App\Models\BillSetting::getSetting('logo', $user), now()->addMinutes(5)) }}" style="max-width: none; width: auto;">
    </div>
</header>
<footer style="position: fixed; bottom: 0; left: 0; width: 100%;height: 2cm; padding: 0 2cm 0 2cm;">
    <hr>
    <table style="width: 100%">
        <tr>
            <td>
                <table>
                    <tr>
                        <a href="https://mybilling.at">
                            <td valign="top">
                                <img src="{{ asset('logo-icon.png')  }}" style="width: 1cm; height: auto; padding: 0; margin: 0;">
                            </td>
                            <td>
                                <h1 style="color: #42A626; font-size: 1.5rem; line-height: 1; margin: 0; padding: 0;">mybilling.at</h1>
                                <h3 style="color: #D2D90B; font-size: .5rem; line-height: 1; margin: 0; padding: 0;">Dein kosnteloses Rechnungstool</h3>
                            </td>
                        </a>
                    </tr>
                </table>

                {{--                {!! $settings['footercol_1'] !!}--}}
            </td>
            <td style="text-align: center">
                {!! $footercol_2 !!}
            </td>
            <td style="text-align: right">
                {!! $footercol_3 !!}
            </td>
        </tr>
    </table>
</footer>

<main style="padding-left: 2cm; padding-right: 2cm;">
    <table style="">
        <tr>
            <td valign="top">
                <p style="font-size: .5rem; margin-bottom: 15px">Abs: {{ \App\Models\BillSetting::getSetting('company_name', $user ) }}, {{ \App\Models\BillSetting::getSetting('address', $user ) }}</p>

                @if($company)
                    <strong>{{ $company->company_name }}</strong><br>
                @endif

                {{ $customer->fullname }}<br>

                @if($company)
                    {{ $company->address }} {{ $company->address_addition }}<br>
                    {{ $company->zip }} {{ $company->city }}
                @else
                    {{ $customer->address }} {{ $customer->address_addition }}<br>
                    {{ $customer->zip }} {{ $customer->city }}
                @endif


            </td>
            <td style="text-align: right">
                <p>{{ \App\Models\BillSetting::getSetting('company_name', $user) }}</p>
                <p>{{ \App\Models\BillSetting::getSetting('address', $user) }}</p>
                <p>{{ \App\Models\BillSetting::getSetting('contactperson', $user) }}</p>
                <p>{{ \App\Models\BillSetting::getSetting('contactemail', $user) }}</p>
                <p>{{ \App\Models\BillSetting::getSetting('contactphone', $user) }}</p>
                <p>{{ \App\Models\BillSetting::getSetting('uid', $user) }}</p>
                <p>Rechnungsdatum: {{ \Carbon\Carbon::parse($bill->billing_date)->format('d.m.Y') }}</p>
                <p>
                    Fälling am: {{ \Carbon\Carbon::parse($bill->billing_date)->addDays($bill->respite)->format('d.m.Y') }}
                </p>
            </td>
        </tr>
    </table>

        <div style="margin-top: 1cm">
            <p style="font-weight: bold; font-size: 1rem">{{ $bill->total('vat') > 0 ? 'Rechnung' : 'Gutschrift' }}: {{ $bill->prefix }} {{ $bill->bill_number }} </p>
            <p>{!! $header !!}</p>
        </div>
        <table style="margin-top:1cm; padding-bottom: 2cm;">
            <thead style="border-bottom: 2px solid black; margin-bottom: 0.5cm">
            <tr>
                <th style="text-align: left">#</th>
                <th style="text-align: left">Bezeichnung</th>
                <th style="text-align: left">Menge</th>
                <th style="text-align: left">Einheit</th>
                <th style="text-align: left">Einzelpreis</th>
                <th style="text-align: left">Gesamt</th>
                <th style="text-align: left">MwSt.</th>
                <th style="text-align: left">Brutto</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $bill->positions as $position )
                <tr style="padding: 5px 0 5px 0; text-align: left;">
                    <td style="padding: 5px 0 5px 0; text-align: left;" valign="top">
                        {{ $position->order_number }}
                    </td>
                    <td style="padding: 5px 0 5px 0; text-align: left;">
                        {{ $position->name }}
                    </td>
                    <td style="padding: 5px 0 5px 0; text-align: left;">
                        {{ $position->amount }}
                    </td>
                    <td style="padding: 5px 0 5px 0; text-align: left;">
                        {{ $position->unit }}
                    </td>
                    <td style="padding: 5px 0 5px 0; text-align: left;white-space: nowrap;">
                        {{ number_format($position->netto, 2,',','.') }} €
                    </td>
                    <td style="padding: 5px 0 5px 0; text-align: left;white-space: nowrap;">
                        {{ number_format( ($position->netto * $position->amount), 2,',','.') }} €
                    </td>
                    <td style="padding: 5px 0 5px 0; text-align: left;white-space: nowrap;">
                        {{ number_format( ( $position->vat ), 0,',','.') }} %
                    </td>
                    <td style="padding: 5px 0 5px 0; text-align: left;white-space: nowrap;">
                        {{ number_format(($position->netto * $position->amount ) + ((( $position->netto * $position->amount ) * $position->vat)/100), 2, ',', '.') }} €
                    </td>
                </tr>
                <tr class="border-b border-b-2">
                    <td></td>
                    <td style="padding-left: 0.3cm">
                        <p class="text-xs pb-3">{!! $position->description !!}</p>
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
        <table style="margin-bottom: 2cm;">
            <tr>
                <td style="width: 50%"></td>
                <td>Netto gesamt:</td>
                <td style="text-align: right">{{ $bill->total('netto', 'withSymbol')  }}</td>
            </tr>

            <tr>
                <td style="width: 50%"></td>
                <td>MwSt.:</td>
                <td style="text-align: right">{{ $bill->total('vat', 'withSymbol')  }} €</td>
            </tr>
            <tr>
                <td style="width: 50%"></td>
                <td>Rechnungsbetrag:</td>
                <td style="text-align: right">{{ $bill->total('brutto', 'withSymbol') }} €</td>
            </tr>
        </table>
        <p>{!! $footer !!}</p>
</main>
</body>
</html>
