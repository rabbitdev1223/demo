<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Couple extends Model
{
    protected $table = 'couple';
    use HasFactory;

    public function male()
    {
        return $this->belongsTo(Parrot::class,'male_id');
    }

    public function female(){
        return $this->belongsTo(Parrot::class,'female_id');
    }

    
}
