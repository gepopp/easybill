<?php

namespace App\Http\Controllers;

use App\Models\MailTrack;
use Illuminate\Http\Request;
use Intervention\Image\Image;



class MailTrackController extends Controller
{


    public function track(MailTrack $mail_track){

        if ( ! $mail_track->first_opened ) {
            $mail_track->first_opened = \Carbon\Carbon::now();
        }
        $mail_track->opens ++;
        $mail_track->save();


        $this->deliverImage();
    }


    protected function deliverImage(){

        $image = Image::canvas( 100, 100 );
        $image->rectangle( 0, 0, 100, 100, function ($rect){
            $rect->background('#99000');
        });
        header( 'Content-Type: image/png' );
        echo $image->encode( 'png' );
    }


}
