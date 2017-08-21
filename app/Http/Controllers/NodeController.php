<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Node;
use App\NodeType;

use Session;

class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nodes = Node::all();
        return view('admin.nodes.index', ['nodes' => $nodes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nodeTypes = NodeType::orderBy('created_at', 'asc')->get();
        return view('admin.nodes.create', ['nodeTypes' => $nodeTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'status' => 'required',
            'location' => 'required|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude'=>'required|numeric|between:-180,180'
        ]);

        $name = $request->input('name');
        $status = $request->input('status');
        $location = $request->input('location');
        $latitude = (float) $request->input('latitude');
        $longitude = (float) $request->input('longitude');
        $coordinates = [$latitude, $longitude];

        $nodeType = $request->input('node-type');

        if($nodeType == "sending-schema"){
            if(!$request->has(['node-type-name', 'node-type-sensors'])){
                return back()->with('error', 'Choose Data Sending Schema: Node Type Name and Parameters Type Selectors fields required')
                             ->with('name', $name)
//                             ->with('status', $status)
                             ->with('location', $location)
                             ->with('latitude', $latitude)
                             ->with('longitude', $longitude);
            }
        }

        $node = Node::create([
            'name' => $name,
            'status' => $status,
            'location' => $location,
            'coordinates' => $coordinates
        ]);

        if($nodeType == "sending-schema"){
            /*
             * Save Data Schema -> Create Node Type
            */
            $nodeTypeName = $request->input('node-type-name');
            $nodeTypeSensors = $request->input('node-type-sensors');
            $nodeTypeDelimiter = $request->input('node-type-delimiter');

            $nodeTypeSensors = explode($nodeTypeDelimiter, $nodeTypeSensors);

            $sensors = [];
            foreach($nodeTypeSensors as $nodeTypeSensor){
               if($nodeTypeSensor != ""){
                   $sensor = [
                       "variable" => $nodeTypeSensor,
//                    "description" => "Temperature measured outside the station",
//                    "unit" => "°C"
                   ];

                   array_push($sensors, $sensor);
               }
            }

            // Create New Node Type
            $nodeTypeModel = NodeType::create([
                'name' => $nodeTypeName,
                'separator' => $nodeTypeDelimiter,
                'sensors' => $sensors
            ]);

            $nodeTypeId = $nodeTypeModel->id;
        }else{
            $nodeTypeId = $nodeType;
        }


        /*
         *  Update node model
        */
        $node->node_type_id = $nodeTypeId;
        $node->save();

        return redirect('admin/nodes');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $node = Node::findOrFail($id);
        $nodeTypes = NodeType::all();
        return view('admin.nodes.edit', ['node' => $node, 'nodeTypes' => $nodeTypes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'status' => 'required',
            'location' => 'required|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude'=>'required|numeric|between:-180,180'
        ]);

        $name = $request->input('name');
        $status = $request->input('status');
        $location = $request->input('location');
        $latitude = (float) $request->input('latitude');
        $longitude = (float) $request->input('longitude');
        $coordinates = [$latitude, $longitude];

        $node = Node::findOrFail($id);
        $node->name = $name;
        $node->status = $status;
        $node->location = $location;
        $node->coordinates = $coordinates;
        $node->save();

        return redirect('admin/nodes')->with('success-update', 'Node successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
