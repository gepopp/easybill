<?php


namespace App\Traits;


use App\Models\Bill;
use App\Models\Customer;
use App\Scopes\OwnsScope;

trait FormatTextSnippet
{


    public function formatBillSnippet($snippet){

        $caller = explode('\\', get_called_class());
        $caller = array_pop($caller);

        $customer = Customer::withoutGlobalScope(OwnsScope::class)->find($this->bill->customer_id);
        $bill = $this;

        preg_match_all('/\[(.*?)\]/', $snippet, $matches);

        foreach ($matches[0] as $match){

            $trimmed = trim($match, "[] \t\n\r");

            $parts = explode('.', $trimmed);

            if(count($parts) != 2) continue;

            if($parts[0] == $caller){
                $snippet = str_replace($match, ${$parts[0]}->{$parts[1]}, $snippet);
            }else{
                $snippet = str_replace($match, $this->{$parts[0]}->{$parts[1]}, $snippet);
            }



        }

        return $snippet;

    }

}
