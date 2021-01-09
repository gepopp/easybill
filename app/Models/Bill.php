<?php

namespace App\Models;

use PDF;
use App\Scopes\OwnsScope;
use App\Traits\Calculations;
use App\Traits\NumberFormats;
use App\Traits\FormatTextSnippet;
use Illuminate\Support\Facades\Storage;
use App\Scopes\OrderByBillingDateScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Bill extends Model
{
    use HasFactory, NumberFormats, Calculations;

    protected $guarded = [];

    protected $with = ['customer', 'positions', 'payments', 'is_storno_of', 'notifications'];




    protected static function booted()
    {
        static::addGlobalScope( new OwnsScope );
        static::addGlobalScope(new OrderByBillingDateScope);
    }

    /********************************************/
    /********* RELATIONS  ***********************/
    /********************************************/

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

    public function notifications(){
        return $this->morphMany(UserEmailNotification::class, 'about');
    }


    /**
     * returns the amount of all payments
     *
     * @param string $format
     * @return mixed
     */
    public function paid($format = 'rounded')
    {
        $amount = 0;
        foreach ($this->payments as $payment) {
            $amount += $payment->amount;
        }
        return $this->{$format}($amount);

    }


    /**
     * sum up the values of billPositions
     *
     * @param        $column
     * @param string $format
     * @return mixed
     */
    public function total($column, $format = 'rounded'){

        $total = 0;
        foreach ($this->positions as $position) {
            $total += $this->{$column . 'Amount'}($position);
        }
        return $this->{$format}($total);

    }


    /**
     * get incremented max of bill numbers
     *
     * @return int
     */
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


}
