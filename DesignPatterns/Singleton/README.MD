## Singleton Pattern Example
First example of how to use **Factory Pattern** is very simple implementation of **SingletonObject**. <br />
Whole idea behind it is to **construct the same object only once**. <br />
[SingletonPatternExample.php](SingletonPatternExample.php)<br />
Characteristics of this implementation:
 1. instance of the object held by the class static variable
 2. static method getInstance() retrieves the instance

## Summary
### Pros
 1. less memory usage when reusing same instance of the big object, instead of creating new
 2. sharing variables across all references to the object

### Cons
 1. polymorphism is difficult to implement since getInstance is a static call,
 2. when using inheritance, you have to define **getInstance()** method in each child class,
 or use reflection, late static binding etc.
