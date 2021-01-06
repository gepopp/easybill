<?php

namespace App\Models;

use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Bill extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['customer', 'positions', 'payments'];


    protected static function booted()
    {
        static::addGlobalScope('owns', function (Builder $builder) {
            $builder->where('user_id', '=', \Auth::id());
        });
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function positions()
    {
        return $this->hasMany(BillPosition::class);
    }

    public function payments()
    {
        return $this->hasMany(BillPayment::class);
    }


    public function getPaidAttribute()
    {

        return number_format($this->getUnformatedPaidAttribute(), 2, ',', '.');

    }

    public function getUnformatedPaidAttribute()
    {

        $amount = 0;
        foreach ($this->payments as $payment) {
            $amount += $payment->amount;
        }
        return $amount;

    }


    public function getNettoTotalAttribute()
    {
        return number_format($this->getUnformatedNettoTotalAttribute(), 2, ',', '.');
    }

    public function getUnformatedNettoTotalAttribute()
    {
        $netto = 0;

        foreach ($this->positions as $position) {
            $netto += $position->netto * $position->amount;
        }
        return round($netto, 2 );
    }


    public function getVatTotalAttribute()
    {
        return number_format($this->getUnformatedVatTotalAttribute(), 2, ',', '.');
    }

    public function getUnformatedVatTotalAttribute()
    {
        $vat = 0;

        foreach ($this->positions as $position) {
            $vat += (($position->netto * $position->amount) * $position->vat) / 100;
        }
        return round($vat, 2 );
    }


    public function getBruttoTotalAttribute()
    {
        return number_format($this->getUnformatedBruttoTotalAttribute(), 2, ',', '.');
    }

    public function getUnformatedBruttoTotalAttribute()
    {
        $brutto = 0;

        foreach ($this->positions as $position) {
            $brutto += (($position->netto * $position->amount) + ((($position->netto * $position->amount) * $position->vat) / 100));
        }
        return round($brutto, 2 );
    }


    public static function getNextBillNumber()
    {

        $maxBill = Bill::max('bill_number');

        if (empty($maxBill)) {
            $query = BillSetting::where('user_id', Auth::id())->where('setting_name', 'bill_number')->first('setting_value');
            $maxBill = $query->setting_value;
        }

        if (empty($maxBill)) {
            $maxBill = 1000;
        }

        $maxBill++;

        return $maxBill;

    }

    public function createPdf()
    {
        return Storage::temporaryUrl($this->document, now()->addMinutes(1));
    }

    public function getSettings()
    {
        $defaults = [
            'logo'            => asset('logo-icon.png'),
            'address'         => '',
            'contactperson'   => '',
            'contactphone'    => '',
            'contactemail'    => '',
            'uid'             => '',
            'headertext'      => '',
            'footertext'      => '',
            'prefix'          => 'RE',
            'bill_number'     => 1000,
            'company_name'    => '',
            'footercol_1'     => '',
            'footercol_2'     => '',
            'footercol_3'     => '',
            'desired_respite' => 7,
        ];
        $settings = BillSetting::all()->pluck('setting_value', 'setting_name')->toArray();
        $settings = array_merge($defaults, $settings);

        $settings['headertext'] = view(['template' => htmlspecialchars_decode($settings['headertext'])], ['bill' => $this, 'settings' => $settings]);
        $settings['footertext'] = view(['template' => htmlspecialchars_decode($settings['footertext'])], ['bill' => $this, 'settings' => $settings]);
        return $settings;
    }

}
