<?php

namespace App\Http\Controllers\ApiControllers\Node;

use App\Node;
use App\Http\Controllers\ApiControllers\ApiController;

class NodeController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nodes = Node::all();

        $nodes->map(function ($node) {
            $node = self::map($node);
            return $node;
        });

        return $this->showAll($nodes);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $node = Node::findOrFail($id);

        $node = self::map($node);

        return $this->showOne($node);
    }

    function map($node)
    {
        $node['links'] = [
            [
                'rel' => 'self',
                'href' => url('api/v1/nodes', $node->id),
            ],
            [
                'rel' => 'nodetype',
                'href' => url('api/v1/nodetypes', $node->node_type_id),
            ]
            ,
            [
                'rel' => 'nodes.data',
                'href' => route('nodes.data.index', $node->id),
            ]
        ];

        return $node;
    }
}
