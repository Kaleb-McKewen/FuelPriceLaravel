<?php
use Illuminate\Support\Facades\Http;
use App\Models\Fuelprice;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function(){
    //API GET
    $response = json_decode(Http::get(env('URL')));
    //Save new entry to DB
    $fuelEntry = new Fuelprice();
    $fuelEntry->time = $response->time;
    $fuelEntry->average = $response->average;
    $fuelEntry->lowest = $response->lowest;
    $fuelEntry->save();
    //update frequency
})->everySixHours();


/*
#Test schedule
Schedule::call(function(){
    $fuelEntry = new Fuelprice();
    $fuelEntry->time = date("Y-m-d");
    $fuelEntry->average = "209.11";
    $fuelEntry->lowest = "7-Eleven Coolum Beach 203.7 14 hours ago
7-Eleven Woombye 203.9 14 hours ago
7-Eleven Nambour 203.9 14 hours ago
BP Forest Glen 205.9 11 hours ago
BP Coolum Beach 205.9 11 hours ago
";
    $fuelEntry->save();
})->everyMinute();
*/
