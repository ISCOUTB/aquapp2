<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;


class NodeType extends Model
{

    protected $collection = 'node_types';

    protected $fillable = [
        'name',
        'separator',
        'sensors'
    ];

    protected $casts = [
        'sensors' => 'array'
    ];

    /**
     * Get the nodes with a specific type.
     */
    public function nodes()
    {
        return $this->hasMany('App\Node');
    }

}
