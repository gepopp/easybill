<?php

namespace App\Models;

use PDF;
use App\Traits\FormatTextSnippet;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Bill extends Model
{
    use HasFactory, FormatTextSnippet;

    protected $guarded = [];

    protected $with = ['customer', 'positions', 'payments', 'is_storno_of'];


    protected static function booted()
    {
        static::addGlobalScope('owns', function (Builder $builder) {
            $builder->where('user_id', '=', \Auth::id());
        });

        static::addGlobalScope('orderByBillingDate', function(Builder $builder){
           $builder->orderBy('billing_date', 'DESC');
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

    public function has_storno(){
        return $this->hasOne(Bill::class, 'storno_id');
    }

    public function is_storno_of(){
        return $this->belongsTo(Bill::class, 'storno_id');
    }

    public function getFormatedStatusAttribute($key)
    {
        switch ($this->bill_status){
            case 'draft':
                $status = '<span class="text-gray-600">Entwurf</span>';
                break;
            case 'generated':
                $status = '<span class="text-logo-light">erzeugt</span>';
                break;
            case 'sent':
                $status = '<span class="text-logo-terciary">gesendet</span>';
                break;
            case 'paid':
                $status = '<span class="text-logo-primary">bezahlt</span>';
                break;
            case 'overdue':
                $status = '<span class="text-red-600">überfällig</span>';
                break;
            default:
                break;
        }
        return $status;
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

    public function getSettings(User $user = null)
    {
        if($user == null){
            $user = Auth::user();
        }

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
        $settings = BillSetting::withoutGlobalScopes()->where('user_id', $user->id)->pluck('setting_value', 'setting_name')->toArray();
        $settings = array_merge($defaults, $settings);

        $settings['headertext'] = $this->formatBillSnippet($settings['headertext']);
        $settings['footertext'] = $this->formatBillSnippet($settings['footertext']);
        return $settings;
    }

}
