<?php

namespace App\Http\Livewire\Billsettings;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Models\BillSetting;

class SenderAddress extends Component
{

    use WithFileUploads;

    public $settings = [
      'logo' => '',
      'address' => '',
      'contactperson' => '',
      'contactphone' => '',
      'contactemail' => '',
      'desired_respite' => 0,
      'uid' => '',
      'headertext' => '',
      'footertext' => '',
      'prefix' => 'RE-',
      'bill_number' => 1000,
      'company_name' => '',
      'footercol_1' => '',
      'footercol_2' => '',
      'footercol_3' => '',
    ];

    protected $rules = [
        'settings.logo' => 'required',
        'settings.company_name' => 'required',
        'settings.prefix' => 'required',
        'settings.address' => 'required|min:20',
        'settings.contactperson' => 'required',
        'settings.contactphone' => 'required',
        'settings.contactemail' => 'required|email',
        'settings.desired_respite' => 'required|integer|min:3|max:365',
        'settings.bill_number' => 'required|integer|min:1',
        'settings.uid' => 'required',
        'settings.headertext' => 'required',
        'settings.footertext' => 'required',
        'settings.footercol_1' => 'required',
        'settings.footercol_2' => 'required',
        'settings.footercol_3' => 'required',

    ];


    public function mount(){


        foreach ($this->settings as $key => $setting){
            $this->settings[$key] = DB::table('bill_settings')->where('user_id', \Auth::id())->where('setting_name', $key)->value('setting_value');
        }

    }


    public function updatewysiwyg($text, $field){
        $this->settings[$field] = $text;
    }



    public function updateSettings(){


        foreach ($this->settings as $key => $value) {

            $setting = BillSetting::firstOrCreate([
                'user_id' => \Auth::id(),
                'setting_name' => $key
            ]);



            if($key == 'logo'){

                if(!is_string($value))
                $setting->setting_value = $value->store('logos');

            }else{
                $setting->setting_value = $value;
            }

            $setting->save();
        }

        $this->emit('saved');

    }


    public function render()
    {
        return view('livewire.billsettings.sender-address');
    }
}
