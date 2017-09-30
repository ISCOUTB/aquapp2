<?php

function getSensors(){
    $sensors = [];

    $json = File::get("../database/data/sensors.json");
    $data = json_decode($json);

    foreach ($data as $obj) {
        $sensors[] = $obj;
    }

    return $sensors;
}