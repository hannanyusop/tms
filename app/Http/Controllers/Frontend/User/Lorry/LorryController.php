<?php

namespace App\Http\Controllers\Frontend\User\Lorry;

use App\Http\Controllers\Controller;
use App\Models\Lorry;

/**
 * Class DashboardController.
 */
class LorryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $lorries = Lorry::paginate(10);
        return view('frontend.user.lorry.index', compact('lorries'));
    }
}
