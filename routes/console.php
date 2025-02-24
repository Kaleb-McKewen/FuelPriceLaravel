<?php

use Illuminate\Support\Facades\Http;
use App\Models\Fuelprice;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


//Used to get newest data from API and commit to DB
Schedule::call(function () {
    //todays date
    $date = new DateTime;
    $date->setTimezone(new DateTimeZone('Australia/Brisbane'));
    $average = [];

    //change verify in production, only bypassed
    //station names
    $fuelStations = json_decode(Http::withOptions(['verify' => false])->withHeader("Authorization", env("API_AUTHORIZATION"))->get(env("FUEL_STATIONS_URL")));
    //station prices
    $allFuelPrices = json_decode(Http::withOptions(['verify' => false])->withHeader("Authorization", env("API_AUTHORIZATION"))->get(env("FUEL_PRICE_URL")));

    //filter for fuel type and outdated
    $filteredFuelPrices = array_filter($allFuelPrices->SitePrices, function ($obj) use (&$average, $date) {
        if (isset($obj->FuelId)) {
            $fuelDate = new DateTime($obj->TransactionDateUtc);
            $dateDiff = $fuelDate->diff($date)->format("%a");
            //less than a two days old
            if ($dateDiff > 2) {
                return false;
            }
            //fuel type of 95
            if ($obj->FuelId != 5) {
                return false;
            }
            //add to average
            array_push($average, $obj->Price);
            return true;
        }
    });

    //get average
    $average = round((array_sum($average) / count($average)) / 10, 2);

    //sort by cheapest
    usort($filteredFuelPrices, function ($obj1, $obj2) {
        return strcmp($obj1->Price, $obj2->Price);
    });

    //get lowest five stations
    $lowestFive = array_slice($filteredFuelPrices, 0, 5, true);

    $lowest = "";
    //get names for lowest five
    foreach ($lowestFive as $fuelStation) {
        foreach ($fuelStations->S as $stationData) {
            if ($stationData->S == $fuelStation->SiteId) {
                //format date difference string
                $dateChange = "";
                $fuelDate = new DateTime($fuelStation->TransactionDateUtc);
                $dateDiff = $fuelDate->diff($date);
                if ($dateDiff->format('%a') > 1) {
                    $dateChange = $dateDiff->format('%a') . " days ago";
                } else if ($dateDiff->format('%h') > 1) {
                    $dateChange = $dateDiff->format('%h') . " hours ago";
                } else {
                    $dateChange = $dateDiff->format('%i') . " mins ago";
                }
                //format lowest string
                $lowest = $lowest . $stationData->N . ' ' . ($fuelStation->Price / 10) . ' ' . $dateChange . "\r\n";
            };
        }
    }

    //Save new entry to DB
    $fuelEntry = new Fuelprice();
    $fuelEntry->time = $date->format("Y-m-d");
    $fuelEntry->average = $average;
    $fuelEntry->lowest = $lowest;
    $fuelEntry->save();
    //frequency every 6 hours
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
