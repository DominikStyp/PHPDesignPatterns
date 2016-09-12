<?php
/**
 * User: Dominik
 * Date: 2016-09-12
 * Time: 14:36
 */
$elements = 1000;

function getTestArray($elements){
    $arr = [];
    for($i = 0; $i<$elements; $i++){
        $arr[] = md5(microtime(true).mt_rand(0,1000));
    }
    return $arr;
}

/**
 * Flow below goes like this for regular array:
 * make array -> copy in passArr1 -> copy in passArr2
 *      -> copy in passArr3 -> copy in passArr4 -> change copied array value
 *
 * Flow for the ArrayObject:
 * make array -> pass SAME reference to passArr1 -> to passArr2
 *      -> to passArr3 -> to passArr4 -> change original object value
 * @param $arr
 */
function passArr1($arr){
    $arr[0] = "passArr1";
    passArr2($arr);
}
function passArr2($arr){
    $arr[0] = "passArr2";
    passArr3($arr);
}
function passArr3($arr){
    $arr[0] = "passArr3";
    passArr4($arr);
}
function passArr4($arr){
    $arr[0] = "passArr4";
}

function links(){
    echo '<a href="'.basename(__FILE__).'?test=1">Regular array memory test</a>';
    echo "&nbsp;&nbsp;&nbsp;";
    echo '<a href="'.basename(__FILE__).'?test=2">ArrayObject memory test</a>';
    echo "<br />";
    echo "Memory usage: <b>".number_format(memory_get_peak_usage())."</b><br />";
}
/// test is made inside this condition
if(!empty($_GET['test'])){
    // Memory usage: 488,832
    if($_GET['test'] === '1'){
        echo "-------- Regular array memory test --------<br />";
        $array = getTestArray($elements);
        passArr1($array);
        links();
    }
    // Memory usage: 280,144 - 2x less memory is needed in second case
    else if($_GET['test'] === '2'){
        echo "-------- ArrayObject memory test --------<br />";
        $arrayObj = new ArrayObject(getTestArray($elements));
        /// actual memory test
        passArr3($arrayObj);
        links();
    }
    else {
        throw new Exception("There is no test with number ".intval($_GET['test']));
    }
}
else {
    header("Location: ". basename(__FILE__).'?test=1');
    exit;
}
