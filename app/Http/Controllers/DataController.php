<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    public function getHome(){
        return view('home');
    }

    public function downloadData(Request $request){
        dd($request->all());
    }
}
