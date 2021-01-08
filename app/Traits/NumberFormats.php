<?php


namespace App\Traits;


trait NumberFormats
{

    public function rounded($number){
        return round($number, 2);
    }

    public function euro($number){
        return number_format($number, 2, ',', '.');
    }

    public function withSymbol($number){
        return $this->euro($number) . ' €';
    }


}
