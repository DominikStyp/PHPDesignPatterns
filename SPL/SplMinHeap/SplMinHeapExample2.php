<?php
/**
 * User: Dominik
 * Date: 2016-09-10
 * Time: 22:15
 */
namespace SPL\SplMinHeap;
/**
 * In the following example I'm sorting objects via their properties.
 * I have a class category with 'id' and 'parent_id' properties.
 * I wanna sort those objects in the following way:
 *  - first I want to have objects sorted via their parent categories 'parent_id'
 *  - if there are groups of objects with the same 'parent_id' I want to sort them via 'id'
 */
/**
 * Class representing category
 * @package SPL\SplMinHeap
 */
class C {
    private $id;
    private $parentId;
    public function __construct($parentId, $id) {
        $this->id = $id;
        $this->parentId = $parentId;
    }
    public function getId()       { return $this->id; }
    public function getParentId() { return $this->parentId; }
    public function __toString(){
        return "{ category: (parent_id:{$this->parentId}, id:{$this->id}) }";
    }
}
class CategoriesHeap extends \SplMinHeap {
    /**
     * Sorting via 'parentId' first, and then via 'id'
     * @param mixed $value1
     * @param mixed $value2
     */
    protected function compare($value1, $value2) {
        $v1 = $v2 = [];
        // remember to fill each values array in correct order
        // from first sorted values to last sorted
        $v1[] = $value1->getParentId();
        $v1[] = $value1->getId();

        $v2[] = $value2->getParentId();
        $v2[] = $value2->getId();
        return parent::compare($v1, $v2);
    }

}

$cHeap = new CategoriesHeap();
/**            new C(parent_id, id) */
$cHeap->insert(new C(2,0));
$cHeap->insert(new C(2,4));
$cHeap->insert(new C(2,3));
$cHeap->insert(new C(1,9));
$cHeap->insert(new C(1,4));
$cHeap->insert(new C(3,4));
echo "First we're gonna sort object via 'parent_id' and then via 'id' property <br />";
foreach($cHeap as $cat){ /* @var $cat C */
    echo $cat . "<br />";
}
