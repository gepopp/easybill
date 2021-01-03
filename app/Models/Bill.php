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

    protected $with = ['customer', 'positions'];


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


    public static function getNextBillNumber()
    {

        $maxBill = Bill::max('bill_number');

        if (empty($maxBill)) {
            $query = BillSetting::where('user_id', Auth::id())->where('setting_name', 'bill_number')->first('setting_value');
            $maxBill = $query->setting_value;
        }

        if(empty($maxBill)){
            $maxBill = 1000;
        }

        $maxBill++;

        return $maxBill;

    }

    public function getNettoTotalAttribute()
    {
        $netto = 0;

        foreach($this->positions as $position){
           $netto += $position->netto * $position->amount;
        }
        return number_format($netto, 2, ',', '.');
    }

    public function getVatTotalAttribute()
    {
        $vat = 0;

        foreach($this->positions as $position){
            $vat += ( ($position->netto * $position->amount) * $position->vat) / 100;
        }
        return number_format($vat, 2, ',', '.');
    }

    public function getBruttoTotalAttribute()
    {
        $brutto = 0;

        foreach($this->positions as $position){
            $brutto += ( ($position->netto * $position->amount ) + ( ( ( $position->netto * $position->amount) * $position->vat) / 100));
        }
        return number_format($brutto, 2, ',', '.');
    }

    public function getPDF()
    {

        if ($this->document == null) {
            ini_set('max_execution_time', 300); // 300 seconds = 5 minutes
            set_time_limit(0);

            // share data to view
            $pdf = PDF::loadView('bill.showpdf', ['bill' => $this, 'settings' => $this->getSettings()]);

            $path = "bills/pdf/RE{$this->bill_number}.pdf";

            Storage::put($path, $pdf->output());

            $this->update([
                'document' => $path,
            ]);
        }


        // download PDF file with download method
        return Storage::temporaryUrl($this->document, now()->addMinutes(1));
    }

    public function getSettings()
    {
        $settings = BillSetting::all()->pluck('setting_value', 'setting_name');
        $settings['headertext'] = view(['template' => htmlspecialchars_decode($settings['headertext'])], ['bill' => $this, 'settings' => $settings]);
        $settings['footertext'] = view(['template' => htmlspecialchars_decode($settings['footertext'])], ['bill' => $this, 'settings' => $settings]);
        return $settings;
    }

}
