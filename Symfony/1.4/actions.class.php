<?php

/**
 * test actions.
 */
class testActions extends sfActions
{
    /**
     * @var sfEventDispatcher 
     */
    var $dispatcher;
    
    public function preExecute()
    {
       MyCustomEventBinders::bindControllerEventEXAMPLE1($this->dispatcher);
        parent::preExecute();
    }
    
 /**
  * Executes index action
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->dispatcher->notify(new sfEvent($this, 'controller.test_index', array('param1' => 'param1 value')));
  }
}
