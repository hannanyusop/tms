<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LorryService extends Model{

    protected $table = 'lorry_services';

    protected $fillable = ['amount'];

    public function lorry(){

        return $this->hasOne(Lorry::class, 'id', 'lorry_id');
    }

    public function items(){

        return $this->hasMany(ServiceItem::class, 'lorry_service_id', 'id');
    }
}
