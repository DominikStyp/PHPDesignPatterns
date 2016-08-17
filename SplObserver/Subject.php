<?php
require_once 'SplSubjectTrait.php';

class Subject implements SplSubject{
        /**
         * Here we don't want to care about storing/adding/removing observers code!
         * Code regarding observers should be the same in every class.
         * The best way to achieve that and be able to inherit from parent class at the same time
         * is to use traits for that purpose
         * 
         */
        use SplSubjectTrait;
        
	private $value;

	public function setValue($value){
		$this->value = $value;
		$this->notify();
	}
	
	public function getValue(){
		return $this->value;
	}
}

class AcceptIntegersObserver implements SplObserver {
	public function update(SplSubject $subject){
                if(!filter_var($subject->getValue(), FILTER_VALIDATE_INT)){
                    throw new Exception("You can't set non-integer values!");
                }
	}
	
}
$subject = new Subject();
$observer = new AcceptIntegersObserver();
$subject->attach($observer);
$subject->setValue(5);
//$subject->setValue("5d");  // Exception!
$subject->detach($observer);
$subject->setValue("5d"); // observer detached - you can pass other values
