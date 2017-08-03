<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Node;

class DataController extends Controller
{
    public function getHome(){
        $nodes = Node::all();
        return view('home', ['nodes' => $nodes]);
    }

    public function downloadData(Request $request){
        return $request->all();
    }
}
