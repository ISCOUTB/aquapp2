<?php

namespace App\Http\Controllers\ApiControllers;

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
        $nodes = Node::with('node_type')->get();

        return $this->showAll($nodes);
    }


    /**
     * Display the specified resource.
     *
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $node = Node::with('node_type')->findOrFail($id);

        return $this->showOne($node);
    }
}
