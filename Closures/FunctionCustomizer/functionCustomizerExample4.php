<?php

require_once dirname(__FILE__).'/FunctionCustomizer.php';

class MyStyler {
    public function styleIt($arg1,$arg2,$arg3, & $arg4){
        $arg4 = "<span style=\"$arg3\">Arg1: $arg1, Arg2: $arg2</span> <br />";
    }
}
$refTo4 = "";
$testIt = (new FunctionCustomizer(array(new MyStyler(),'styleIt'), 4))
             ->setArgument(1, "two")
             ->setArgument(0, "one")
             ->setArgumentRef(3, $refTo4)
             ->getClosure();

$testIt("font-weight:bold; color:red;");
echo $refTo4;

