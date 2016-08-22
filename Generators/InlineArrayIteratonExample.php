<?php

namespace Generators;


/**
 * PROBLEM: 
 * We want to return big strings in loop.
 * So we have couple of methods to achieve this.
 * 1) returning by switch-case value
 * 2) returning by array index value
 * 3) returning by generator internal value
 *
 * @author Dominik
 */
class InlineArrayIteratonExample {

    static $arr = array();
    static $repeat = 300;
    
    /**
     * Using switch statement
     */
    public function displaySwitchCase($num){
        switch($num){
            case 0: return str_repeat("123456!@#!@#", self::$repeat);
            case 1: return str_repeat("abcdef!@#!@#", self::$repeat);
            case 2: return str_repeat("defgha!@#!@#", self::$repeat);
            case 3: return str_repeat("zxvbnm!@#!@#", self::$repeat);
            case 4: return str_repeat("asdfgh!@#!@#", self::$repeat); 
            case 5: return str_repeat("qwerty!@#!@#", self::$repeat);
            case 6: return str_repeat("poiuyt!@#!@#", self::$repeat);
        }
    }
    
    
    /**
     * Using static array
     */
    public function displayArray($num){
            if(empty(self::$arr)){
                   self::$arr = array(
                       str_repeat("123456!@#!@#", self::$repeat),
                       str_repeat("abcdef!@#!@#", self::$repeat),
                       str_repeat("defgha!@#!@#", self::$repeat),
                       str_repeat("zxvbnm!@#!@#", self::$repeat),
                       str_repeat("asdfgh!@#!@#", self::$repeat),
                       str_repeat("qwerty!@#!@#", self::$repeat),
                       str_repeat("poiuyt!@#!@#", self::$repeat),
                   );
            }
            return self::$arr[$num];
    }    
    /**
     * Using yield statement
     */
    public function displayYield(){
                       yield str_repeat("123456!@#!@#", self::$repeat);
                       yield str_repeat("abcdef!@#!@#", self::$repeat);
                       yield str_repeat("defgha!@#!@#", self::$repeat);
                       yield str_repeat("zxvbnm!@#!@#", self::$repeat);
                       yield str_repeat("asdfgh!@#!@#", self::$repeat);
                       yield str_repeat("qwerty!@#!@#", self::$repeat);
                       yield str_repeat("poiuyt!@#!@#", self::$repeat);
    }    
}

$obj = new InlineArrayIteratonExample();
############## Memory used: 137,672 ################ 
if(empty($_GET['test'])){
    $_GET['test'] = '0';
}
############## Memory used: 141,688 ################ 
if($_GET['test'] === "1"){
    for($i = 0; $i<7; $i++){ //switch-case style loop
        $v = $obj->displaySwitchCase($i);
    }
}
############## Memory used: 163,976 ################ 
if($_GET['test'] === "2"){ //array style loop
    for($i = 0; $i<7; $i++){
        $v = $obj->displayArray($i);
    }
}
############## Memory used: 141,608 ################ 
if($_GET['test'] === "3"){ // generator style loop
    foreach($obj->displayYield() as $v){
    }
}
echo "############## Memory used: " . number_format(memory_get_usage()). " ################ ";
?>
<br />
<a href="<?=basename(__FILE__)?>">No test</a>&nbsp;&nbsp;&nbsp;
<a href="<?=basename(__FILE__)?>?test=1">Switch-case memory test</a>&nbsp;&nbsp;&nbsp;
<a href="<?=basename(__FILE__)?>?test=2">Arrays memory test</a>&nbsp;&nbsp;&nbsp;
<a href="<?=basename(__FILE__)?>?test=3">Yield memory test</a>&nbsp;&nbsp;&nbsp;


