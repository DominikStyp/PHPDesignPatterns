<?php

require_once dirname(__FILE__).'/FunctionCustomizer.php';

$matches = array();

$pregMatch = (new FunctionCustomizer('preg_match', 3))
             ->setArgument(0, "#\d{2}#")
             ->setArgumentRef(2, $matches)
             ->getClosureWithOneArg(1);

if($pregMatch("str22")) {
    echo "<br />", "cond 1 OK", "<br />";
    var_dump($matches); //and magically we have our matches variable set via reference
}
if($pregMatch("str")){
    echo "<br />", "cond 2 OK", "<br />";
    var_dump($matches);
}
if($pregMatch("str333asdf")){
    echo "<br />", "cond 3 OK", "<br />";
    var_dump($matches);
}
