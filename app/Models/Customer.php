<?php

namespace App\Models;

use Cassandra\Custom;
use App\Observers\CustomerObserver;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $guarded = [];

    protected $with = ['company'];

    protected static function booted()
    {
        static::addGlobalScope('owns', function (Builder $builder) {
            $builder->where('user_id', '=', \Auth::id());
            $builder->orderBy('created_at', 'DESC');
        });

        Customer::observe(CustomerObserver::class);
    }


    public function scopeIsParent($query)
    {
        $query->where('company_id', NULL);
    }

    public function scopeIsCompany($query)
    {
        $query->where('is_company', true);
    }

    public function scopeBillable($query)
    {
        $query->whereNotNull('email');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function contactperson()
    {
        return $this->hasMany(Customer::class, 'company_id');
    }


    public function company()
    {
        return $this->belongsTo(Customer::class, 'company_id');
    }

    public function getFullnameAttribute()
    {

        if ($this->is_company) {
            return $this->company_name;
        }


        if (isset($this->academic_degree)) {
            $name = $this->academic_degree . ' ';
        } else {
            $name = '';
        }
        if (!empty($this->first_name)) {
            $name .= $this->first_name . ' ';
        }
        $name .= $this->last_name;

        return $name;

    }



    public function getAnredeAttribute()
    {
        if ($this->is_female) {
            return 'Sehr geehrte Frau';
        }
        return 'Sehr geehrter Herr';
    }
}
