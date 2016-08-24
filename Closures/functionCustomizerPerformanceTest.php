<?php

require_once './FunctionCustomizer.php';
//// example 1 - lets predefine preg_match ////
function echoTime($begin){
    echo "<br />Code took: ".((microtime(true)-$begin))." seconds";
}

$matches0 = array();
$matches1 = array();
/**
 * Notice that only FIRST and THIRD argument are predefined.
 * SECOND argument is gonna be automatically passed from closure call like this:
 * preg_match(PREDEFINED("#\d{2}#"), CLOSURE("str22"), PREDEFINED_REF($matches))
 * 
 */
$pregMatch = (new FunctionCustomizer('preg_match', 3))
             ->setArgument(0, "#\d{2}#")
             ->setArgumentRef(2, $matches0)
             ->getClosure();

$iterations = 100000;
///////////////////////////////////////
$start = microtime(true);
for($i = 0; $i<$iterations; $i++){
    if(preg_match("#\d{2}#", "str333asdf", $matches1)){}
}
echoTime($start);
///////////////////////////////////////
$start = microtime(true);
for($i = 0; $i<$iterations; $i++){
    if($pregMatch("str333asdf")){}
}
echoTime($start);