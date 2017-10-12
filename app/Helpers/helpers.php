<?php

use App\SensorData;

function getSensors(){
    $sensors = [];

    $json = File::get("../database/data/sensors.json");
    $data = json_decode($json);

    foreach ($data as $obj) {
        $sensors[] = $obj;
    }

    return $sensors;
}

function getFilteredData($request)
{
    $nodeId = $request->input('node_id');
    $variable = $request->input('variable');
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $startDate = date("YmdHis", strtotime($startDate));
    $endDate = date("YmdHis", strtotime($endDate));

    $sensorData = SensorData::where('node_id', $nodeId)
        ->where('variable', $variable)
        ->whereBetween('data.timestamp', array($startDate, $endDate))
        ->first();

    /*
     * Filter data
     */
    $data = [];

    if($sensorData)
    {
        foreach($sensorData['data'] as $key => $datum)
        {
            if($datum['timestamp'] >= $startDate && $datum['timestamp'] <= $endDate)
            {
                $data[] = $datum;
            }

        }
    }

    /*
     * Sort data
     */
    function cmp($item1, $item2) {
        $ts1 = strtotime($item1['timestamp']);
        $ts2 = strtotime($item2['timestamp']);
        return $ts2 - $ts1;
    }

    usort($data, "cmp");

    $sensorData['data'] = $data;

    return $sensorData;
}

function mapNode($node)
{
    $node['links'] = [
        [
            'rel' => 'self',
            'href' => url('api/v1/nodes', $node->id),
        ],
        [
            'rel' => 'node-types',
            'href' => url('api/v1/node-types', $node->node_type_id),
        ]
        ,
        [
            'rel' => 'nodes.data',
            'href' => route('nodes.data.index', $node->id),
        ]
    ];

    return $node;
}

function mapNodeType($nodeType)
{
    $nodeType['links'] = [
        [
            'rel' => 'self',
            'href' => url('api/v1/node-types', $nodeType->id),
        ],
        [
            'rel' => 'node-types.nodes',
            'href' => route('node-types.nodes.index', $nodeType->id),
        ]
    ];

    return $nodeType;
}