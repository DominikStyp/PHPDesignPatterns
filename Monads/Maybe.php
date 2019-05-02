<?php
/**
 * Created by PhpStorm.
 * User: Dominik
 * Date: 2019-05-02
 * Time: 16:30
 */

namespace Monads;


class Maybe {
    private $value;

    public function __construct($value) {
        if(is_object($value) && $value instanceof static){
            $value = $value->value();
        }
        $this->value = $value;
    }

    public static function create(...$params){
        return new static(...$params);
    }

    public function getProp($property){
        if($this->value !== null){
            return $this->value->{$property};
        }
        return null;
    }

    public function then(callable $func){
        if($this->value !== null) {
            return static::create($func($this->value));
        }
        return static::create(null);
    }

    public function value(){
        return $this->value;
    }

    public function __call($method, $arguments) {
        return $this->then(function($value) use ($method){
            return $value->{$method};
        });
    }

    public function __get($property) {
        return $this->then(function($something) use ($property){
                return $something->{$property};
        });
    }

}