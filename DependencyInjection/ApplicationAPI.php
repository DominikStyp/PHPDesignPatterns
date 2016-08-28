<?php
/**
 * Example of how to use STATIC API class with possibility of dependency injection
 *
 * @author Dominik
 */
class ApplicationAPI {
    private static $apiNamespace = 'version1';
    /**
     *
     * @var \User
     */
    private static $currentUser;
    public static function changeNamespace($namespace){
        self::$apiNamespace = $namespace;
    }
    /**
     * Methods gets instance of the UserClass via singleton (only one instance is possible)
     * We can have many implementations of the UserClass but every one must implement User interface
     * @return \User
     */
    public static function getUser(){
        $className = "\\" . self::$apiNamespace . "\UserClass";
        if(is_object(self::$currentUser) && is_a(self::$currentUser, $className)){
            return self::$currentUser;
        }
        self::$currentUser = new $className();
        // we must be sure wheter class implements \User interface (via is_a() function)
        if(!is_a(self::$currentUser, '\User')){
            throw new \Exception("Invalid type of the class $className");
        }
        return self::$currentUser;
    }

    public static function postMessage($message){
        self::getUser()->postMessage($message);
    }

    public static function logout(){
        self::getUser()->logout();
    }

    public static function login($username, $password){
        self::getUser()->login($username, $password);
    }
}

