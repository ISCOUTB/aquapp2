<?php

namespace App\Http\Controllers;

use App\NodeType;
use Illuminate\Http\Request;

use App\Node;

class DataController extends Controller
{
    public function getHome(){
        $nodes = Node::all();
        $nodeTypes = NodeType::all();

        return view('home', ['nodes' => $nodes, "nodeTypes" => $nodeTypes]);
    }

    public function downloadData(Request $request){
        return $request->all();
    }
}
