<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Lorry;
use App\Models\LorryRepair;
use App\Models\LorryService;
use App\Models\LorryTransaction;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $cur_month = [
            'income' => LorryTransaction::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('debit'),
            'expenses' => LorryTransaction::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('credit')
        ];

        $data = [
            'total_lorry' => Lorry::count(),
            'active_lorry' => Lorry::count(),
            'upcoming_service' => LorryService::orderBy('next_service', 'DESC')->limit(5)->get(),
            'recent_repair' => LorryRepair::orderBy('id', 'DESC')->limit(5)->get()
        ];

        return view('frontend.user.dashboard', compact('cur_month', 'data'));
    }
}
