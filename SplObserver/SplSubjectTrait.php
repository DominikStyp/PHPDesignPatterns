<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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

