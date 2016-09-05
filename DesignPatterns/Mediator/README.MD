## Mediator Pattern Example
First example of how to use **Mediator Pattern** is basic implementation of **MediatorI** and **DeviceI**. <br />
Whole idea behind it is to **decouple implementations of each class via interface abstraction, <br />
and make one outer class responsible for the communication between the others** <br />
In the following example there's **Router** which is implementation of the mediator, and **Devices** which are colleagues.<br />
[MediatorPatternExample.php](MediatorPatternExample.php)<br />
Characteristics of this implementation:
 1. there is one mediator class (Router) which is responsible for the communication between colleagues (Devices)
 2. at least 2 related interfaces (or abstract classes) - one to implement for colleagues, and one for mediator
 3. all dependencies in classes are injected via interface methods, never with concrete class type as argument
 4. every concrete class in mediator pattern should implement interface used for communication between the other classes

## Summary
### Pros
 1. very high decoupling
 2. very high re-usability of the code
 3. flexibility
 4. concrete classes (colleagues) works independently on others (only connection is via mediator class)

### Cons
 1. many classes, methods and files to deal with
 2. less readable and understandable code
 4. code could be harder to debug, especially when reflection is involved
