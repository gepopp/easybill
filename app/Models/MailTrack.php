<?php

namespace App\Models;

use Intervention\Image\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class MailTrack extends Model {





    use HasFactory;



    protected $guarded = [];





    public function recipient() {

        return $this->morphTo( 'recipient' );
    }





}
