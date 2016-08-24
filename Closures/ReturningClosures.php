<?php

/**
 * Following class gives some examples of how to use returned closures
 * to write code faster, and shorter
 *
 * @author Dominik
 * @url https://github.com/DominikStyp
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
    
    /**
     * Returns function which acts like built-in strpos,
     * but with much simpler syntax
     * <pre>
     * Usage:
     * <code>
     *   $inStr = $obj->getStrposChecker();
     *   if($inStr("a", "abcdefg") && $inStr("b") && $inStr("c")){
     *      echo "getStrposChecker: 1 condition";\n
     *   }
     * </code>
     * </pre>
     * @return callable
     */
    public function getStrposChecker(){
        return function($search, $subject = ""){ 
                static $_str = ""; 
                if(!empty($subject)) {
                    $_str = $subject;
                }
                if(empty($_str)){
                    throw new Exception("First you must define subject string");
                }
                return strpos($_str, $search) !== false; 
        };
    }
    
}

////////// example 1 /////////////////////
$obj = new ReturningClosures();
$m = $obj->getDateMatcher();
//// this allows programmer to significantly shorten the code 
//// instead of using method calls everywhere, 
//// you can temporarily assign it to the variable
//// and use it without worrying to redeclare function
if($m("abcd")){
    echo "getDateMatcher: 1 condition <br />";
} else if($m("1964-01-01 22:33:00")) {
    echo "getDateMatcher: 2 condition <br />";
}
////////// example 2 ///////////////////////
$inStr = $obj->getStrposChecker();
if($inStr("a", "abcdefg") && $inStr("b") && $inStr("c")){
    echo "getStrposChecker: 1 condition <br />";
}
// now subject string is "xyz"
if($inStr("x", "xyz") && $inStr("b") && $inStr("c")){
    echo "getStrposChecker: 2 condition <br />";
}
