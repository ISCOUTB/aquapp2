<?php

use App\Category;
//use DateTime;
//use DateTimeZone;

function getNeighborhoods(){
    $directory = "../database/data/neighborhoods";

    $files = File::allFiles($directory);

    $neighborhoods = [];

    if($files) {
        foreach ($files as $file) {
            $json = File::get($file);
            $data = json_decode($json, true);

            foreach ($data as $obj) {
                $neighborhoods[] = $obj["neighborhood"];
            }
        }
    }

    return $neighborhoods;
}

function getCategories(){
    $categories = Category::where('parent', '=', null)->orderBy('name', 'asc')->get();

    return $categories;
}

/**
 * Get places Status: open/close
 */
function checkStatusByPlace($places){

    $statusArray = array();

    foreach ($places as $place) {
        $status = getPlaceStatus($place);
        array_push($statusArray, $status);
    }

    return $statusArray;
}

function getPlaceStatus($place){
    $currentDay = new DateTime('now', new DateTimeZone('-5')); //UTC-5 timezone
    $currentWeekday = $currentDay->format('l');
    $currentTime = $currentDay->format('h:i a');

    $shifts = array(); // reset for each place

    foreach ($place->opening_hours as $openingHour) {
        switch($openingHour->day){
            case "0":
                $day = "Monday";
                break;
            case "1":
                $day = "Tuesday";
                break;
            case "2":
                $day = "Wednesday";
                break;
            case "3":
                $day = "Thursday";
                break;
            case "4":
                $day = "Friday";
                break;
            case "5":
                $day = "Saturday";
                break;
            case "6":
                $day = "Sunday";
                break;
        }

        $shift = array(
            $openingHour->start_time,
            $openingHour->end_time
        );

        if ($currentWeekday == $day)
            array_push($shifts, $shift);

    }

    if(count($shifts) == 0) { // No shifts, assign closed by default
        $status = false;
    }else{
        $firstShift = $shifts[0];

        $firstShiftStatus = checkAvailability($currentTime, $firstShift);

        if(count($shifts) == 2){
            $secondShift = $shifts[1];
            $secondShiftStatus = checkAvailability($currentTime, $secondShift);
        }else{
            $secondShiftStatus = false;
        }

        $status = $firstShiftStatus || $secondShiftStatus;
    }

    return $status;
}

function checkAvailability($currentTime, $shift){
    if($shift[0] == "00:00" and $shift[1] == "00:00"){ /* 24 Hours Service */
        $status = true;
    }else{
        $openingTime = DateTime::createFromFormat('H:i a', $shift[0]);
        $currentTime = DateTime::createFromFormat('H:i a', $currentTime);
        $closingTime = DateTime::createFromFormat('H:i a', $shift[1]);

        if ($currentTime > $openingTime and $currentTime < $closingTime)
            $status = true; //'Abierto'
        else
            $status = false; //'Cerrado'
    }

    return $status;
}

/**
 * Get Opening Hours
 */
function getOpeningHoursByPlace($places){
    $hoursByPlace = array();

    foreach ($places as $place) {
        $hoursByDay = getPlaceOpeningHours($place);
        array_push($hoursByPlace, $hoursByDay);
    }

    return $hoursByPlace;
}

function getPlaceOpeningHours($place){
    $hoursByDay = array(); // reset for each place

    for ($i = 0; $i < 7; $i++) {
        array_push($hoursByDay, array());
    }

    $openingHours = $place->opening_hours;

    foreach($openingHours as $opening_hour){

        if($opening_hour->start_time == "00:00" and $opening_hour->end_time == "00:00"){
            $shift = " 24 Hours Service";
        }else{
            $shift = $opening_hour->start_time . " - " . $opening_hour->end_time;
        }

        $index = intval($opening_hour->day);
        array_push($hoursByDay[$index], $shift);

    }

    return $hoursByDay;
}

function getSocialMediaArray($place){
    /* Array with social media (for easier displaying on blade) */
    $socialMedia =  array_fill(0, 4, null);

    foreach($place->social_media as $social){
        switch($social->type){
            case 'website':
                $socialMedia[0] = urldecode($social->url);
                break;
            case 'facebook':
                $socialMedia[1] = urldecode($social->url);
                break;
            case 'twitter':
                $socialMedia[2] = urldecode($social->url);
                break;
            case 'instagram':
                $socialMedia[3] = urldecode($social->url);
                break;
        }
    }

    return $socialMedia;

}