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
    private $x = 10, $y = 5, $z = 12, $height = 7;
    function getPerimeter() { return $this->x + $this->y + $this->z; }
    function getArea()      { return ($this->x/2) * $this->height; }
    function getType()      { return "Triangle"; }
}
class Square implements ShapeI {
    private $x = 10;
    function getPerimeter() { return $this->x * 4; }
    function getArea()      { return $this->x * $this->x; }
    function getType()      { return "Square"; }
}
abstract class AbstractFactory {
    /**
     * @var ShapeI
     */
    private $shape;
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
     * Factory method returns interface or an class.
     * But inherited methods should return the concrete type based on the interface
     * @return ShapeI
     */
    public function getShape() {
        return new Triangle();
    }
}

//////// example /////////////
$triangle = (new TriangleFactory())->getShape();
echo "Triangle area: {$triangle->getPerimeter()} ";