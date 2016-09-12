<?php
/**
 * User: Dominik
 * Date: 2016-09-12
 * Time: 11:17
 */

////////////////////////////////////////////////////////////////////
/////////// when ARRAY_AS_PROPS is actually useful ??? /////////////
////////////////////////////////////////////////////////////////////
echo "<br /> -----------------ARRAY_AS_PROPS usage case---------------------- <br />";
$arrObj = new ArrayObject([
    'name' => 'Jon',
    'surname' => 'Snow',
    'age' => 'unknown',
]);
$arrObj->setFlags(\ArrayObject::ARRAY_AS_PROPS);
// without ARRAY_AS_PROPS we get:  "Notice: Undefined property: ArrayObject::$name"
echo "Name $arrObj->name";

////////////////////////////////////////////////////////////////////
/////////// when STD_PROP_LIST is actually useful ??? /////////////
////////////////////////////////////////////////////////////////////
echo "<br /> -----------------STD_PROP_LIST usage case---------------------- <br />";
$arrObj = new ArrayObject();
$arrObj->name = 'Jon';
$arrObj->surname = 'Snow';
$arrObj->age = 'unknown';
$arrObj->setFlags(\ArrayObject::STD_PROP_LIST);
// Without ArrayObject::STD_PROP_LIST nothing gets printed in var_dump() nor in the loop
var_dump($arrObj);
foreach(get_object_vars($arrObj) as $prop => $val){
    echo "$prop : $val <br />";
}