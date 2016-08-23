<?php

namespace version2;

/**
 * UserClass
 *
 * @author Dominik
 */
class UserClass implements \User {
    
    private $username;
    private $password;
    
    public function login($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        echo "Hello v2: {$username} : {$password}<br />";
    }

    public function logout()
    {
        if(empty($this->username)){
            throw new \Exception("Log in first!");
        }
        echo "Bye v2 {$this->username}!";
        $this->username = "";
        $this->password = "";
    }

    public function postMessage($message)
    {
        if(empty($this->username)){
            throw new \Exception("Log in first!");
        }
        echo "User v2 {$this->username} said: {$message}<br />";
    }

}
