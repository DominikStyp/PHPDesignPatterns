# ArrayObject usage examples

## ArrayObject flags usage
Demonstration of **how to use ArrayObject flags** : <br />
### ArrayObject::ARRAY_AS_PROPS
```php
$arrObj = new ArrayObject([
    'name' => 'Jon',
    'surname' => 'Snow',
    'age' => 'unknown',
]);
$arrObj->setFlags(\ArrayObject::ARRAY_AS_PROPS);
// without ARRAY_AS_PROPS we get:  "Notice: Undefined property: ArrayObject::$name"
echo "Name $arrObj->name";
```
### ArrayObject::STD_PROP_LIST
```php
$arrObj = new ArrayObject();
$arrObj->name = 'Jon';
$arrObj->surname = 'Snow';
$arrObj->age = 'unknown';
$arrObj->setFlags(\ArrayObject::STD_PROP_LIST);
// Without ArrayObject::STD_PROP_LIST nothing gets printed in var_dump() nor in the loop
var_dump($arrObj);
foreach(get_object_vars($arrObj) as $prop => $val){
    echo "$prop : $val <br />";
}
```
Full example you can find here: [ArrayObjectFlagsUsageExample.php](ArrayObjectFlagsUsageExample.php) <br />
And also you can see how **not to use flags**, because it has no effect in some cases: [ConstructorFlagsWithoutEffectExample.php](ConstructorFlagsWithoutEffectExample.php) <br />

## Use built-in array functions on ArrayObject
To do that, you need to use reflection trick: <br />
```php
 public function __call($func, $argv) {
        if (!is_callable($func) || substr($func, 0, 6) !== 'array_') {
            throw new BadMethodCallException(__CLASS__.'->'.$func);
        }
        return call_user_func_array($func, array_merge(array($this->getArrayCopy()), $argv));
 }
```
Check out full example: [ArrayObjectExample.php](ArrayObjectExample.php) <br />
## Minimize memory usage
Normally in PHP arrays (in contract to Java arrays), are passed to the function **by value**,<br />
so whole array is copied like scalar value, and passed to the function, which is time and memory consuming process.<br />
To avoid this, you can change your array to **ArrayObject**, so it's gonna behave like array, but it won't get copied.<br />
```php
function modify($var){
    $var[0] = 'changed';
}
$arrObj = new ArrayObject(['one', 'two', 'three']);
modify($arrObj);
echo $arrObj[0]; //changed
```
See full example [ArrayObjectPassWithoutReferenceExample.php](ArrayObjectPassWithoutReferenceExample.php)<br />
Very important also is that you can **save a lot of memory** using ArrayObject in cases like:<br />
```php
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
$hugeArray = array_fill(0,10000,mt_rand(1000000,1999999));
// in this case $hugeArray is gonna be copied for all nested functions
passArr1($hugeArray);
// but using ArrayObject, you can avoid this, so every nested function operates on the same object
passArr1(new ArrayObject($hugeArray));
```
See **comparing memory test array vs ArrayObject** here: [ArrayObjectPassMemoryTest.php](ArrayObjectPassMemoryTest.php) <br />
