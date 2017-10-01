<?php

namespace App\Http\Controllers;

use App\NodeType;
use App\SensorData;
use Illuminate\Http\Request;

use App\Node;

class DataController extends Controller
{
    public function getHome(){
        $nodeTypes = NodeType::all();
        return view('home', ["nodeTypes" => $nodeTypes]);
    }

    public function getData(Request $request){
        return $request->all();
    }

    public function filterData(Request $request){
        if($request->ajax()){

            foreach(request()->query() as $attribute => $value) {
                if($attribute == 'node_type_id'){
                    if($value == 'all'){
                        $collection = Node::all();
                    }else{
                        $collection = Node::where($attribute, $value)->get();
                    }

                    $collection = $this->getCustomNodesResponse($collection);
                }
            }

            return $collection;

        }
    }

    function getCustomNodesResponse($collection){
        $data = [];

        foreach($collection as $obj){
            $data[] = [
                'id' => $obj->id,
                'name' => $obj->name,
                'location' => $obj->location,
                'latitude' => $obj->coordinates[0],
                'longitude' => $obj->coordinates[1],
                'status' => $obj->status,
                'node_type' => $obj->node_type
            ];
        }

        return $data;
    }
}
