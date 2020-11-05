<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Utility;


class SystemSettingController extends Controller
{

    public function index()
    {

        $settings = Utility::settings();

        return view('backend.system.index', compact('settings'));
    }

    public function saveSystem(){

        session(['active_tab' => 'system']);

        return redirect()->back()->withFlashSuccess('System settings saved.');

    }


    public function saveNotification(){

        session(['active_tab' => 'notification']);

        return redirect()->back()->withFlashSuccess('Notification settings saved.');


    }

    public function testingSlack(){

       $send =  slackSendNotification("Test notification by : ".auth()->user()->name);

       if($send == "ok"){

           return redirect()->back()->withFlashSuccess('Successfully send notification via SLACK');
       }else{
           return redirect()->back()->withFlashError('Failed to send notification via SLACK!');

       }
    }
}
