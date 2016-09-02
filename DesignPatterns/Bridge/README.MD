## Bridge Pattern Example
First example of how to use **Bridge Pattern** is basic implementation of **MessageSenderI** and **LoggerI**. <br />
Whole idea behind it is to **decouple implementations of each class via interface abstraction** <br />
[BridgePatternExample.php](BridgePatternExample.php)<br />
Characteristics of this implementation:
 1. at least 2 interfaces related with each other
 2. all dependencies in classes are injected via interfaces, never through concrete classes
 3. every concrete class in bridge pattern should implement interface, and/or be dependent upon other interface(s)

## Summary
### Pros
 1. very high decoupling
 2. very high re-usability of the code
 3. flexibility
 4. concrete classes works independently on the others (only connection is via interface)

### Cons
 1. many classes, methods and files to deal with
 2. many relations between many interfaces may be confusing
 3. less readable and understandable code
 4. code could be harder to debug, especially when concrete implementations are injected via reflection in runtime
