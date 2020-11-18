<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LorryRepair extends Model{

    protected $table = 'lorry_repairs';

    public $fillable = [
        'amount',
    ];

    public function lorry(){

        return $this->hasOne(Lorry::class, 'id', 'lorry_id');
    }

    public function items(){

        return $this->hasMany(RepairItem::class, 'lorry_repair_id', 'id');
    }
}
