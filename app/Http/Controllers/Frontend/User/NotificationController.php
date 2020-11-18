<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Utility;

/**
 * Class DashboardController.
 */
class NotificationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tutorial()
    {
        $type = Utility::getValByName('notification_type');

        return view('frontend.user.notification.tutorial', compact('type'));
    }
}
