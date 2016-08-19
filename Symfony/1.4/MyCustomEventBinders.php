<?php

/**
 * MyCustomEventBinders
 *
 * @author Dominik
 */
class MyCustomEventBinders {
    
    /**
     * Binds all kind of events
     * @param sfEventDispatcher $dispatcher - event dispatcher instance
     * @param string $eventName - ex 'controller.test_index'
     * @param object $handlerInstance - ex. new MyClass()
     * @param string $handlerMethodName - ex. 'myMethod'
     */
    public static function bindEvent(sfEventDispatcher $dispatcher, $eventName, $handlerInstance, $handlerMethodName){
        if(!is_object($handlerInstance)){
            throw new Exception('$handlerInstance must be an object');
        }
        $dispatcher->connect($eventName, array($handlerInstance, $handlerMethodName));
    }
    
    /**
     * Example of how to use
     * @param sfEventDispatcher $dispatcher
     */
    public static function bindControllerEventEXAMPLE1(sfEventDispatcher $dispatcher){
        self::bindEvent($dispatcher, 'controller.test_index', new MyCustomEventHandlers(), 'listenToTestIndex');
    }
}
