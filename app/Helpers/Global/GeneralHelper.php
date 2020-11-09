<?php

use Carbon\Carbon;
use App\Models\Utility;

if (! function_exists('appName')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function appName()
    {
        return config('app.name', 'Laravel Boilerplate');
    }
}

if (! function_exists('carbon')) {
    /**
     * Create a new Carbon instance from a time.
     *
     * @param $time
     *
     * @return Carbon
     * @throws Exception
     */
    function carbon($time)
    {
        return new Carbon($time);
    }
}

if (! function_exists('homeRoute')) {
    /**
     * Return the route to the "home" page depending on authentication/authorization status.
     *
     * @return string
     */
    function homeRoute()
    {
        if (auth()->check()) {
            if (auth()->user()->isAdmin()) {
                return 'admin.dashboard';
            }

            if (auth()->user()->isUser()) {
                return 'frontend.user.dashboard';
            }
        }

        return 'frontend.index';
    }
}

if(!function_exists('notificationTypes')){

    function notificationTypes(){

        $types = [
            'slack' => true,
            'email' => true,
            'sms' => false,
            'whatsapp' => false
        ];

        return $types;
    }
}

if(! function_exists('slackSendNotification')){

    function slackSendNotification($message){


        $data = array(
            'channel'     => Utility::getValByName('noty_slack_channel'),
            'username'    => Utility::getValByName('noty_slack_username'),
            'text'        => $message,
            'icon_emoji'  => Utility::getValByName('noty_slack_icon_emoji'),
        );

        $data_string = json_encode($data);


        $ch = curl_init(Utility::getValByName('noty_slack_webhook'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );

        $result = curl_exec($ch);

        return $result;
    }
}

if(!function_exists('displayPrice')){

    function displayPrice($price){

        return "RM".number_format($price,'2');
    }
}
