<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\LorryTransaction;
use App\Models\Utility;

/**
 * Class DashboardController.
 */
class TransactionController extends Controller
{

    public function index($lorry_id = null){

        $query = LorryTransaction::query();

        if(!is_null($lorry_id)){
            $query->where('lorry_id', $lorry_id);
        }

        $transactions = $query->orderBy('created_at', 'DESC')->paginate(20);


        return view('frontend.user.transaction.index', compact('transactions'));
    }

}
