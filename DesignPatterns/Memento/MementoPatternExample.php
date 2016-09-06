<?php
/**
 * User: Dominik
 * Date: 2016-09-06
 * Time: 07:59
 */
namespace DesignPatterns\Memento;

/**
 * Memento
 * This class holds the state of the Originator
 * @package DesignPatterns\Memento
 */
class Memento {
    private $state;

    public function __construct($state) {
        $this->state = $state;
    }

    public function getState() {
        return $this->state;
    }
}

/**
 * Originator
 * Main object which versions wee need to store/retrieve
 * @package DesignPatterns\Memento
 */
class Note {
    private $state;

    public function setState($state) {
        $this->state = $state;
    }

    public function getState(){
        return $this->state;
    }

    /**
     * Save current state
     * @return Memento
     */
    public function saveStateToMemento() {
        return new Memento($this->state);
    }

    /**
     * Rollback to the choosed Memento
     * @param Memento $memento
     */
    public function restoreFromMemento(Memento $memento) {
        $this->state = $memento->getState();
    }
}

/**
 * Caretaker
 * This class holds Memento objects references (versions)
 * @package DesignPatterns\Memento
 */
class Versioner {
    /**
     * @var Memento[]
     */
    private $mementos = array();

    public function add(Memento $memento, $versionId) {
        $this->mementos[$versionId] = $memento;
    }

    /**
     * @param $versionId
     * @return Memento
     */
    public function get($versionId) {
        return $this->mementos[$versionId];
    }
}

////// example ///////
// let's use Originator as a note, Caretaker as versions storage, and Memento as a version
$note = new Note();
$versioner = new Versioner();

$note->setState("This is my first note (v1.0)"); //change state of our main object
$note->setState("This is my second note (v1.1)");
//save this state to memento
$versioner->add( $note->saveStateToMemento(), "1.1" );
// set another state
$note->setState("This is only a test note (v2.3.3)");
//save this state to memento with the key same as the version "2.3.3"
$versioner->add( $note->saveStateToMemento(), "2.3.3" );
// restore originators version to 1.1
$note->restoreFromMemento( $versioner->get("1.1") );
echo "<p>I've restored version 1.1 of the originator: <b>{$note->getState()}</b></p>";