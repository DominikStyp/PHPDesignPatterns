<?php
/**
 * User: Dominik
 * Date: 2016-09-10
 * Time: 21:00
 */
namespace SPL\SplMinHeap;

/**
 * Function to display heap with indentations in <ul><li></li></ul> format
 * @param $heap
 */
function displayHeap($heap) {
    foreach ($heap as $el) {
        echo "<ul>Parent: $el[0]";
        $i = 1;
        while (isset( $el[$i] )) {
            $indentation = str_repeat("&nbsp;", $i * 2);
            echo "<li>{$indentation}Child: $el[$i]</li>";
            $i++;
        }
        echo "</ul>";
    }
}

// heap works like this: it sorts parent values first, and then its children values...
// ...and its children values.. etc. to the most nested level
// in case of SplMinHeap it sorts values in ascending order
// It's a really great tool to sort categories and subcategories by id
$heap = new \SplMinHeap();
/* [parent, child] */
$heap->insert([1,5,3]);
$heap->insert([1,5,2]);
$heap->insert([1,5,2,10]);
$heap->insert([1,5,2,13]);
$heap->insert([1,5,2,8]);
$heap->insert([2,4]);
$heap->insert([5,3]);
$heap->insert([3,10]);

echo "--------------------------------<br />";
displayHeap($heap);


