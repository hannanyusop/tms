<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Lorry;
use App\Models\LorryRepair;
use App\Models\LorryService;
use App\Models\LorryTransaction;
use Carbon\Carbon;

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

        $from = Carbon::now()->subDays(14);
        do{

            $date_15[] = $from->format('d M');
            $exp_15[] = LorryTransaction::whereDate('created_at', $from)->sum('credit');
            $inc_15[] = LorryTransaction::whereDate('created_at', $from)->sum('debit');

            $from->addDay();

        }while($from <= Carbon::now());

        $data = [
            'total_lorry' => Lorry::count(),
            'active_lorry' => Lorry::count(),
            'upcoming_service' => LorryService::orderBy('next_service', 'DESC')->limit(3)->get(),
            'recent_repair' => LorryRepair::orderBy('id', 'DESC')->limit(5)->get(),
            'date_15' => $date_15,
            'exp_15' => $exp_15,
            'inc_15' => $inc_15,
            'transactions' => LorryTransaction::orderBy('created_at', 'ASC')->limit(15)->get()
        ];

        return view('frontend.user.dashboard', compact('cur_month', 'data'));
    }
}
