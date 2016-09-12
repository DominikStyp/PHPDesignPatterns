<?php
/**
 * User: Dominik
 * Date: 2016-09-12
 * Time: 14:18
 */
function modify($var){
    $var[0] = 'changed';
}
function modifyRef(& $var){
    $var[0] = 'changed';
}

$arr = ['one', 'two', 'three'];
$arrObj = new ArrayObject(['one', 'two', 'three']);
// now let's try to change it
modify($arr); //no effect
var_dump($arr);
// via reference
modifyRef($arr); //changed
var_dump($arr);

// modify array object
modify($arrObj); //changed
var_dump($arrObj);
// via reference
modifyRef($arrObj); //changed
var_dump($arrObj);

/*
  array (size=3)
  0 => string 'one' (length=3)
  1 => string 'two' (length=3)
  2 => string 'three' (length=5)
array (size=3)
  0 => string 'changed' (length=7)
  1 => string 'two' (length=3)
  2 => string 'three' (length=5)
object(ArrayObject)[1]
  public 0 => string 'changed' (length=7)
  public 1 => string 'two' (length=3)
  public 2 => string 'three' (length=5)
object(ArrayObject)[1]
  public 0 => string 'changed' (length=7)
  public 1 => string 'two' (length=3)
  public 2 => string 'three' (length=5)
*/
