<?php
/**
 * User: Dominik
 * Date: 2016-09-11
 * Time: 17:49
 */
// SplFixedArray is just fastest implementation of the array
// you can use this if you know array size from the beginning
namespace SPL\SplFixedArray;

function m(){
    return microtime(true);
}
function echoTime($begin){
    echo "<br />Code took: ".((m()-$begin))." seconds";
}

$iterations = 100; //iterations of the outer loop
$elements = 10000; //elements in array

///// Regular array
$start = m();
for($i = 0; $i <= $iterations; $i++){
    $arr = []; // unknown size of array
    for($j = 0; $j < $elements; $j++){
        $arr[] = $j;
    }
}
echo "<br />--------- Array -------------";
echoTime($start);

///// SplFixedArray
$start = m();
for($i = 0; $i <= $iterations; $i++){
    $splArr = new \SplFixedArray($elements); // known size
    for($j = 0; $j < $elements; $j++){
        $splArr[$j] = $j;
    }
}
echo "<br />--------- SplFixedArray -----------";
echoTime($start);
/**
 * My result shows that SplFixedArray is about 22% faster:
 *
 * --------- Array -------------
 * Code took: 0.34254384040833 seconds
 * --------- SplFixedArray -----------
 * Code took: 0.28053498268127 seconds
 */
