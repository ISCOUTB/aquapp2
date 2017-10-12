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
            $nodeType = mapNodeType($nodeType);
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

        $nodeType = mapNodeType($nodeType);

        return $this->showOne($nodeType);
    }
}
