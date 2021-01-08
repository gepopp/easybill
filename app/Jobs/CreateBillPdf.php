<?php

namespace App\Jobs;

use PDF;
use App\Models\Bill;
use App\Models\User;
use App\Models\Customer;
use App\Scopes\OwnsScope;
use App\Models\BillSetting;
use Illuminate\Bus\Queueable;
use App\Classes\PdfSnippetFormater;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateBillPdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Bill $bill;
    protected User $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Bill $bill, User $user)
    {
        $this->bill = $bill;
        $this->user = $user;


    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->bill->update(['document' => 'processing']);
        $customer = Customer::withoutGlobalScopes()->find($this->bill->customer_id);

        $formatter = new PdfSnippetFormater($this->bill, $customer, $this->user );

        Storage::delete($this->bill->document);

        $pdf = PDF::loadView('bill.basepdf',
            [
                'bill'     => $this->bill,
                'customer' => $customer,
                'user'     => $this->user,
                'header'   => $formatter->formatBillSnippet(BillSetting::getSetting('headertext', $this->user)),
                'footer'   => $formatter->formatBillSnippet(BillSetting::getSetting('footertext', $this->user)),
                'footercol_1'   => $formatter->formatBillSnippet(BillSetting::getSetting('footercol_1', $this->user)),
                'footercol_2'   => $formatter->formatBillSnippet(BillSetting::getSetting('footercol_2', $this->user)),
                'footercol_3'   => $formatter->formatBillSnippet(BillSetting::getSetting('footercol_3', $this->user)),
            ]);

        $path = "bills/pdf/{$this->user->id}/RE{$this->bill->bill_number}.pdf";
        Storage::put($path, $pdf->output());

        $this->bill->update(['generated_at' => now(), 'document' => $path]);
    }


    public function failed()
    {
       $this->bill->update(['document' => 'failed']);
    }

}
