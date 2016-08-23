<?php

namespace version1;

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
        echo "User v1 has logged in with data {$username} : {$password} <br />";
    }

    public function logout()
    {
        if(empty($this->username)){
            throw new \Exception("Log in first!");
        }
        echo "User v1 has logged out. Bye {$this->username}!<br />";
        $this->username = "";
        $this->password = "";
    }

    public function postMessage($message)
    {
        if(empty($this->username)){
            throw new \Exception("Log in first!");
        }
        echo "User v1 {$this->username} has posted: {$message}<br />";
    }

}
