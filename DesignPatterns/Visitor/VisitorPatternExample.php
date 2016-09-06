<?php
/**
 * User: Dominik
 * Date: 2016-09-06
 * Time: 13:50
 */
namespace DesignPatterns\Visitor;

interface VisitorI {
    function visit(VisitableI $visitable);
}
interface VisitableI {
    function accept(VisitorI $visitor);
}

class HomeDevicesTurnedOnChecker implements VisitorI{

    function visit(VisitableI $visitable) {
         if ($visitable instanceof Laptop){
                $state = $visitable->operatingSystemOn() ? 'on' : 'off';
                echo "Your laptop is currently $state! <br />";
         }
         else if ($visitable instanceof TV){
                $state = $visitable->isOn() ? 'on' : 'off';
                echo "Your tv is currently $state! <br />";
         }
         else if ($visitable instanceof WashingMachine){
                 $state = $visitable->isTurnedOn() ? 'on' : 'off';
                 echo "Your washing machine is currently $state! <br />";
         }
    }
}

abstract class AbstractVisitable implements VisitableI {
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
        return true;
    }
}
class WashingMachine extends AbstractVisitable {
    public function isTurnedOn(){
        return false;
    }
}

/////// example ///////
$homeDevices = [ new Laptop(), new TV(), new WashingMachine() ];
$turnedOnChecker = new HomeDevicesTurnedOnChecker();
foreach($homeDevices as $device){ /* @var $device VisitableI */
    $device->accept($turnedOnChecker);
}