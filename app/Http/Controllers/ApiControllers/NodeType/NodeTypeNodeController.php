<?php

namespace App\Http\Controllers\ApiControllers\NodeType;

use App\Http\Controllers\ApiControllers\ApiController;
use App\NodeType;
use Illuminate\Http\Request;

class NodeTypeNodeController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $nodeType = NodeType::find($id);

        $nodes = $nodeType->nodes;

        $nodes->map(function ($node) {
            $node = mapNode($node);
            return $node;
        });

        return $this->showAll($nodes);
    }

}
