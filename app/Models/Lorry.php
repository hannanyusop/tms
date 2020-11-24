<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lorry extends Model{

    protected $fillable = [
        'loan_balance'
    ];

    protected $table = 'lorries';

    public function latestInsurance(){
        return $this->hasOne(LorryInsurance::class, 'lorry_id', 'id')
            ->orderBy('id', 'DESC');
    }

    public function insurances(){
        return $this->hasMany(LorryInsurance::class, 'lorry_id', 'id')
            ->orderBy('id', 'DESC')->get();
    }

    public function latestService(){
        return $this->hasOne(LorryService::class, 'lorry_id', 'id')
            ->orderBy('id', 'DESC');
    }

    public function services(){
        return $this->hasMany(LorryService::class, 'lorry_id', 'id')
            ->orderBy('id', 'DESC')->get();
    }

    public function latestRepair(){
        return $this->hasOne(LorryRepair::class, 'lorry_id', 'id')
            ->orderBy('id', 'DESC');
    }

    public function repairs(){
        return $this->hasMany(LorryRepair::class, 'lorry_id', 'id')
            ->orderBy('id', 'DESC')->get();
    }

    public function latestInstallment(){
        return $this->hasOne(LorryInstallment::class, 'lorry_id', 'id')
            ->orderBy('id', 'DESC');
    }

    public function installments(){
        return $this->hasMany(LorryInstallment::class, 'lorry_id', 'id')
            ->orderBy('id', 'DESC')->get();
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
