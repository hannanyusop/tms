<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LorryRepair extends Model{

    protected $table = 'lorry_repairs';

    public $fillable = [
        'amount',
    ];
}
