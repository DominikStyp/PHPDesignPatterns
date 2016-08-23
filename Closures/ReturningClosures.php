<?php

/**
 * Following class gives some examples of how to use Closures
 *
 * @author Dominik
 */
class ReturningClosures {
    /**
     * This method returns prepared "macher" that will check every $subjectString against the defined $regex
     * @param type $regex
     * @return callable
     */
    private function getMatcher($regex){
        return function($subjectString) use ($regex) {
            return preg_match($regex,$subjectString);  
        };
    }
    /**
     * Returns matcher that will check if string is date in format:
     * YYYY-mm-dd HH:ii:ss
     * @return callable
     */
    public function getDateMatcher(){
        return $this->getMatcher("#^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$#");
    }
}

////////// example /////////////////////
$obj = new ReturningClosures();
$m = $obj->getDateMatcher();
//// this allows programmer to significantly shorten the code 
//// instead of using method calls everywhere, 
//// you can temporarily assign it to the variable
//// and use it without worrying to redeclare function
if($m("abcd")){
    echo "first condition";
} else if($m("1964-01-01 22:33:00")) {
    echo "second condition";
}
