<?php
/**
 * User: Dominik
 * Date: 2016-09-12
 * Time: 12:31
 */

//////////// Flags ARRAY_AS_PROPS and STD_PROP_LIST explanation on example //////////

/////////// no flag /////////////////////////////////////////////////////////////
$a = new \ArrayObject();
$a['arr'] = 'array data';
$a->prop = 'prop data';
/**
 * object(ArrayObject)[1]
 *  public 'arr' => string 'array data' (length=10)
 */
var_dump($a);
// we can access property
echo "Property 'prop' test: $a->prop <br />"; //prop data
// we can access key
echo "Key 'arr' test: {$a['arr']} <br />"; //array data
foreach($a as $key => $val){
    echo "$key => $val <br />"; // arr => array data
}

//////////// ArrayObject::ARRAY_AS_PROPS flag /////////////////////////////////
$a->setFlags(\ArrayObject::ARRAY_AS_PROPS);
/**
 * object(ArrayObject)[1]
 *  public 'arr' => string 'array data' (length=10)
 */
var_dump($a);
// we can access property
echo "Property 'prop' test: $a->prop <br />"; //prop data
// we can access key
echo "Key 'arr' test: {$a['arr']} <br />"; //array data
foreach($a as $key => $val){
    echo "$key => $val <br />"; // arr => array data
}

//////////// ArrayObject::STD_PROP_LIST flag ////////////////////////////////
$a->setFlags(\ArrayObject::STD_PROP_LIST);
/**
 * object(ArrayObject)[1]
 *  public 'prop' => string 'prop data' (length=9)
 */
var_dump($a);
// we can access property
echo "Property 'prop' test: $a->prop <br />"; //prop data
// we can access key
echo "Key 'arr' test: {$a['arr']} <br />"; //array data
foreach($a as $key => $val){
    // despite that we have 'prop' in var_dump(), we still have 'arr' in the loop
    echo "$key => $val <br />"; // arr => array data
}