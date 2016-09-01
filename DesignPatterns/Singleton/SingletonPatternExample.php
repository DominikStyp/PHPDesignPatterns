<?php
/**
 * User: Dominik
 * Date: 2016-09-01
 * Time: 00:59
 */
class SingletonObject {
    /**
     * @var SingletonObject[]
     */
    private static $intances = array();
    private $prop1;
    private $prop2;

    private function __construct(array $arguments){
        echo "Instantiating ".__CLASS__. "<br />";
        foreach($arguments as $k => $v){
            $this->{$k} = $v;
        }
    }
    public function getProp1(){
        return $this->prop1;
    }

    /**
     * Singleton method which can instantiate different types of the same object,
     * but only if parameters are changing.
     * For the same parameters, same instance will be returned
     * @param $prop1
     * @param $prop2
     * @return mixed
     */
    public static function getInstance($prop1, $prop2){
        $arguments = [ 'prop1' => $prop1, 'prop2' => $prop2 ];
        $hash = md5(serialize($arguments));
        if(empty(self::$intances[$hash])){
            self::$intances[$hash] = new SingletonObject($arguments);
        }
        return self::$intances[$hash];
    }

}

/////////// example ////////
$obj = SingletonObject::getInstance('one', 'two');
$obj = SingletonObject::getInstance('one', 'two'); //new instance isn't created
echo "Property 1: ", $obj->getProp1(), "<br />";
$obj = SingletonObject::getInstance('two', 'three'); //change params, new instance is created
echo "Property 1: ", $obj->getProp1(), "<br />";