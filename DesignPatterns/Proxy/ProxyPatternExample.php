<?php
namespace DesignPatterns\Proxy;

/**
 * User: Dominik
 * Date: 2016-09-05
 * Time: 08:34
 */


class User {
    public function getUsername(){
        return "John";
    }

    public function getNickname(){
        return "DrDoom";
    }
    /**
     * We don't want this to be presented in template!
     * @return string
     */
    public function getPassword(){
        return "very_secret_pass";
    }

    /**
     * We for sure don't want to use this method in a template
     * @param $password
     */
    public function setPassword($password){
        // changing password in database code //
    }

    /**
     * This also should not be presented in template
     * @return string
     */
    public function getEmail(){
        return "my_mail@mail.com";
    }
}

/**
 * We need to create a proxy class for the template,
 * which ensures us that we never display user e-mail nor password in template
 */
class UserTemplateProxy{
    /**
     * @var User
     */
    private $user;
    public function __construct(User $user){
        $this->user = $user;
    }
    public function getUsername(){
        return $this->user->getUsername();
    }

    public function getNickname(){
        return $this->user->getNickname();
    }
}

////// example
// when we are inside model class we wish to have all the methods available
$user = new User();
// when we are inside template we don't want to have access to restricted methods
// so we should ALWAYS use proxy class to avoid potential mistakes.
$templateUser = new UserTemplateProxy($user);
echo "We are in template now,",
" so we can use only username:{$templateUser->getUsername()} and nickname: {$templateUser->getNickname()}";

