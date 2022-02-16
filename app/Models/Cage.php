<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cage extends Model
{
    use HasFactory;
    protected $table = 'cages';

    public function owner(){
        return $this->belongsTo(User::class,'registered_by');
    }

    public function parrots()
    {
        return $this->hasMany(Parrot::class);
    }
}
