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

        $rules = [
            'name' => 'required|max:255',
            'status' => 'required|in:'. Node::REAL_TIME . ',' . Node::NON_REAL_TIME . ',' . Node::OFF,
            'location' => 'required|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude'=>'required|numeric|between:-180,180'
        ];

        $this->validate($request, $rules);

        /*
         * Form fields
         */
        $name = $request->input('name');
        $status = $request->input('status');
        $location = $request->input('location');
        $latitude = (float) $request->input('latitude');
        $longitude = (float) $request->input('longitude');
        $coordinates = [$latitude, $longitude];


        /*
         * Node Type
         */
        $nodeType = $request->input('node-type');

        if($nodeType == "sending-schema"){
            if(!$request->has(['node-type-name', 'node-type-sensors'])){
                return back()->with('error', 'Choose Data Sending Schema: Node Type Name and Parameters Type Selectors fields required')
                             ->with('name', $name)
                             ->with('status', $status)
                             ->with('location', $location)
                             ->with('latitude', $latitude)
                             ->with('longitude', $longitude);
            }
        }

        if($nodeType == "sending-schema"){
            /*
             * Save Data Schema -> Create Node Type
            */
            $nodeTypeName = $request->input('node-type-name');
            $nodeTypeSensors = $request->input('node-type-sensors');
            $nodeTypeDelimiter = $request->input('node-type-delimiter');

            if($nodeTypeDelimiter == 'whitespace'){
                $nodeTypeDelimiter = " ";
            }

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
         * Create Node
         */
        Node::create([
            'name' => $name,
            'status' => $status,
            'location' => $location,
            'coordinates' => $coordinates,
            'node_type_id' => $nodeTypeId
        ]);

        return redirect('admin/nodes');

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
        $rules = [
            'name' => 'max:255',
            'status' => 'in:'. Node::REAL_TIME . ',' . Node::NON_REAL_TIME . ',' . Node::OFF,
            'location' => 'max:255',
            'latitude' => 'numeric|between:-90,90',
            'longitude'=>'numeric|between:-180,180'
        ];

        $this->validate($request, $rules);

        $node = Node::findOrFail($id);

        if ($request->has('name'))
        {
            $node->name = $request->input('name');
        }

        if ($request->has('status'))
        {
            $node->status = $request->input('status');
        }

        if ($request->has('location'))
        {
            $node->location = $request->input('location');
        }

        if ($request->has('latitude') or $request->has('longitude'))
        {
            $latitude = (float) $request->input('latitude');
            $longitude = (float) $request->input('longitude');
            $node->coordinates = [$latitude, $longitude];
        }

        // At least one new value of a field is needed to update
        if (!$node->isDirty())
        {
            return back()->with('error', 'At least one new value of a field is needed to update')
                ->with('name', $node->name)
                ->with('status', $node->status)
                ->with('location', $node->location)
                ->with('latitude', $node->coordinates[0])
                ->with('longitude', $node->coordinates[1]);
        }

        $node->save();

        return redirect('admin/nodes')->with('success-update', 'Node successfully updated');
    }

}
