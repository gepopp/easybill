<?php


namespace App\Traits;


use App\Models\Bill;
use App\Models\Customer;

trait FormatTextSnippet
{


    public function formatBillSnippet($snippet){

        $customer = Customer::withoutGlobalScope('owns')->find($this->customer_id);
        $bill = $this;

        preg_match_all('/\[(.*?)\]/', $snippet, $matches);

        foreach ($matches[0] as $match){

            $trimmed = trim($match, "[] \t\n\r");

            $parts = explode('.', $trimmed);

            if(count($parts) != 2) continue;

            $snippet = str_replace($match, ${$parts[0]}->{$parts[1]}, $snippet);

        }

        return $snippet;

    }

}
