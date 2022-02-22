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





    public function trackOpen() {

        if ( ! $this->first_opened ) {
            $this->first_opened = \Carbon\Carbon::now();
        }
        $this->opens ++;
        $this->save();

    }





    public function deliverImage() {

        $this->trackOpen();

        $image = Image::canvas( 1, 1 );
        $image->rectangle( 0, 0, 1, 1 );
        header( 'Content-Type: image/png' );
        echo $image->encode( 'png' );
    }


}
