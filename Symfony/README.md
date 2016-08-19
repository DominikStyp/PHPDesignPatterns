# Symfony 1.4
## How bind events using *sfEventDispatcher*
Following example demostrates how to use *Symfony dispatcher* to:
1. Connect custom event ('controller.test_index') to *MyListerers::lister* method
2. Notify this event in *executeIndex* method in chosen place in code.
3. Get caller object via *$event->getSubject()*
4. Send array of arguments to the *listener()* method via *sfEvent* object

Example files are in [this directory](1.4/) <br />
Controller file: <br />
```php
  public function preExecute(){
    $this->dispatcher->connect('controller.test_index', array(new MyListeners(), 'listener'));
    parent::preExecute();
  }
  public function executeIndex(sfWebRequest $request)
  {
    $this->dispatcher->notify(new sfEvent($this, 'controller.test_index', array('param1' => 'param1 value')));
  }
```
Other file from which you want to **capture** event: 
```php
  class MyListeners {
        /**
         * This method will be invoked when Controller::executeIndex() fires notify
         */
        public function listener(sfEvent $event){
            $obj = get_class($event->getSubject());
            throw new Exception("controller.test_index fired with value:  {$event['param1']} \n Object that fired me is: $obj");
        }
  }
```
