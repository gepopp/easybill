<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Lead extends Model {





    use HasFactory;



    protected $guarded = [];





    protected $with = [ 'contacts' ];





    public function contacts() {

        return $this->hasMany( LeadContact::class );
    }


}
