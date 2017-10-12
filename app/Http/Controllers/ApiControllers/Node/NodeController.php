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
            $node = mapNode($node);
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

        $node = mapNode($node);

        return $this->showOne($node);
    }
}
