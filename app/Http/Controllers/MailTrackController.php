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


        return response()->file( public_path('images/pixel.png'), ['Content-Type' => 'image/png']);
    }

}
