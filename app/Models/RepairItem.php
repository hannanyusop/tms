<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepairItem extends Model{

    protected $table = 'repair_items';

    public function repair(){
        return $this->hasOne(LorryRepair::class, 'id', 'lorry_repair_id');
    }
}
