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
}
