<?php

namespace App\Jobs;

use PDF;
use App\Models\Bill;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
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
        Auth::login($this->user, false);

        $bill = $this->bill->refresh();

        Bill::withoutEvents(function () use ($bill) {
            $bill->update([
                'document' => 'processing',
            ]);
        });

        if ($this->bill->document != null) {
            Storage::delete($this->bill->document);
        }
        // share data to view
        $pdf = PDF::loadView('bill.showpdf', ['bill' => $this->bill, 'settings' => $this->bill->getSettings()]);

        $path = "bills/pdf/RE{$this->bill->bill_number}.pdf";

        Storage::put($path, $pdf->output());


        Bill::withoutEvents(function () use ($bill, $path) {
            $bill->update([
                'document' => $path,
            ]);
        });
    }


    public function failed(){

        \Auth::login($this->user, false);

        $bill = $this->bill->refresh();

        Bill::withoutEvents(function () use ($bill) {
            $bill->update([
                'document' => 'failed',
            ]);
        });


    }

}
