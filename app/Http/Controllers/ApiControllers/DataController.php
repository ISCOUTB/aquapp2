<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\ApiControllers;
use Illuminate\Http\Request;

class DataController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $collection = getFilteredData($request);

        return $this->successResponse($collection, 200);
    }
}
