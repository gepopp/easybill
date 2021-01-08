<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Bill;
use Livewire\Component;
use App\Models\Customer;
use App\Models\BillSetting;
use Illuminate\Support\Facades\Validator;

class NewBillModalForm extends Component
{
    public $billing_date;
    public $prefix;
    public $bill_number;
    public $customer_id;
    public $respite;

    protected $rules = [
        'billing_date' => 'required|date|after_or_equal:today',
        'prefix'       => 'required|alpha|max:5',
        'bill_number'  => 'required|numeric|unique:bills,bill_number',
        'customer_id'  => 'required|numeric|exists:customers,id',
        'respite'      => 'required|integer|min:1',
    ];

    protected $listeners = ['customer_selected'];

    public function customer_selected($id)
    {
        $this->customer_id = $id;
    }


    public function mount()
    {
        $this->billing_date     = Carbon::now()->format('Y-m-d');
        $this->respite          = BillSetting::getSetting('desired_respite');
        $this->prefix           = BillSetting::getSetting('prefix');
        $this->bill_number      = Bill::getNextBillNumber();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function createBill()
    {
        $this->increaseBillNumber();

        $data = $this->validate();

        $data['user_id'] = \Auth::id();
        $data['bill_status'] = 'draft';

        $bill = Bill::create($data);

        return redirect()->route('bills.edit', $bill);
    }



    protected function increaseBillNumber(){

        $validator = Validator::make(['bill_number' => $this->bill_number], ['bill_number' => 'unique:bills,bill_number']);
        if ($validator->fails()) {
            $this->bill_number = Bill::getNextBillNumber();
            $this->increaseBillNumber();
        }

    }

    public function render()
    {
        return view('livewire.bill.new-bill-modal-form');
    }
}
