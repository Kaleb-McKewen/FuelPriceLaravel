<?php

namespace App\Http\Controllers;

use App\Models\Fuelprice;
use Illuminate\Http\Request;

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
}
