<?php


namespace App\Classes;


use App\Models\User;
use App\Models\Bill;
use App\Models\Customer;
use App\Traits\FormatTextSnippet;

class PdfSnippetFormater
{

    use FormatTextSnippet;

    public User $user;
    public Bill $bill;
    public Customer $customer;

    public function __construct($bill, $customer, $user)
    {
        $this->bill = $bill;
        $this->customer = $customer;
        $this->user = $user;
    }




}
