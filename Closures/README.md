## Returning Closures
This feature of PHP 5.4 this allows programmer to significantly shorten the code <br />
Instead of using method calls everywhere, you can temporarily assign it to the variable <br />
and use it without worrying to redeclare function: <br />
```php
class ReturningClosures {

    private function getMatcher($regex){
        return function($subjectString) use ($regex) {
            return preg_match($regex,$subjectString);  
        };
    }
    public function getDateMatcher(){
        return $this->getMatcher("#^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$#");
    }
}
```
Let's see how we can use this class to create custom matcher stored **in variable** : <br />
```php
$obj = new ReturningClosures();
$m = $obj->getDateMatcher();
if($m("abcd")){
    echo "first condition";
} else if($m("1964-01-01 22:33:00")) {
    echo "second condition";
}
```
See the full example in [ReturningClosures.php](ReturningClosures.php)<br />
We can also define closures without using any class.<br />
Let's shorten built-in **strpos** usage: <br />
```php
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
```
<br />
... and let's see how it works in a shorter way:<br />
<br />
```php
$myStr = "soooome niiice stringggggg";
// thanks to static variable we only need to pass subject string once,
// if we wish to reuse it in further calls
if($inStr("iii",$myStr)){
    echo "cond 1 <br />";
}
// here variable $myStr is held in static $_str, and reused in this call
if($inStr("ooo") && $inStr("stringg") && $inStr("soo")){
    echo "cond 2 <br />";
}
// ... again second argument will be reused in the following call
if($inStr("ggg") && !$inStr("nii") && !$inStr("ooo")){
    echo "cond 3 <br />";
}
```
See the full example in [handyClosures.php](handyClosures.php)<br />
### Summary 
#### Pros:
 1. significantly shorter code
 2. less problems with refactoring methods (changing name or class that it belongs to)
 3. less usage of built-in PHP functions (as now you can define them in reusable closures)

#### Cons: 
 1. no IDE hints when using variables as closures
 2. less readable code - since closures are custom, so programmer first must read its code to understand how it works
 3. possible template variables overwriting problems in MVC frameworks (name clashes etc.)
 