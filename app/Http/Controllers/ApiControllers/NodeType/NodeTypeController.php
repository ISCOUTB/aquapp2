<?php

namespace App\Http\Controllers\ApiControllers\NodeType;

use App\Http\Controllers\ApiControllers\ApiController;
use App\NodeType;
use Illuminate\Http\Request;

class NodeTypeController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nodeTypes = NodeType::all();

        $nodeTypes->map(function ($nodeType) {
            $nodeType = self::map($nodeType);
            return $nodeType;
        });

        return $this->showAll($nodeTypes);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nodeType = NodeType::findOrFail($id);

        $nodeType = self::map($nodeType);

        return $this->showOne($nodeType);
    }

    function map($nodeType)
    {
        $nodeType['links'] = [
            [
                'rel' => 'self',
                'href' => url('api/v1/nodetypes', $nodeType->id),
            ],
            [
                'rel' => 'nodetypes.nodes',
                'href' => route('nodetypes.nodes.index', $nodeType->id),
            ]
        ];

        return $nodeType;
    }
}
