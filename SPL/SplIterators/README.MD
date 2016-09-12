# SPL Iterators
## ArrayIterator example
Let's consider following array, that you wish to iterate over in **recursive way**. <br />
```php
$myArray = array(
        'John', 'Andrew',
             array('Ann', 'Barbara','Jenna',
                    array('Fiona','Natasha','Charlize',
                            array('Scarlett','Alexandra')
                          )
                  ),
        'Mary', 'Philip', 'Bridgett'
    )
```
You can do this easily using **built-in SPL Iterators**.<br />
```php
        $it = new RecursiveArrayIterator($myArray);
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
        //now we can display it
        foreach($it4 as $val){
                echo "$val <br />";
        }
```
Full example wrapped in a class: [ArrayIterators.php](ArrayIterators.php) <br />
## RegexIterator example
### RegexIterator NOT_MATCH flag
Since PHP developers actually didn't provide **NO_MATCH** flag for this iterator, <br />
I wrote my own extension of the Iterator:<br />
```php
class RegexIteratorCustom  extends \RegexIterator {
    const NOT_MATCH = 10;
    private $mode;
    public function __construct(Iterator $iterator, $regex, $mode = self::MATCH, $flags = 0, $preg_flags = 0) {
        $this->mode = $mode;
        if($mode === self::NOT_MATCH){
            $mode = parent::MATCH;
        }
        parent::__construct($iterator, $regex, $mode, $flags, $preg_flags);
    }
    public function accept() {
        return $this->mode === self::NOT_MATCH ? !parent::accept() : parent::accept();
    }
}
```
Full example is here [RegexIteratorExample.php](RegexIteratorExample.php).<br />
You can use this class the same way as **RegexIterator** but with additional **flag NOT_MATCH**,<br />
in case you want to throw away results that do not match your regular expression, <br />
which is equal to ` !preg_match(....) `.