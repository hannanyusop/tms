<?php

use Carbon\Carbon;
use App\Models\Utility;
use App\Models\LorryTransaction;

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

if(!function_exists('insertTransaction')){

    function insertTransaction($lorry_id, $reference_id, $type, $description, $debit, $credit){

        $transaction = new LorryTransaction();

        $transaction->lorry_id = $lorry_id;
        $transaction->reference_id = $reference_id;
        $transaction->type = $type;
        $transaction->description = $description;
        $transaction->debit = $debit;
        $transaction->credit = $credit;

        $transaction->save();

        return true;

    }

}

if(!function_exists('updateTransaction')){

    function updateTransaction($lorry_id, $type, $reference_id, $description = null, $debit = null, $credit = null){

        $transaction = LorryTransaction::where([
            'lorry_id' => $lorry_id,
            'type' => $type,
            'reference_id' => $reference_id
        ])->first();

        if($transaction){

            if($delete){
                $transaction->delete();
                return true;
            }

            if(!is_null($description)){
                $transaction->description = $description;
            }

            if(!is_null($description)){
                $transaction->debit = $debit;
            }

            if((!is_null($description))){
                $transaction->credit = $credit;
            }

            $transaction->save();
            return true;
        }
        return false;
    }

}

if(!function_exists('deleteTransaction')){

    function deleteTransaction($lorry_id, $type, $reference_id){

        LorryTransaction::where([
            'lorry_id' => $lorry_id,
            'type' => $type,
            'reference_id' => $reference_id
        ])->delete();
        return true;
    }

}
