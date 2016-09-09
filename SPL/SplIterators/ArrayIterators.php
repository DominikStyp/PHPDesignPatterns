<?php

/**
 * ArrayIterators
 *
 * @author Dominik
 */
class ArrayIterators {
    
    private $regularArray = array(
        'John', 'Andrew', 'Mary', 'Philip'
    );
    private $nestedArray = array(
        'John', 'Andrew', array('Barbara','Jenna'), 'Mary', 'Philip'
    );
    private $deeplyNestedArray = array(
        'John', 'Andrew', 
             array('Ann', 'Barbara','Jenna', 
                    array('Fiona','Natasha','Charlize', 
                            array('Scarlett','Alexandra')
                          )
                  ), 
        'Mary', 'Philip', 'Bridgett'
    );
    
    /**
     * Only method that should take care of the output
     * @param Iterator $it
     */
    private function display(Iterator $it){
        foreach($it as $val){
            echo "$val <br />";
        }
    }
    
    /**
     * Output is OK: 
     * 
     *  John
     *  Andrew
     *  Mary
     *  Philip 
     */
    public function regularIterator(){
        $it = new ArrayIterator($this->regularArray);
        $this->display($it);
    }
    
    /**
     * Output is not what we've expected: 
     * 
     *  John
     *  Andrew
     *  Notice: Array to string conversion in (...)
     *  Array
     *  Mary
     *  Philip 
     */
    public function recursiveIteratorWRONG(){
        $it = new RecursiveArrayIterator($this->nestedArray);
        $this->display($it);
    }
    
    /**
     * We must wrap Recursive{Something}Iterator inside RecursiveIteratorIterator() in order this to work
     * Output is now what we've expected:
     * 
     *  John
     *  Andrew
     *  Barbara
     *  Jenna
     *  Mary
     *  Philip 
     */
    public function recursiveIteratorOK(){
        $it = new RecursiveArrayIterator($this->nestedArray);
        $it1 = new RecursiveIteratorIterator($it);
        $this->display($it1);
    }
    
    /**
     * Example of how we can chain iterators.
     * Let's say we want to: 
     *  1) recursively display deeply nested array
     *  2) display only names that have 5 or more characters
     *  3) sort in alphabetical order
     *  4) limit display to first 5
     * 
     * PROBLEMS:
     *  - you can't use $it->asort() with nested arrays, cause it doesn't work,
     *    in order to sort the result, you have to convert iterator to array, sort, and convert back to iterator
     * 
     * Expected output:
     *  Alexandra
     *  Andrew
     *  Barbara
     *  Bridgett
     *  Charlize 
     *  
     */
    public function combinedIterators(){
        $it = new RecursiveArrayIterator($this->deeplyNestedArray);
        // asort in this case doesn't work, cause it's nested array
        // $it->asort();
        //wrap as recursive iterator
        $it1 = new RecursiveIteratorIterator($it);
        //filter by string length
        $it2 = new CallbackFilterIterator($it1, 
                /** 
                 * Callback has to return TRUE to accept each element
                 */
                function ($current, $key, $iterator) {
                    return strlen($current) >= 5;
                });
        // nested arrays must be converted to one-dimensional array first
        $arr = iterator_to_array($it2, false);
        // ... and then sorted
        asort($arr);
        $it3 = new ArrayIterator($arr);
        //limit output
        $it4 = new LimitIterator($it3, 0, 5);
        $this->display($it4);
    }
    
}

//// examples ///
$obj = new ArrayIterators();
$obj->combinedIterators();
