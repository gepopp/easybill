<?php

namespace App\Models;

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
        return $netto;
    }

    public function getVatTotalAttribute()
    {
        $vat = 0;

        foreach($this->positions as $position){
            $vat += ( ($position->netto * $position->amount) * $position->vat) / 100;
        }
        return $vat;
    }

    public function getBruttoTotalAttribute()
    {
        $brutto = 0;

        foreach($this->positions as $position){
            $brutto += ( ($position->netto * $position->amount ) + ( ( ( $position->netto * $position->amount) * $position->vat) / 100));
        }
        return $brutto;
    }
}
