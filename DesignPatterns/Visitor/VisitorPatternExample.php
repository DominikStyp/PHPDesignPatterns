<?php
/**
 * User: Dominik
 * Date: 2016-09-06
 * Time: 13:50
 */
namespace DesignPatterns\Visitor;

interface VisitorI {
    function visit(VisitableI $visitable);
    function setAdditionalData(array $data);
}
interface VisitableI {
    function accept(VisitorI $visitor);
}

class HomeDevicesTurnedOnChecker implements VisitorI{
    private $data = [];
    function setAdditionalData(array $data){
        $this->data = $data;
    }
    /**
     * If this method has complicated logic, should be splitted to smaller methods
     * like: visitLaptop(), visitTv(), visitWashingMachine().....
     * @param VisitableI $visitable
     */
    function visit(VisitableI $visitable) {
         if ($visitable instanceof Laptop){
                $state = $visitable->operatingSystemOn() ? 'on' : 'off';
                echo "<p>Your laptop is currently $state! <br /></p>";
         }
         else if ($visitable instanceof TV){
                $state = $visitable->isOn() ? 'on' : 'off';
                echo "<p>Your tv is currently $state! <br /></p>";
         }
         else if ($visitable instanceof WashingMachine){
                 $state = $visitable->isTurnedOn() ? 'on' : 'off';
                 echo "<p>Your washing machine is currently $state!<br />",
                      "And it's gonna turn off in {$this->data['minutesToEnd']}<br /></p>";
                 $this->data = [];
         }
         else {
             throw new \Exception("Unknown visitable object");
         }
    }
}

abstract class AbstractVisitable implements VisitableI {
    /**
     * In case logic in accept method changes, you can always override this method in child class.
     * @param VisitorI $visitor
     */
    public function accept(VisitorI $visitor){
        $visitor->visit($this);
    }
}
class Laptop extends AbstractVisitable {
    public function operatingSystemOn(){
        return true;
    }
}
class TV extends AbstractVisitable {
    public function isOn(){
        return false;
    }
}
class WashingMachine extends AbstractVisitable {
    private $minutesToEnd = 30;
    public function isTurnedOn(){
        return true;
    }
    /**
     * If we must pass some private class data, and give only visitor access to it - no problem,
     * we can always override accept(), and pass it via other visitor's method
     * @param VisitorI $visitor
     */
    public function accept(VisitorI $visitor){
        $visitor->setAdditionalData([ 'minutesToEnd' => $this->minutesToEnd ]);
        parent::accept($visitor);
    }
}

/////// example ///////
$homeDevices = [ new Laptop(), new TV(), new WashingMachine() ];
$turnedOnChecker = new HomeDevicesTurnedOnChecker();
foreach($homeDevices as $device){ /* @var $device VisitableI */
    $device->accept($turnedOnChecker);
}