<?php

namespace App\Http\Controllers\ApiControllers\Node;

use App\Http\Controllers\ApiControllers\ApiController;
use App\Node;
use Illuminate\Http\Request;

class NodeDataController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $node = Node::find($id);

        $data = $node->data;

        return $this->showAll($data);
    }
}
