<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Node extends Model
{

    const REAL_TIME = 'Real Time';
    const NON_REAL_TIME = 'Non Real Time';
    const OFF = 'Off';

    protected $collection = 'nodes';

    protected $fillable = [
        'name',
        'location',
        'coordinates',
        'status',
        'node_type_id',
        'data'
    ];

    protected $casts = [
        'coordinates' => 'array',
        'data' => 'array'
    ];

    /**
     *  Mutators
     */
    public function setNameAttribute($valor)
    {
        $this->attributes['name'] = strtolower($valor);
    }

    public function setLocationAttribute($valor)
    {
        $this->attributes['location'] = strtolower($valor);
    }

    /**
     *  Accessors
     */
    public function getNameAttribute($valor)
    {
        return ucwords($valor);
    }

    public function getLocationAttribute($valor)
    {
        return ucwords($valor);
    }

    /**
     * Get the node_type associated with the given node.
     */
    public function node_type()
    {
        return $this->belongsTo('App\NodeType');
    }

    /**
     * Get the data associated with the given node.
     */
    public function data()
    {
        return $this->hasMany('App\SensorData');
    }

}
