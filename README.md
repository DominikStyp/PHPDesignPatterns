# This repo contains quick and useful examples in PHP
## Design Patterns
[Design Patterns](DesignPatterns) is a chapter, where I've wrote most simple examples showing how, and when to use most of them.<br />
All the patterns come from the book **Design Patterns: Elements of Reusable Object-Oriented Software** written by **Gang of Four**.<br /> All of them fall into 3 main categories:
 1. [Creational Patterns](DesignPatterns#creational-patterns)
 2. [Structural Patterns](DesignPatterns#structural-patters)
 3. [Behavioural Patterns](DesignPatterns#behavioural-patterns)

## Closures 
How to effectively use [**PHP Closures**](Closures), returning them from the methods, <br />
and even [**Customize PHP functions**](Closures#function-customizer), and predefine their arguments, <br /> 
as it's shown in the following example: <br />
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
    // Just like Perl does it with magical $_ var.
    var_dump($matches); 
}
if($pregMatch("str")){
    var_dump($matches);
}
if($pregMatch("str333asdf")){
    var_dump($matches);
}
```
## SPL (Standard PHP Library) use examples
* [SplObserver example](SPL/SplObserver/Subject.php) - uses implementation of the **SplObserver** class of **Standard PHP Library**.
This example shows how **NOT TO COPY** the same implementation code all over again in every class where you want to use **SplObserver**.
For that purpose I've used [PHP Traits](http://php.net/manual/en/language.oop5.traits.php) functionality, so every class that has to implement this interface just need to have the following statement: 
```php
class Example {
  use SplSubjectTrait;
}
```
* [ArrayIterator example](SPL/SplIterators/ArrayIterators.php) - example of using **ArrayIterator** in conjunction with:
  1. **RecursiveArrayIterator**
  2. **CallbackFilterIterator**
  3. **LimitIterator**
  4. conversion from iterator to array using **iterator_to_array()**

Sample code from [ArrayIterators.php](SPL/SplIterators/ArrayIterators.php):
```php 
    /**
     * Example of how we can chain iterators.
     * Let's say we want to: 
     *  1) recursively display deeply nested array
     *  2) display only names that have 5 or more characters
     *  3) sort in alphabetical order
     *  4) limit display to first 5
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
```
* [SplObjectStorage example](SPL/SplObjectStorage/SplObjectStorageExample.php) - example of using **SplObjectStorage** with hashing, which can **simulate Java Set** in PHP.
* [Generators vs Switch-Case vs Array] (Generators/GeneratorsExample.php) - example of using **Generators** in order to minimize memory usage, and prevent from generating big arrays.
