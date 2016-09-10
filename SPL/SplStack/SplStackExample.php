<?php
/**
 * User: Dominik
 * Date: 2016-09-10
 * Time: 18:43
 */

/**
 * It's the as SplDoublyLinkedList but with an iteration mode IT_MODE_LIFO and IT_MODE_KEEP
 */
$stack = new SplStack();
$stack->push("Lowest Priority");
$stack->push("Lower Priority");
$stack->push("Low Priority");
$stack->push("Medium Priority");
$stack->push("High Priority");
$stack->push("Highest Priority");

// and now we want to get priorities in different order we just do...
// because Stack implements LIFO queue type (Last In First Out),
// that means "Highest Priority" is Last In and First Out
echo "Our queue in reverse order: <br />";
foreach($stack as $el){
    echo "$el <br />";
}