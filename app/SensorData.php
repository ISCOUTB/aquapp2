<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class SensorData extends Model
{

    protected $collection = 'sensor_data';

    protected $fillable = [
        'variable',
        'node_id',
        'data'
    ];

    /**
     * Get the node_type associated with the given node.
     */
    public function node()
    {
        return $this->belongsTo('App\Node');
    }

}
