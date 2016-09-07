<?php
/**
 * User: Dominik
 * Date: 2016-09-05
 * Time: 05:17
 */
abstract class Shape {

    protected $name;

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
}

class Triangle extends Shape{
    public function __construct($name){
        $this->setName($name);
    }
}

class Square extends Shape{
    public function __construct($name){
        $this->setName($name);
    }
}

class ShapeFactory {
    private static $prototypeShapes = array();

    /**
     * @param $name
     * @return Shape
     */
    public static function getNewShape($name){
        // most important line in Prototype Pattern
        return clone self::$prototypeShapes[$name];
    }
    public static function predefinePrototypes(){
        self::$prototypeShapes['triangle'] = new Triangle('triangle123');
        self::$prototypeShapes['square'] = new Square('square456');
    }
}

///////// example ///////
// first we need to predefine prototypes
ShapeFactory::predefinePrototypes();
// then we can start cloning them
$triangle1 = ShapeFactory::getNewShape('triangle');
$triangle2 = ShapeFactory::getNewShape('triangle');
// now let's compare if objects are indeed clones
echo "triangle1 hash: ". spl_object_hash($triangle1);
echo "<br />";
echo "triangle2 hash: ". spl_object_hash($triangle2);
// but they are not the same object
$triangle2->setName("Triangle678");
echo "<br />Triangle2 name has changed to '{$triangle2->getName()}', but triangle1 name is still '{$triangle1->getName()}'";

