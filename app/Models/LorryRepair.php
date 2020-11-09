<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LorryRepair extends Model{

    protected $table = 'lorry_repairs';

    public $fillable = [
        'plat_number',
        'image',
        'brand',
        'model',
        'no_chassis',
        'no_engine',
        'class',
        'engine_capacity',
        'registration_date',
        'btm',
        'is_completed',
    ];
}
