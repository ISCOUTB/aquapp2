<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Node;
use App\NodeType;
use App\SensorData;

class DataController extends Controller
{
    public function getHome()
    {
        $nodeTypes = NodeType::all();
        return view('home', ["nodeTypes" => $nodeTypes]);
    }

    public function filterData(Request $request)
    {
        if($request->ajax())
        {
            if ($request->has('node_type_id'))
            {
                $nodeTypeId = $request->input('node_type_id');
                if($nodeTypeId == 'all')
                {
                    $collection = Node::all();
                }else{
                    $collection = Node::where('node_type_id', $nodeTypeId)->get();
                }
                $collection = $this->getCustomNodesResponse($collection);
            }
            else if ($request->has(['node_id', 'variable', 'start_date', 'end_date']))
            {
                $collection = getFilteredData($request);

            } else
            {
                $collection = [];
            }

            return $collection;
        }
    }

    function getCustomNodesResponse($collection)
    {
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
