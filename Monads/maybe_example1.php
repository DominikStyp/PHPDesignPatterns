<?php
/**
 * Created by PhpStorm.
 * User: Dominik
 * Date: 2019-05-02
 * Time: 16:34
 */

require_once ("Maybe.php");

$employees = json_decode('{
    "Jack": {
            "address": {
                    "country": "Poland",
                    "city": "Warsaw"
            },
            "duty_hours": {
                    "cleaning": "18:00",
                    "washing":  "19:00"
            }
    },
    "Tom": {
            "address": {
                "phone": "123-456-789"
            }
    }
}');

/////////// EXAMPLE 1 /////////////////////////
// here we have an example where we always pass in callback which receives current value ($name, $property, $address)
$jacksCountry = \Monads\Maybe::create($employees)
    ->then(function($name){
        return $name->Jack;
    })
    ->then(function($properties){
        return $properties->address;
    })
    ->then(function($address){
        return $address->country;
    })->value();

var_dump($jacksCountry);

//////// EXAMPLE 2 //////////////
// here we use "magical" __get() method to just receive plain and not changed $something->{$property};
$jacksCountry1 = \Monads\Maybe::create($employees)
    ->Jack
    ->address
    ->country
    ->value();

var_dump($jacksCountry1);

//////// EXAMPLE 3 //////////////
// here it gets more interesting, when we get cleaning hour, but we can modify it via callback function
// and convert it from "18:00" to "6:00pm"
$jacksDutyHourForCleaningWithAMorPM = \Monads\Maybe::create($employees)
    ->Jack
    ->duty_hours
    ->cleaning
    ->then(function($hour){
        return date("g:ia", strtotime($hour));
    })
    ->value();

var_dump($jacksDutyHourForCleaningWithAMorPM);