<?php

interface UserStateI {
    function login($username, $password);

    function logout();

    function postMessage($message);

    function getStateName();
}

class User implements UserStateI {
    /**
     * @var UserStateI
     */
    private $stateCurrent, $stateLoggedOut, $stateLoggedIn;

    public function __construct() {
        $this->stateCurrent = new UserStateLoggedOut($this);

        $this->stateLoggedIn = new UserStateLoggedIn($this);
        $this->stateLoggedOut = new UserStateLoggedOut($this);
    }

    function login($username, $password) {
        $this->stateCurrent->login($username, $password);
    }

    function logout() {
        $this->stateCurrent->logout();
    }

    function postMessage($message) {
        $this->stateCurrent->postMessage($message);
    }

    /// following methods will be used by state objects to change THIS object state
    public function changeStateToLoggedOut() {
        $this->stateCurrent = $this->stateLoggedOut;
    }

    public function changeStateToLoggedIn() {
        $this->stateCurrent = $this->stateLoggedIn;
    }

    function getStateName() {
        echo "Current state is: " . $this->stateCurrent->getStateName(). "<br />";
    }
}

class UserStateLoggedIn implements UserStateI {

    /**
     * @var User
     */
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    function login($username, $password) {
        echo "You cannot login again $username! You're already logged in <br />";
    }

    function logout() {
        $this->user->changeStateToLoggedOut();
        echo "Logging out! Goodbye! <br />";
    }

    function postMessage($message) {
        echo "You've posted: $message <br />";
    }

    function getStateName() {
        return __CLASS__;
    }
}

class UserStateLoggedOut implements UserStateI {

    /**
     * @var User
     */
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    function login($username, $password) {
        $this->user->changeStateToLoggedIn();
        echo "Hello $username! You have logged in successfully <br />";
    }

    function logout() {
        echo "You are already logged out! <br />";
    }

    function postMessage($message) {
        echo "You cannot post message being logged out. <br />";
    }
    function getStateName() {
        return __CLASS__;
    }
}

/////////// usage example /////////////

$user = new User();
$user->getStateName();
// try to post message while being logged out
$user->postMessage("My massage");
//login
$user->login("Dominik", "Styp");
//another (wrong) attempt to login
$user->login("Dominik", "Styp");
$user->getStateName();
//post message again
$user->postMessage("Try my massage again...");
$user->logout();



