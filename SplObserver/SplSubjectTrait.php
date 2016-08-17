<?php

/* 
 * This trait can be used in every class that has to implement SplSubject interface
 */

trait SplSubjectTrait {
    	private $observersArray = array();
	public function attach(SplObserver $observer){
                $id = spl_object_hash($observer);
		$this->observersArray[$id] = $observer;
	}
	public function detach(SplObserver $observer){
                $id = spl_object_hash($observer);
		unset($this->observersArray[$id]);
	}
	public function notify(){
		foreach($this->observersArray as $observer){
			$observer->update($this);
		}
	}
}

