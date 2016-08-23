<?php
$inStr = function($search, $subject = ""){ 
    static $_str = ""; 
    if(!empty($subject)) {
        $_str = $subject;
    }
    if(empty($_str)){
        throw new Exception("First you must define subject string");
    }
    return strpos($_str, $search) !== false; 
};
$myStr = "soooome niiice stringggggg";
// thanks to static variable we only need to pass subject string once if 
if($inStr("iii",$myStr)){
    echo "cond 1 <br />";
}
// here variable $myStr is rememebered in static $_str, and reused in this call
if($inStr("ooo")){
    echo "cond 2 <br />";
}
// ... again second argument will be reused in the following call
if($inStr("ggg")){
    echo "cond 3 <br />";
}
