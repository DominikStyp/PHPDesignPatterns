# PHP Closures
### Defining PHP Closures
Closure is a function (similar to the function in **JavaScript**) that can be assigned to the variable, and invoked in same way as method or regular function.
Let's shorten built-in **strpos** usage with closure: <br />
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
### Returning Closures in PHP
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
    echo "second condition"; // matched !
}
```
See the full example in [ReturningClosures.php](ReturningClosures.php)<br />

### PHP Function customizer
To show how REALLY powerful closures are, I've written [FunctionCustomizer class](FunctionCustomizer.php), <br />
which has ability to predefine ANY function argument, and make invocations only with one argument that is really changing. <br />
Let's consider following problem. We wish to check regular expression for multiple strings like this: <br />
```php
if(preg_match("#\d{2}#","str22", $matches)){
  var_dump($matches);
}
if(preg_match("#\d{2}#","str", $matches)){
  var_dump($matches);
}
if(preg_match("#\d{2}#","str333asdf", $matches)){
  var_dump($matches);
}
```
... the best we can do to shorten the code is to store regular expression in some variable, <br />
but it doesn't resolve 3 mandatory parameters to pass every time, and pretty long syntax. <br />
I would be great if we could **customize this (and others) php functions** so we could predefine other parameters, <br />
and pass only one that is really changing ? <br />
Take a look at this: <br />
```php
$matches = array();
$pregMatch = (new FunctionCustomizer('preg_match', 3))
              ->setArgument(0, "#\d{2}#")
              ->setArgumentRef(2, $matches)
              ->getClosure();
/**
 *  To this closure we're gonna pass ONLY second argument (cause rest is already predefined).
 *  Isn't the following syntax clear, short and powerful ?
 */
if($pregMatch("str22")) {
    // Magically we have our matches variable set via reference
    // Just like Perl does it with magic $_ variable.
    var_dump($matches); 
}
if($pregMatch("str")){
    var_dump($matches);
}
if($pregMatch("str333asdf")){
    var_dump($matches);
}
```
Whole example is in file [functionCustomizerExample1.php](functionCustomizerExample1.php) <br />
To see how it works, take a look at [class FunctionCustomizer](FunctionCustomizer.php) <br />
You should also ask: What about performance? <br />
For now single closure invocation vs regular function invocation is about 4x slower, since it's user-defined function, <br />
and not built-in, written in C function. However difference is significant for more than 100 000 invocations. <br />
Result of the test from [functionCustomizerPerformanceTest.php](functionCustomizerPerformanceTest.php) <br />
<pre>
Loop with 100 000 iterations gave me following results:
Built-in preg_match: 0.15401983261108 sec
Closure in variable: 0.56257104873657 sec
</pre>


### Polymorphism with PHP Closures
To get more advanced example of how you can **chain Closures** in conjunction with **polymorphism** [Click Here](PolymorphismWithClosures.php)

### Summary 
#### Pros:
 1. significantly shorter code
 2. more reusable code
 3. less problems with refactoring methods (changing name or class that it belongs to).
 4. less usage of built-in PHP functions (as now you can define them in reusable closures)

#### Cons: 
 1. no IDE hints when using variables as closures
 2. less understandable code - since closures are custom, so programmer first must read its code to understand how it works
 3. possible template variable overwrite problems in MVC frameworks (name clashes etc.)
 
