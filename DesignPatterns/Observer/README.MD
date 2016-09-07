## Observer Pattern Example
First example of how to use **Observer Pattern** is very simple implementation of **MyUser**. <br />
Whole idea behind it is to **capture events emitted by the object, and react to those in listeners**. <br />
This particular example implements built-in SplObserver interface, so it's not very flexible. <br />
However in PHP you can "overload" method with additional parameters like `$eventType`. <br />
Better way is to create your own interface that suit your needs. <br />
[ObserverPatternExample.php](ObserverPatternExample.php)<br />
Characteristics of this implementation:
 1. Subject implements subject interface (SplSubject)
 2. Observer implements observer interface (SplObserver)
 3. Subject informs every observer via **notify()** method
 4. Observer reacts to event via **update()** method

## Summary
### Pros
 1. very well decoupled code
 2. possibility of having unlimited number of observers
 3. flexible code in each observer

### Cons
 1. many classes and lots of code
