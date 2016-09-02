## Bridge Pattern Example
First example of how to use **Bridge Pattern** is basic implementation of **MessageSenderI** and **LoggerI**. <br />
Whole idea behind it is to **decouple implementations of each class via interface abstraction** <br />
[BridgePatternExample.php](BridgePatternExample.php)<br />
Characteristics of this implementation:
 1. at least 2 interfaces related with each other
 2. all dependencies in classes are injected via interfaces, never through concrete classes
 3. every concrete class in bridge pattern should implement interface, and be dependent upon other interface(s)

## Summary
### Pros
 1. very high decoupling
 2. very high re-usability of the code
 3. very flexible code (you can change implementations of each class)
 4. every class works independently on the other (only dependency is the interface)

### Cons
 1. many classes, methods and files to deal with
 2. many relations between many interfaces may be confusing
 3. worse readability of the code
 4. code could harder to debug, especially when concrete implementations are injected via reflection in runtime
