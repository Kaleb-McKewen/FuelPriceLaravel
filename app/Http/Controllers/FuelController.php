<?php

namespace App\Http\Controllers;

use App\Models\Fuelprice;
use Illuminate\Http\Request;

class FuelController extends Controller
{
    public function index(){

        $fuelprice = Fuelprice::all();


        return view('fuelprice.all', ['fuelprice'=>$fuelprice]);
    }
}
