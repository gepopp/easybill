<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadContact extends Model
{
    use HasFactory, Notifiable;


    protected $guarded = [];


    protected $with = ['mails'];


    public function lead(){
        return $this->belongsTo(Lead::class);
    }


    public function mails(){
        return $this->morphMany(MailTrack::class, 'recipient');
    }


}
