<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceItem extends Model{

    protected $table = 'service_items';

    public function service(){

        return $this->hasOne(LorryService::class, 'id', 'lorry_service_id');
    }
}
