<?php

namespace App\Http\Controllers;

use App\Models\Fuelprice;

class FuelController extends Controller
{
    public function index(){

        $fuelprice = Fuelprice::all();
        $times = "";
        $average_prices = "";
        foreach($fuelprice as $entry){
            $times .= $entry->time.',';
            $average_prices .=$entry->average.',';
        }
        $latestFuelpriceRaw = Fuelprice::orderby('time', 'desc')->first()->lowest;

        $latestFuelprice = preg_split("/\r\n|\n|\r/", $latestFuelpriceRaw);
        array_pop($latestFuelprice);
        
        return view('components.all', compact('times', 'average_prices', 'latestFuelprice'));
    }

    public function rawData(){

        $fuelprices = Fuelprice::select('id','time','average')->orderby('time', 'desc')->paginate(15);
        
        return view('components.rawData', compact('fuelprices'));
    }
}
