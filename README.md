# This repo contains quick and useful examples in PHP
* [SplObserver example](SplObserver/Subject.php) - uses implementation of the **SplObserver** class of **Standard PHP Library**.
This example shows how **NOT TO COPY** the same implementation code all over again in every class where you want to use **SplObserver**.
For that purpose I've used [PHP Traits](http://php.net/manual/en/language.oop5.traits.php) functionality, so every class that has to implement this interface just need to have the following statement: 
```php
class Example {
  use SplSubjectTrait;
}
```
* [ArrayIterator example](SplIterators/ArrayIterators.php) - example of using **ArrayIterator** in conjunction with:
  1. **RecursiveArrayIterator**
  2. **CallbackFilterIterator**
  3. **LimitIterator**
  4. conversion from iterator to array using **iterator_to_array()**

Sample code from [ArrayIterators.php](SplIterators/ArrayIterators.php):
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
* [SplObjectStorage example](SplObjectStorage/SplObjectStorageExample.php) - example of using **SplObjectStorage** with hashing, which can **simulate Java Set** in PHP.
* [Generators vs Switch-Case vs Array] (Generators/InlineArrayIteratonExample.php) - example of using **Generators** in order to minimize memory usage, and prevent from generating big arrays.


* Funny example, how to destroy every application based on autoloading, without using: throw, exit, eval and other obvious functions:
```php
spl_autoload_unregister("spl_autoload_call");
```
... this unregisters all the registered autoloaders.
