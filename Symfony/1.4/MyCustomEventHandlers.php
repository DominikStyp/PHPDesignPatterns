<?php

/**
 * MyCustomEventHandlers
 *
 * @author Dominik
 */
class MyCustomEventHandlers {

   /**
    * Listener that 
    * @param sfEvent $event
    * @throws Exception
    */
   public function listenToTestIndex(sfEvent $event){
       $obj = get_class($event->getSubject());
       throw new Exception("controller.test_index fired with value:  {$event['param1']} \n Object that fired me is: $obj");
   }
}
