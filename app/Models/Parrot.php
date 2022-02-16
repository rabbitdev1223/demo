<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parrot extends Model
{
    use HasFactory;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'parrots';

    public function breed()
    {
        return $this->belongsTo(Breed::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'registered_by');
    }

    public function male_couple() //couple of male parrot
    {
        return $this->hasOne(Couple::class,'male_id');
    }
    public function female_couple() //couple of female parrot
    {
        return $this->hasOne(Couple::class,'female_id');
    }

    public function getIsCoupleAttribute()
    {
        //check if it is in a couple
        return $this->male_couple || $this->female_couple;
    }

    public function cage(){
        return $this->belongsTo(Cage::class,'cage_id');
    }
}
