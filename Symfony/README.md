# Symfony 1.4
## How bind events using *sfEventDispatcher*
Example files are in [this directory](1.4/)
Controller:
```php
  public function executeIndex(sfWebRequest $request)
  {
    $this->dispatcher->notify(new sfEvent($this, 'controller.test_index', array('param1' => 'param1 value')));
  }
```
Other file from which you want to **capture** event: 
```php
  class MyListeners {
        public function myMethod(){
            
        }
        /**
         * This method will be invoked when Controller::executeIndex() fires notify
         */
        public function listener(sfEvent $event){
            $obj = get_class($event->getSubject());
            throw new Exception("controller.test_index fired with value:  {$event['param1']} \n Object that fired me is: $obj");
        }
  }
```
