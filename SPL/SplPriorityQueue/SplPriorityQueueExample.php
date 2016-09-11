<?php
/**
 * User: Dominik
 * Date: 2016-09-11
 * Time: 02:06
 */
namespace SPL\SplPriorityQueue;

/**
 * Interface PrioritableI
 * Following interface must be implemented by each object that will fall into the Queue
 * @package SPL\SplPriorityQueue
 */
interface PrioritableI {
    /**
     * @return string|int|float
     */
    function getPriority();
}

/**
 * SortedQueue can change sorting order via sort type
 * @package SPL\SplPriorityQueue
 */
class SortedQueue extends \SplPriorityQueue
{
    const SORT_ASCENDING = 0;
    const SORT_DESCENDING = 1;
    private $sortType;
    public function __construct($sortType = self::SORT_ASCENDING){
        $this->sortType = $sortType;
    }
    public function compare($priority1, $priority2) {
        if ($priority1 === $priority2) return 0;
        if($this->sortType === self::SORT_ASCENDING) {
            return $priority1 > $priority2 ? -1 : 1;
        } else {
            return $priority1 < $priority2 ? -1 : 1;
        }
    }
    public function add(PrioritableI $object){
        $this->insert($object, $object->getPriority());
    }

    /**
     * @param PrioritableI[] $objects
     */
    public function addArray(array $objects){
        foreach($objects as $el){
            $this->add($el);
        }
    }
}

class Post implements PrioritableI {
    private $title;
    private $date;
    public function __construct($title, $date){
        $this->title = $title;
        $this->date = $date;
    }
    public function getDate() {
        return $this->date;
    }
    public function getTitle() {
        return $this->title;
    }
    /**
     * This method must return a value for the comparator
     * @see SortedQueue::compare()
     * @return float|int|string
     */
    public function getPriority(){
        return strtotime($this->getDate());
    }
}

/////////// example ///////

// we want those posts to be ordered by date
$posts = [
    new Post("Article about PHP SPL", "2016-02-11"),
    new Post("My first post", "2012-01-03"),
    new Post("Links to PHP Books Part2", "2015-09-12 22:30:21"),
    new Post("Links to PHP Books Part1", "2015-09-12 22:00:54"),
    new Post("Blog has been created", "2012-07-14 12:33:32"),
];
/**
 * Rememeber ! Sorting order must be defined before adding objects to the queue.
 * That's because compare() function compares elements while they're added, not retrieved.
 */
$queue = new SortedQueue(SortedQueue::SORT_ASCENDING);
$queue->addArray($posts);
// display posts in correct order
foreach($queue as $el){ /* @var $el Post */
    echo "<b>{$el->getTitle()}</b> <i>[ {$el->getDate()} ]</i> <br />";
}
