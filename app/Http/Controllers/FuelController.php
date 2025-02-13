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
        $latestFuelprice = Fuelprice::orderby('time', 'desc')->first()->lowest;

        return view('fuelprice.all', compact('times', 'average_prices', 'latestFuelprice'));
    }
}
