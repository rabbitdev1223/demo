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
}
