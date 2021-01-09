<?php

namespace App\Models;

use App\Scopes\OwnsScope;
use App\Scopes\OrderByBillingDateScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFlash extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::addGlobalScope( new OwnsScope );
    }


    public function user(){
        return $this->belongsTo(User::class);
    }

}
