<?php
/**
 * User: Dominik
 * Date: 2016-09-10
 * Time: 19:16
 */

$list = new SplDoublyLinkedList();

$list[] = "one";
$list[] = "two";
$list[] = "three";
$list[] = "four";

/**
 * @var $list SplDoublyLinkedList
 */
// iteration works like in arrays
echo "Retular Iteration: -------------- <br />";
foreach($list as $el){
    echo "$el <br />";
}
// but also in reverse way
$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_LIFO);
echo "Reverse Iteration: -------------- <br />";
foreach($list as $el){
    echo "$el <br />";
}

// but it also has additional functionality
// it's a bit confusing but we have to use top() to get last last element, cause it behaves like Stack
echo "<br />Last element: " . $list->top();