<?php
/**
 * User: Dominik
 * Date: 2016-09-02
 * Time: 03:45
 */

interface ForumUserI {
    public function loggedIn();
    public function isAdmin();
    public function canPost();
    public function canBan();
    public function getUsername();
    public function getPassword();
}

class MyUser {
    private $userData;
    public function __construct(array $userData){
        $this->userData = $userData;
    }
    public function isLoggedIn(){
        return true;
    }
    public function hasPostingAbility(){
        return true;
    }
    public function getUserData(){
        return $this->userData;
    }
}

class ForumUser implements ForumUserI {

    private $username;
    private $password;

    public function __construct($username, $password){
        $this->username = $username;
        $this->password = $password;
    }

    public function loggedIn() {
        return false;
    }

    public function isAdmin() {
        return true;
    }

    public function canPost() {
        return true;
    }

    public function canBan() {
        return false;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }
}
class ForumUserAdapter implements ForumUserI {

    private $myUser;
    public function __construct(MyUser $myUser){
        $this->myUser = $myUser;
    }
    public function loggedIn() {
        return $this->myUser->isLoggedIn();
    }

    public function isAdmin() {
        return true;
    }

    public function canPost() {
        return $this->myUser->hasPostingAbility();
    }

    public function canBan() {
        return false;
    }
    public function getUsername() {
        $data = $this->myUser->getUserData();
        return $data['username'];
    }

    public function getPassword() {
        $data = $this->myUser->getUserData();
        return $data['password'];
    }

}
class UserDisplay {
    public static function display(ForumUserI $user){
        $class = get_class($user);
        $loggedIn = $user->loggedIn() ? '(logged in)' : '(Guest)';
        $admin = $user->isAdmin() && $user->loggedIn() ? '[Admin]' : '';
        $username = $user->getUsername();
        echo "<br /> ----- $class ----",
             "<br />Hello: $username $loggedIn $admin";
    }
}

/////////// example ////////////
$myUser = new MyUser(['username' => 'DrDoom', 'password' => 'super_villain']);
$forumUser = new ForumUser('MrFantastic', 'chewing_gum');
// adapter changes MyUser into ForumUser
$forumUserAdapter = new ForumUserAdapter($myUser);
UserDisplay::display($forumUser);
UserDisplay::display($forumUserAdapter);

