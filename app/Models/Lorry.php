<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lorry extends Model{

    protected $table = 'lorries';

    public function latestInsurance(){
        return $this->hasOne(LorryInsurance::class, 'lorry_id', 'id')
            ->orderBy('id', 'DESC');
    }

    public function insurances(){
        return $this->hasMany(LorryInsurance::class, 'lorry_id', 'id')
            ->where('id', 'DESC')->get();
    }

    public function latestServices(){
        return $this->hasOne(LorryService::class, 'lorry_id', 'id')
            ->orderBy('id', 'DESC');
    }

    public function services(){
        return $this->hasMany(LorryService::class, 'lorry_id', 'id')
            ->where('id', 'DESC')->get();
    }

    public function latestRepair(){
        return $this->hasOne(LorryRepair::class, 'lorry_id', 'id')
            ->orderBy('id', 'DESC');
    }

    public function repairs(){
        return $this->hasMany(LorryRepair::class, 'lorry_id', 'id')
            ->where('id', 'DESC')->get();
    }

    public function transactions(){
        return $this->hasMany(LorryTransaction::class,'lorry_id', 'id');
    }

    public function totalCredit(){

        return $this->hasMany(LorryTransaction::class,'lorry_id', 'id')->sum('credit');
    }

    public function totalDebit(){

        return $this->hasMany(LorryTransaction::class,'lorry_id', 'id')->sum('debit');
    }
}
