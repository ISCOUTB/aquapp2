<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;


class NodeType extends Model
{

    protected $collection = 'node_types';

    protected $fillable = [
        'name',
        'sensors'
    ];

    protected $casts = [
        'sensors' => 'array'
    ];

}
