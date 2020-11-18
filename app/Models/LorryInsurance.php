<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LorryInsurance extends Model{

    protected $table = 'lorry_insurances';

    public function lorry(){
        return $this->hasOne(Lorry::class, 'id', 'lorry_id');
    }
}
