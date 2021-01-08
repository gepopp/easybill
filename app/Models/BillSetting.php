<?php

namespace App\Models;

use App\Scopes\OwnsScope;
use App\Traits\FormatTextSnippet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillSetting extends Model
{
    use HasFactory, FormatTextSnippet;

    protected $guarded = [];

    protected static function booted()
    {
        static::addGlobalScope(new OwnsScope);
    }


    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function getSetting($name, User $user = null)
    {

        if($user == null){
            $user = Auth::user();
        }

        $defaults = [
            'logo'            => asset('logo-icon.png'),
            'address'         => '',
            'contactperson'   => '',
            'contactphone'    => '',
            'contactemail'    => '',
            'uid'             => '',
            'headertext'      => '',
            'footertext'      => '',
            'prefix'          => 'RE',
            'bill_number'     => 1000,
            'company_name'    => '',
            'footercol_1'     => '',
            'footercol_2'     => '',
            'footercol_3'     => '',
            'desired_respite' => 7,
        ];
        $settings = BillSetting::withoutGlobalScopes()
            ->where('user_id', $user->id)->pluck('setting_value', 'setting_name')
            ->toArray();

        $settings = array_merge($defaults, $settings);

        return $settings[$name];
    }


}
