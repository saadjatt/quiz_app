<?php

namespace Database\Seeders;

use App\Models\SystemSetting;
use Illuminate\Database\Seeder;

class SystemSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SystemSetting::query()->updateOrInsert(['label' => 'Name', 'key' => 'name'],['label' => 'Name', 'key' => 'name', 'value' => 'bilal', 'type' => "text", "show_home" => "1", "required"=> "1", "position"=> "1"]);
        SystemSetting::query()->updateOrInsert(['label' => 'Slider', 'key' => 'slider'],['label' => 'Slider', 'key' => 'slider', 'value' => '0', 'type' => "switch", "show_home" => "1", "required"=> "0", "position"=> "2"]);
        SystemSetting::query()->updateOrInsert(['label' => 'Paypal Client ID', 'key' => 'paypal_client_id'],['label' => 'Paypal Client ID', 'key' => 'paypal_client_id', 'value' => '', 'type' => "text", "show_home" => "1", "required"=> "1", "position"=> "3"]);
        SystemSetting::query()->updateOrInsert(['label' => 'Mail', 'key' => 'mail'],['label' => 'Mail', 'key' => 'mail', 'value' => 'support@findmeapps.com', 'type' => "text", "show_home" => "1", "required"=> "1", "position"=> "4"]);
        SystemSetting::query()->updateOrInsert(['label' => 'Skype', 'key' => 'skype'],['label' => 'Skype', 'key' => 'skype', 'value' => 'test@findmeapps.com', 'type' => "text", "show_home" => "1", "required"=> "1", "position"=> "5"]);
        SystemSetting::query()->updateOrInsert(['label' => 'Facebook', 'key' => 'facebook'],['label' => 'Facebook', 'key' => 'facebook', 'value' => 'https://facebook.com', 'type' => "text", "show_home" => "1", "required"=> "1", "position"=> "6"]);
        SystemSetting::query()->updateOrInsert(['label' => 'G-Mail', 'key' => 'gmail'],['label' => 'G-Mail', 'key' => 'gmail', 'value' => 'https://goole.com', 'type' => "text", "show_home" => "1", "required"=> "1", "position"=> "7"]);
        SystemSetting::query()->updateOrInsert(['label' => 'LinkedIn', 'key' => 'linkedIn'],['label' => 'LinkedIn', 'key' => 'linkedIn', 'value' => 'https://linkedin.com', 'type' => "text", "show_home" => "1", "required"=> "1", "position"=> "8"]);
        SystemSetting::query()->updateOrInsert(['label' => 'Youtube', 'key' => 'youtube'],['label' => 'Youtube', 'key' => 'youtube', 'value' => 'https://youtube.com', 'type' => "text", "show_home" => "1", "required"=> "1", "position"=> "9"]);
    }
}
