<?php
/**
 * User: Dominik
 * Date: 2016-09-09
 * Time: 14:05
 */
namespace DesignPatterns\FactoryMethod;

interface ShapeI {
    function getPerimeter();
    function getArea();
    function getType();
}
class Triangle implements ShapeI {
    public $x = 0, $y = 0, $z = 0, $height = 0;
    function getPerimeter() { return $this->x + $this->y + $this->z; }
    function getArea()      { return ($this->x/2) * $this->height; }
    function getType()      { return "Triangle"; }
}
class Square implements ShapeI {
    public $x = 0;
    function getPerimeter() { return $this->x * 4; }
    function getArea()      { return $this->x * $this->x; }
    function getType()      { return "Square"; }
}
abstract class AbstractFactory {
    /**
     * @var ShapeI
     */
    protected $shape;
    public function __construct(){
        $this->shape = $this->getShape();
    }

    /**
     * Factory method returns interface or an abstract class.
     * But inherited methods should return the concrete type based on the interface
     * @return ShapeI
     */
    abstract protected function getShape();

    public function getShapeType(){
        return $this->shape->getType();
    }
}

class TriangleFactory extends AbstractFactory {
    /**
     * Overridden method forces AbstractFactory to create $shape as a Triangle
     * @return Triangle
     */
    protected function getShape() {
        return new Triangle();
    }

    /**
     * In this method we can easily manipulate the Triangle object which is already created
     * Equilateral = has the same length of each side
     * @return Triangle
     */
    public function getEquilateralTriangle($side){
        /**
         * @var $triangle Triangle
         */
        $triangle = $this->shape;
        // this should be done by triangle setters, but this is simple example just to show factory method
        $triangle->x = $triangle->y = $triangle->z = $side;
        return $triangle;
    }
}

//////// example /////////////
$factory = new TriangleFactory();
echo "Shape type created: {$factory->getShapeType()} <br />";
// since we have Triangle created, we can easily manipulate it.
$triangle = $factory->getEquilateralTriangle(10);
echo "Area: {$triangle->getPerimeter()} <br />";