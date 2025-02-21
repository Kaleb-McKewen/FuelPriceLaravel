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
        $time = $fuelprice->last()->time;
        $price = $fuelprice->last()->average;
        foreach ($fuelprice as $entry) {
            $times .= $entry->time . ',';
            $average_prices .= $entry->average . ',';
        }
        $lowestFuelstationsRaw = Fuelprice::orderby('time', 'desc')->first()->lowest;

        $lowestFuelstations = preg_split("/\r\n|\n|\r/", $lowestFuelstationsRaw);
        array_pop($lowestFuelstations);

        return view('components.all', compact('times', 'average_prices', 'lowestFuelstations', 'time', 'price'));
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

    public function show(Fuelprice $fuelprice){
        $lowestFuelstations = preg_split("/\r\n|\n|\r/", $fuelprice->lowest);
        array_pop($lowestFuelstations);
        return view('components.rawDataIndividual', compact('fuelprice', 'lowestFuelstations'));
    }
}
