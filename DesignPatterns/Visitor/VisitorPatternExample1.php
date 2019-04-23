<?php
/**
 * Created by PhpStorm.
 * User: Dominik
 * Date: 2019-04-23
 * Time: 01:13
 */

namespace DesignPatterns\Visitor\Ex1;

interface VisitorI {
    function visit(VisitableI $visitable);
}
interface VisitableI {
    function accept(VisitorI $visitor);
    function acceptVisitors(array $visitors);
    function getPulse();
}

abstract class HospitalPatient implements VisitableI {
    protected $pulse;
    public function getPulse(){
        return $this->pulse;
    }
    public function accept(VisitorI $visitor) {
        $visitor->visit($this);
        return $this;
    }
    public function acceptVisitors(array $visitors){
        foreach($visitors as $visitor){
            $this->accept($visitor);
        }
    }
}

class Nurse1 implements VisitorI {
    public function alertPersonnel($alert){
        echo "<b>ALERT!!! $alert </b><br />";
    }
    public function visit(VisitableI $visitable) {
        $pulse = $visitable->getPulse();
        if($visitable instanceof NewBornChild){
            if($pulse < 100 || $pulse > 200){
                $this->alertPersonnel("LIFE OF THE NEW BORN CHILD IN DANGER");
            }
         }
        else if($visitable instanceof OldMan){
            if($pulse < 50 || $pulse > 150){
                $this->alertPersonnel("OLD MAN IS DYING");
            }
        }
        else if($pulse < 10 || $pulse > 220){
            $this->alertPersonnel("SOME PATIENT IS IN DANGER");
        }
    }
}

class Nurse2 implements VisitorI {
    public function visit(VisitableI $visitable) {
        if($visitable instanceof NewBornChild){
            if($visitable->isHungry()){
                echo __CLASS__.": Baby is hungry, let's feed you....<br />";
                $visitable->feed();
            }
        }
    }
}

class Nurse3 implements VisitorI {
    public function visit(VisitableI $visitable) {
        if($visitable instanceof OldMan){
            if($visitable->isBored()){
                echo __CLASS__.": Ok I'm turning the TV on....<br />";
                $this->turnTvOn();
            }
        }
    }
    public function turnTvOn(){
        echo __CLASS__.": TV is turned ON! <br />";
    }
}

class NewBornChild extends HospitalPatient {
    protected $pulse = 120;
    protected $hungry = true;
    public function isHungry(){
        return $this->hungry;
    }
    public function feed(){
        echo __CLASS__.": chuckle, smiling <br />";
        $this->hungry = false;
    }
}

class OldMan extends HospitalPatient {
    protected $pulse = 70;
    public function isBored(){
        echo __CLASS__.": You asking me if I'm bored? DAMN YES! I'm here for six months now! <br />";
        return true;
    }
}
class DyingPerson extends HospitalPatient {
    protected $pulse = 0;
}

////// lets define some hospital patients
$child = new NewBornChild();
$oldMan = new OldMan();
$dyingPerson = new DyingPerson();
//// lets define some nurses (visitors)
$visitors = [new Nurse1(), new Nurse2(), new Nurse3()];
$child->acceptVisitors($visitors);
$oldMan->acceptVisitors($visitors);
$dyingPerson->acceptVisitors($visitors);