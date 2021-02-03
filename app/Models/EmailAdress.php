<?php

namespace App\Models;

use App\Scopes\OwnsScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailAdress extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::addGlobalScope( new OwnsScope );
    }

    public function emailalble(){
        $this->morphTo('emailable');
    }

}
