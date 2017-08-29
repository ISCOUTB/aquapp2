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
     *  Mutators
     */
    public function setNameAttribute($valor)
    {
        $this->attributes['name'] = strtolower($valor);
    }

    /**
     *  Accessors
     */
    public function getNameAttribute($valor)
    {
        return ucwords($valor);
    }

    /**
     * Get the nodes with a specific type.
     */
    public function nodes()
    {
        return $this->hasMany('App\Node');
    }

}
