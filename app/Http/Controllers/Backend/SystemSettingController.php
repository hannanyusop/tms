<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;


class SystemSettingController extends Controller
{

    public function index()
    {
        slackSendNotification('tes');
        return view('backend.system.index');
    }
}
