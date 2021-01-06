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


    public function getAddressHtml()
    {
        ob_start();
        ?>
            <address>
                <strong><?php echo $this->company_name ?></strong><br>
                <?php echo $this->academic_degree ?> <?php echo $this->first_name ?> <?php echo $this->last_name ?><br>
                <?php echo $this->address ?> <?php echo $this->address_addition ?><br>
                <?php echo $this->zip ?> <?php echo $this->city ?>
            </address>

        <?php
        return ob_get_clean();
    }

    public function getAnredeAttribute(){
        if($this->is_female){
            return 'Sehr geehrte Frau';
        }
        return 'Sehr geehrter Herr';

    }

}
