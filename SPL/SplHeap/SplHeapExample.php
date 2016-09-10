<?php
/**
 * User: Dominik
 * Date: 2016-09-10
 * Time: 19:56
 */
namespace SPL\SplHeap;

class SortedUsersHeap extends \SplHeap
{
    public function compare($array1, $array2)
    {
        /* @var $user1 User */
        /* @var $user2 User */
        $user1 = $array1['user'];
        $user2 = $array2['user'];
        if ($user1->getId() === $user2->getId()){
            return 0;
        }
        return $user1->getId() < $user2->getId() ? 1 : -1;
    }



}

class User {
    private $id;
    private $name;
    public function __construct($id, $name){
        $this->id = $id;
        $this->name = $name;
    }
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
}


$heap = new SortedUsersHeap();
$heap->insert(array('user' => new User(10,"Hulk"), 'notes' => "sss"));
$heap->insert(array('user' => new User(3, "Tony Stark"), 'notes' => "aaa"));
$heap->insert(array('user' => new User(12, "Thor"), 'notes' => "bbb"));
$heap->insert(array('user' => new User(134, "Black Widow"), 'notes' => "ccc"));
// and here we get users sorted via userId
foreach($heap as $el){ /* @var $el['user'] User */
    $id = $el['user']->getId();
    $name = $el['user']->getName();
    echo "User $id : $name <br />";
}