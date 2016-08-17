<?php

/**
 * SplObjectStorageExample
 *
 * @author Dominik
 */
class SplObjectStorageExample extends SplObjectStorage {
    
    public function getHash($object)
    {
        return $object->id;
    }
}

// example //
$obj1 = new stdClass(); $obj1->id = "111"; $obj1->name = "Patrick";
$obj2 = new stdClass(); $obj2->id = "222"; $obj2->name = "John";
$obj3 = new stdClass(); $obj3->id = "111"; $obj3->name = "Vanessa";

$objStorage = new SplObjectStorageExample();
$objStorage->attach($obj1, array("myData" => "Patrick's guitar"));
$objStorage->attach($obj2, array("myData" => "John's pants"));
$objStorage->attach($obj3, array("myData" => "Vanessa's bra")); //not added due to id collistion

// getting data associated with object 
var_dump($objStorage->offsetGet($obj2)); // array(1) { ["myData"]=> string(11) "John's pants } 

/// looping over objects
// Vanessa isn't printed, cause she wasn't added because of hash collision
foreach($objStorage as $tmp){
    echo "<br />My name is: {$tmp->name}";
}
// ... but Vanessa's associated data still can be retrieved ( why??? ask SPL creators :D )
// ... maybe she wasn't added but her bra somehow slipped in :)
echo "<br />";
var_dump($objStorage->offsetGet($obj3)); //array(1) { ["myData"]=> string(13) "Vanessa's bra" } 