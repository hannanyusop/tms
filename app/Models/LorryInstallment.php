<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LorryInstallment extends Model{

    protected $table = 'lorry_installments';

    public $fillable = [
        'lorry_id',
        'date',
        'amount',
        'loan_balance'
    ];

    public function lorry(){

        return $this->hasOne(Lorry::class, 'id', 'lorry_id');
    }
}
