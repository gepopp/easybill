<?php

namespace App\Http\Controllers;

use http\Env\Response;
use App\Models\MailTrack;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use Illuminate\Support\Facades\Log;



class MailTrackController extends Controller
{


    public function track( $mail_track ){

       $track = MailTrack::find($mail_track);


        if ( ! $track->first_opened ) {
            $track->first_opened = \Carbon\Carbon::now();
        }
        $track->opens ++;
        $track->save();


        $this->deliverImage();
    }


    protected function deliverImage(){

        $image = Image::canvas( 100, 100 );
        $image->rectangle( 0, 0, 100, 100, function ($rect){
            $rect->background('#99000');
        });


       echo 'data:image/png;base64,' . base64_encode($image->encode('png'));
       exit;
    }


}
