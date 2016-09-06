<?php
/**
 * User: Dominik
 * Date: 2016-09-06
 * Time: 15:28
 */
namespace DesignPatterns\Iterator;

class IteratorTest implements \Iterator{

    private $one = "one";
    private $two = "two";
    private $three = "three";

    private $counter = 1;
    private $max = 3;
    /**
     * @param $val
     * @throws \Exception
     * return int;
     */
    private function getByCounterVal($val){
        switch($val){
            case 1 : return $this->one;
            case 2 : return $this->two;
            case 3 : return $this->three;
            default: throw new \Exception("Wrong counter value");
        }
    }
    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current() {
        return $this->getByCounterVal($this->counter);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next() {
        $this->counter++;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key() {
        return $this->counter;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid() {
        return $this->counter <= $this->max;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind() {
        $this->counter = 1;
    }
}

/// example
// after implementing Iterator Pattern we can iterate over our object in:
// foreach loops
echo "--- foreach ---<br />";
foreach(new IteratorTest() as $key => $val){
    echo "Current key: $key, and value: $val <br />";
}
// while loops
echo "--- while ---<br />";
$itTest = new IteratorTest();
// this does the same as foreach but it's not much convenient
while($itTest->valid()){
    $key = $itTest->key();
    $val = $itTest->current();
    echo "Current key: $key, and value: $val <br />";
    $itTest->next();
}