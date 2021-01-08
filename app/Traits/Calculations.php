<?php


namespace App\Traits;


trait Calculations
{

    /**
     * @param $object
     * @return float|int
     */
    public function nettoAmount($object){

        $amount = $object->amount ?? 1;
        return $object->netto * $amount;

    }

    /**
     * @param $object
     * @return float|int
     */
    public function vatAmount($object)
    {
        return ( $this->nettoAmount($object) * $object->vat ) / 100;
    }


    /**
     * @param $object
     * @return float|int
     */
    public function bruttoAmount($object)
    {
        return $this->nettoAmount($object) + $this->vatAmount($object);

    }


}
