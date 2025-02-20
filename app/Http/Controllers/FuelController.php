<?php

namespace App\Http\Controllers;

use App\Models\Fuelprice;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FuelController extends Controller
{
    public function index()
    {

        $fuelprice = Fuelprice::all();
        $times = "";
        $average_prices = "";
        foreach ($fuelprice as $entry) {
            $times .= $entry->time . ',';
            $average_prices .= $entry->average . ',';
        }
        $latestFuelpriceRaw = Fuelprice::orderby('time', 'desc')->first()->lowest;

        $latestFuelprice = preg_split("/\r\n|\n|\r/", $latestFuelpriceRaw);
        array_pop($latestFuelprice);

        return view('components.all', compact('times', 'average_prices', 'latestFuelprice'));
    }

    public function rawData(Request $request)
    {
        //allowed values for validation
        $allowedColumns = ['time', 'average'];
        $allowedOrders = ['asc', 'desc'];
        //if value is not allowed the previous url will be used
        $validated = $request->validate([
            'sort' => Rule::in($allowedColumns),
            'order' => Rule::in($allowedOrders),
        ]);

        $fuelprices = Fuelprice::select('id', 'time', 'average')->when(request('sort'), function ($query) {
            return $query->orderby(request('sort'), request('order'));
        }, function ($query) {
            return $query->orderby('time', 'desc'); //default
        })->paginate(15);

        return view('components.rawData', compact('fuelprices'));
    }
}
