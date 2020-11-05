<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utility extends Model{

    public static function settings(){

        $settings = [
            "notification_type" => "slack",
            "noty_slack_webhook" => "",
            "noty_slack_channel" => "",
            "noty_slack_username" => "",
            "noty_slack_icon_emoji" => ":ghost:",
        ];

        $data = Option::get();


        foreach ($data as $row){
            $settings[$row->name] = $row->value;
        }

        return $settings;
    }

    public static function getValByName($key)
    {
        $setting = Utility::settings();

        if(!isset($setting[$key]) || empty($setting[$key]))
        {
            $setting[$key] = '';
        }

        return $setting[$key];
    }
}
