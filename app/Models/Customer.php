<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];


    protected static function booted()
    {
        static::addGlobalScope('owns', function (Builder $builder) {
            $builder->where('user_id', '=', \Auth::id());
        });
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getFullnameAttribute(){

        if(isset($this->academic_degree)){
            $name = $this->academic_degree . ' ';
        }else{
            $name = '';
        }
        $name .= $this->first_name . ' ';
        $name .= $this->last_name;

        return $name;

    }

    public function getAnredeAttribute(){
        if($this->is_female){
            return 'Sehr geehrte Frau';
        }
        return 'Sehr geehrter Herr';

    }

}
